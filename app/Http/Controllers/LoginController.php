<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login User | ' . $this->title,
        ];

        return view('login.main', $data);
    }

    public function login(Request $request)
    {
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validasi)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with($this->alert->success('Selamat Datang di Aplikasi<br /><b>Sistem Pelaporan Keuangan Revitalisasi 2026</b><br />SMK Ashhabul Maimanah Sidayu', 'Login User'));
        }

        return redirect()->back()->with($this->alert->warning('<b>Username</b> atau <b>Password</b> yang anda masukkan <b>Salah!!!</b>', 'Login User'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with($this->alert->info('Sampai Jumpa Lagi', 'info'));
    }
}
