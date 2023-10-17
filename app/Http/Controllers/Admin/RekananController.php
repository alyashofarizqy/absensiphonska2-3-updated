<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rekanan;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekananExport implements FromCollection, WithHeadings
{
    // get user rekap absen
    public function collection(): Collection
    {
        return Rekanan::all();
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

        // get all rekanan
        $rekanans = Rekanan::orderBy('created_at', 'desc')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })->paginate(10);

        // return view with rekanans
        return view('admin.rekanans.index', compact('rekanans'));
    }

    /**
     * Download the specified resource.
     */
    public function download()
    {
        return Excel::download(new RekananExport, 'rekanans.csv', ExcelType::CSV);
    }
}
