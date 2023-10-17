<?php

namespace App\Http\Controllers;

use App\Models\Rekanan;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\StoreRekananRequest;

use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekananExport implements FromCollection, WithHeadings
{
    // get user rekap absen
    public function collection(): Collection
    {
        return Rekanan::whereDate('created_at', today())->get();
    }

    // set excel headings
    public function headings(): array
    {
        return Schema::getColumnListing('rekanans');
    }
}

class RekananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // filter rekanan by search (if any)
        $search = $request->query('search');

        // get today's rekanan
        $rekanans = Rekanan::whereDate('created_at', today())
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })->paginate(10);

        // return view with rekanans
        return view('rekanans.index', compact('rekanans'));
    }

    /**
     * Download the specified resource.
     */
    public function download()
    {
        return Excel::download(new RekananExport, 'rekanans.csv', ExcelType::CSV);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekananRequest $request): RedirectResponse
    {
        Rekanan::create($request->validated());
        return Redirect::route('rekanans.index')->with('status', 'Rekanan berhasil ditambahkan');
    }
}
