<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        if ($request->filled('search')) {

            $query->where('kelas', 'like', '%' . $request->search . '%');
        }

        $kelas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas' => 'required|string|unique:kelas,kelas',
            'description' => 'nullable'
        ], [
            'kelas.required' => 'Kolom kelas wajib diisi',
            'kelas.unique' => 'Kelas tidak boleh sama dengan kelas yang sudah ada!'
        ]);

        Kelas::create($validated);
        return redirect()->route('admin.kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        $kelas->loadCount([
            'users',

            'users as active_users_count' => function ($query) {
                $query->where('is_active', true);
            },

            'users as inactive_users_count' => function ($query) {
                $query->where('is_active', false);
            },
        ]);

        $users = $kelas->users()
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kelas.show', compact('kelas', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'kelas' => 'required|string|unique:kelas,kelas,' . $kelas->id,
            'description' => 'nullable'
        ], [
            'kelas.required' => 'Kolom kelas wajib diisi',
            'kelas.unique' => 'Kelas tidak boleh sama dengan kelas yang sudah ada!'
        ]);

        $kelas->update($validated);
        return redirect()->route('admin.kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('admin.kelas.index');
    }
}
