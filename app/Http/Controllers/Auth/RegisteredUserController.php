<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Notifications\UserRegistNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $kelas = Kelas::all();
        return view('auth.register', compact('kelas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nis_nip' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'kelas_id' => $validated['kelas_id'],
            'nis_nip' => $validated['nis_nip'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'is_active' => false,
        ]);
        $admins = User::where('role', 'admin')->get();
        Notification::send(
            $admins,
            new UserRegistNotification(
                userId: $user->id,
                title: 'Pendaftaran Akun Baru',
                message: "{$user->name} telah mendaftarkan akun baru.",
                url: route('admin.users.index'),
                icon: '👤',
            )
        );

        event(new Registered($user));

        Auth::login($user);

        if ($request->user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('user.catalogs.index', absolute: false));
    }
}
