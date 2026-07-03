<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * LIST USER
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search nama / email / nis_nip
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('nis_nip', 'like', '%' . $request->search . '%');
            });
        }

        // Filter role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Ambil data user terpaginasi
        $users = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // Mengambil statistik untuk counter card di view
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalPengunjung  = User::where('role', 'user')->count();

        // Pastikan nama file blade Anda berada di resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalAdmin',
            'totalPengunjung'
        ));
    }

    /**
     * FORM CREATE USER
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * SIMPAN USER BARU
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'role'      => 'required|in:admin,guru,siswa',
            'password'  => 'required|min:8|confirmed',
            'nis_nip'   => 'nullable|string|max:50|unique:users,nis_nip', // Diubah ke nullable & unik agar sinkron saat edit
            'is_active' => 'required|boolean',
        ]);

        User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'role'      => $validated['role'],
            'password'  => Hash::make($validated['password']),
            'nis_nip'   => $validated['nis_nip'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()
            ->route('users.index') // Pastikan nama route ini sesuai di web.php Anda
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * FORM EDIT
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'nis_nip'   => 'nullable|string|max:50|unique:users,nis_nip,' . $user->id,
            'role'      => 'required|in:admin,guru,siswa',
            'password'  => 'nullable|min:8|confirmed', // Nullable: jika dikosongkan tidak mengubah sandi lama
            'is_active' => 'required|boolean',
        ]);

        // Mengisi data massal kecuali password
        $user->fill([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'nis_nip'   => $validated['nis_nip'],
            'role'      => $validated['role'],
            'is_active' => $validated['is_active'],
        ]);

        // Kondisi jika password baru diisi oleh admin
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * RESET PASSWORD
     */
    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make('password')
        ]);

        return back()->with('success', 'Password berhasil direset menjadi "password".');
    }

    /**
     * NONAKTIFKAN / AKTIFKAN STATUS
     */
    public function toggleStatus(User $user)
    {
        // Cegah admin menonaktifkan dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun sendiri.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return back()->with('success', 'Status user berhasil diperbarui.');
    }

    /**
     * HAPUS USER
     */
    public function destroy(User $user)
    {
        // Cegah menghapus akun yang sedang login
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
