<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatorController extends Controller
{
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email'    => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 8 karakter',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->is_active !== 1) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak aktif, silakan hubungi administrator.'
                ])->withInput($request->only('email', 'remember'));
            }

            if (Auth::user()->role === "Super Admin") {
                $lastAccessedUrl = session()->get('last_accessed_url', route('admin.dashboard.index'));
                return redirect()->intended($lastAccessedUrl);
            } else {
                return redirect()->route('admin.dashboard.index');
            }
        }

        session()->flash('error', 'Email atau password salah.');
        return back()->withInput($request->only('email', 'remember'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.pages.auth.profile', compact('user', 'divisions'))->with('title', 'Profil');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
        ];

        if ($user->role !== 'Super Admin') {
            $rules['division_id'] = 'required|exists:divisions,id';
        }

        $messages = [
            'name.required'        => 'Nama wajib diisi.',
            'name.string'          => 'Nama harus berupa teks.',
            'name.max'             => 'Nama maksimal 255 karakter.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'division_id.required' => 'Divisi wajib dipilih.',
            'division_id.exists'   => 'Divisi tidak ditemukan dalam sistem.',
        ];

        $request->validate($rules, $messages);

        $user->update($request->only(['name', 'email']));

        if ($user->role !== 'Super Admin') {
            $user->division_id = $request->division_id;
            $user->save();
        }

        if ($request->has('change_password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6',
            ], [
                'current_password.required' => 'Password lama wajib diisi.',
                'password.required'         => 'Password baru wajib diisi.',
                'password.confirmed'        => 'Konfirmasi password tidak sesuai.',
                'password.min'              => 'Password minimal 6 karakter.',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Password lama tidak sesuai.',
                ]);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui');
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
