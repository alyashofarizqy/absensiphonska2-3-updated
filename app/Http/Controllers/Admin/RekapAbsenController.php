<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapAbsen;
use App\Http\Requests\StoreRekapAbsenRequest;
use App\Http\Requests\UpdateRekapAbsenRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekapAbsenExport implements FromCollection, WithHeadings, WithMapping
{
	// set filter
	protected $filter;

	public function __construct($filter)
	{
		$this->filter = $filter;
	}

    // get user rekap absen
    public function collection()
    {
		// filter rekap absen by search (if any)
		$name = $this->filter['name'];
		$start = $this->filter['start'];
		$end = $this->filter['end'];

		// get all rekap absen
		return RekapAbsen::orderBy('tanggal', 'desc')
			->when($name, function ($query, $name) {
				return $query->whereHas('user', function ($userQuery) use ($name) {
					$userQuery->where('name', 'like', '%' . $name . '%');
				});
			})
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
		$name = $request->query('name');
        $start = $request->query('start');
        $end = $request->query('end');

        // get all rekap absen
		$tknos = RekapAbsen::orderBy('tanggal', 'desc')
			->when($name, function ($query, $name) {
				return $query->whereHas('user', function ($userQuery) use ($name) {
					$userQuery->where('name', 'like', '%' . $name . '%');
				});
			})
			->when($start, function ($query, $start) {
				return $query->whereDate('tanggal', '>=', $start);
			})
			->when($end, function ($query, $end) {
				return $query->whereDate('tanggal', '<=', $end);
			})
			->with('user', 'checkin', 'checkout')
			->paginate(10);


		return view('admin.tknos.index', compact('tknos'));
    }

    /**
     * Download the specified resource.
     */
    public function download(Request $request)
    {
		// filter rekap absen by search (if any)
		$name = $request->input('name');
		$start = $request->input('start');
		$end = $request->input('end');

		$filter = [
			'name' => $name,
			'start' => $start,
			'end' => $end
		];

        // download excel
        return Excel::download(new RekapAbsenExport($filter), 'rekap_absens.xlsx', ExcelType::XLSX);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        throw new Exception('Not implemented');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekapAbsenRequest $request)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Display the specified resource.
     */
    public function show(RekapAbsen $rekapAbsen)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekapAbsen $rekapAbsen)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekapAbsenRequest $request, RekapAbsen $rekapAbsen)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekapAbsen $rekapAbsen)
    {
        throw new Exception('Not implemented');
    }
}
