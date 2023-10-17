<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\RekapAbsen;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAbsenRequest;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class AbsenController extends Controller
{
    protected int $ONTIME_MINUTE_TRESHOLD = 30;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // find user rekap for today
        $rekap = RekapAbsen::where('user_id', $request->user()->id)
            ->whereDate('tanggal', today())
            ->firstOrCreate([
                'user_id' => $request->user()->id,
                'tanggal' => today(),
            ])->load('checkin', 'checkout');

        // get checkin and checkout target
        $checkin_target = Carbon::parse($rekap->tanggal)
            ->timezone('Asia/Jakarta')
            ->setHour($rekap->shift == 'pagi' ? 7 : ($rekap->shift == 'siang' ? 15 : 23))
            ->setMinute(0)
            ->setSecond(0);

        $checkout_target = Carbon::parse($rekap->shift == 'malam' ? $rekap->tanggal->addDay() : $rekap->tanggal)
            ->timezone('Asia/Jakarta')
            ->setHour($rekap->shift == 'pagi' ? 15 : ($rekap->shift == 'siang' ? 23 : 7))
            ->setMinute(0)
            ->setSecond(0);

        // check checkin and checkout status
        if (!$rekap->checkin)
            $checkin_status = null;
        elseif ($rekap->checkin->created_at->gt($checkin_target))
            $checkin_status = 'late';
        elseif ($rekap->checkin->created_at->addMinutes($this->ONTIME_MINUTE_TRESHOLD)->gt($checkin_target))
            $checkin_status = 'ontime';
        else
            $checkin_status = 'early';

        if (!$rekap->checkout)
            $checkout_status = null;
        elseif ($rekap->checkout->created_at->lt($checkout_target))
            $checkout_status = 'early';
        elseif ($rekap->checkout->created_at->subMinutes($this->ONTIME_MINUTE_TRESHOLD)->lt($checkout_target))
            $checkout_status = 'ontime';
        else
            $checkout_status = 'late';

        // return view
        return view('absens.index', [
            'rekap' => $rekap,
            'checkin' => $rekap->checkin,
            'checkout' => $rekap->checkout,
            'checkin_target' => $checkin_target,
            'checkout_target' => $checkout_target,
            'checkin_status' => $checkin_status,
            'checkout_status' => $checkout_status,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenRequest $request): RedirectResponse
    {
        // Get or create today's rekap
        $rekap = RekapAbsen::where('user_id', $request->user()->id)
            ->whereDate('tanggal', today())
            ->firstOrCreate([
                'user_id' => $request->user()->id,
                'tanggal' => today(),
            ]);

        // Check if user already checkin and checkout
        if ($rekap->checkin !== null && $rekap->checkout !== null) {
            return Redirect::route('absens.index')->with('status', 'Anda sudah absen hari ini.');
        }

        // Save photo
        $filename = sprintf('absens/%s.jpg', time());
        Storage::disk('public')->put($filename, base64_decode($request->photo));

        // Save absen
        if ($rekap->checkin === null) {
            $rekap->update([
                'checkin_id' => Absen::create([
                    'photo' => $filename,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ])->id,
            ]);
        } else if ($rekap->checkout === null) {
            $rekap->update([
                'checkout_id' => Absen::create([
                    'photo' => $filename,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ])->id,
            ]);
        }

        // Redirect
        return Redirect::route('absens.index')->with('status', 'Absen berhasil disimpan.');
    }
}
