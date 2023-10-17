<?php

namespace App\Http\Controllers;

use App\Models\RekapAbsen;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateRekapAbsenRequest;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekapAbsenExport implements FromCollection, WithHeadings, WithMapping
{
	protected $filter;
	protected $user;
	public function __construct($filter, $user)
	{
		$this->filter = $filter;
		$this->user = $user;
	}

    // get user rekap absen
    public function collection()
    {
		// filter rekap absen by search (if any)
		$start = $this->filter['start'];
		$end = $this->filter['end'];

        return RekapAbsen::where('user_id', Auth::user()->id)
			->orderBy('tanggal', 'desc')
			->when($start, function ($query, $start) {
				return $query->whereDate('tanggal', '>=', $start);
			})
			->when($end, function ($query, $end) {
				return $query->whereDate('tanggal', '<=', $end);
			})
			->with('user', 'checkin', 'checkout')
            ->get();
    }

    // map rekap absen to array
    public function map($rekap): array
    {

        return [
            $rekap->id,
            $rekap->user->name,
            $rekap->user->nik,
            $rekap->user->plant,
            $rekap->user->pt,
            $rekap->user->tanggal_lahir ? $rekap->user->tanggal_lahir->format('d/m/Y') : null,
            $rekap->tanggal,
            $rekap->shift,

            $rekap->checkin ? $rekap->checkin->created_at->timezone('Asia/Jakarta')->format('H:i:s') : null,
            $rekap->checkin ? $rekap->checkin->latitude : null,
            $rekap->checkin ? $rekap->checkin->longitude : null,

            $rekap->checkout ? $rekap->checkout->created_at->timezone('Asia/Jakarta')->format('H:i:s') : null,
            $rekap->checkout ? $rekap->checkout->latitude : null,
            $rekap->checkout ? $rekap->checkout->longitude : null,
        ];
    }

    // set excel headings
    public function headings(): array
    {
        return [
			[
				'Nama',
				$this->user->name,
			],
			[
				'NIK',
				$this->user->nik,
			],
			[
				'Plant',
				$this->user->plant,
			],
			[
				'PT',
				$this->user->pt,
			],
			[
				'',
			],
			[
				'ID',
				'Nama',
				'NIK',
				'Plant',
				'PT',
				'Tanggal',
				'Shift',

				'Checkin',
				'Checkin Latitude',
				'Checkin Longitude',

				'Checkout',
				'Checkout Latitude',
				'Checkout Longitude',
			]
		];
    }
}

class RekapAbsenController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
		// filter rekap absen by search (if any)
		$start = $request->query('start');
		$end = $request->query('end');

		// get all rekap absen
		$rekaps = RekapAbsen::where('user_id', Auth::user()->id)
			->orderBy('tanggal', 'desc')
			->when($start, function ($query, $start) {
				return $query->whereDate('tanggal', '>=', $start);
			})
			->when($end, function ($query, $end) {
				return $query->whereDate('tanggal', '<=', $end);
			})
			->with('user', 'checkin', 'checkout')
			->paginate(10);


		// return view
		return view('absens.history', compact('rekaps'));
    }

    /**
     * Download the specified resource.
     */
    public function download(Request $request)
    {
		// filter rekap absen by search (if any)
		$start = $request->input('start');
		$end = $request->input('end');

		$filter = [
			'start' => $start,
			'end' => $end
		];

		$user = User::where('id', Auth::user()->id)
			->select('name', 'nik', 'plant', 'pt')
			->first();

        // download excel
        return Excel::download(new RekapAbsenExport($filter, $user), 'rekap_absens.xlsx', ExcelType::XLSX);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekapAbsenRequest $request, RekapAbsen $rekap): RedirectResponse
    {
        // update shift and save
        $rekap->update($request->validated());
        $rekap->save();

        // return redirect
        return Redirect::route('absens.index')->with('status', 'Shift berhasil diperbarui');
    }
}
