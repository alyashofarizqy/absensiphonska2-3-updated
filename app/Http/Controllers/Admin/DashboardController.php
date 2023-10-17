<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Rekanan;
use App\Models\RekapAbsen;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::count();
        $tknos = RekapAbsen::count();
        $rekanans = Rekanan::count();

        $pagi = RekapAbsen::selectRaw('count(*) as total, date(tanggal) as date')
            ->where('tanggal', '>=', now()->subDays(20)->format('Y-m-d'))
            ->where('shift', 'pagi')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $siang = RekapAbsen::selectRaw('count(*) as total, date(tanggal) as date')
            ->where('tanggal', '>=', now()->subDays(20)->format('Y-m-d'))
            ->where('shift', 'siang')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $malam = RekapAbsen::selectRaw('count(*) as total, date(tanggal) as date')
            ->where('tanggal', '>=', now()->subDays(20)->format('Y-m-d'))
            ->where('shift', 'malam')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $pagi->pluck('date');
        $pagi = $pagi->pluck('total');
        $siang = $siang->pluck('total');
        $malam = $malam->pluck('total');

        $labels = $labels->map(function ($item) {
            return Carbon::parse($item)->format('d M');
        });

        $data = [
            'pagi' => $pagi,
            'siang' => $siang,
            'malam' => $malam,
        ];

        return view('admin.dashboards.index', compact('users', 'rekanans', 'tknos', 'labels', 'data'));
    }
}
