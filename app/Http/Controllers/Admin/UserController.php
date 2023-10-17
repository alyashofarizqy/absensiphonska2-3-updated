<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Exception;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    // get user rekap absen
    public function collection(): Collection
    {
        return User::all();
    }

    // map user data
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->nik,
            $user->email,
            $user->pt,
            $user->plant,
            $user->tanggal_lahir,
            $user->role,
        ];
    }

    // set excel headings
    public function headings(): array
    {
        return [
            'id',
            'name',
            'nik',
            'email',
            'pt',
            'plant',
            'tanggal_lahir',
            'role',
        ];
    }
}


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // filter rekanan by search (if any)
        $search = $request->query('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        // return view with rekanans
        return view('admin.users.index', compact('users'));
    }


    /**
     * Export data to Excel.
     */
    public function download()
    {
        return Excel::download(new UserExport, 'users.csv', ExcelType::CSV);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        // create user
        User::create($request->validated());
        return redirect()->route('admin.users.index')->with('status', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // update user
        $user->update($request->validated());
        return redirect()->route('admin.users.index')->with('status', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        throw new Exception('Not implemented');
    }
}
