<?php

namespace App\Http\Controllers\Otentikasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\DaftarRequest;
use App\Http\Requests\MasukRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use ProtoneMedia\Splade\Facades\Toast;

class OtentikasiController extends Controller
{
    // form masuk
    public function masuk()
    {
        if (Auth::check()) {
            // kembali ke view
            return to_route('home');
        }
        // kembali ke view
        return view('masuk');
    }

    // otentikasi login
    public function masuk_otentikasi(MasukRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Kredensial ini tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    // form daftar
    public function daftar()
    {
        if (Auth::check()) {
            // kembali ke view
            return to_route('home');
        }
        // kembali ke view
        return view('daftar');
    }

    // daftar
    public function daftar_user(DaftarRequest $request): RedirectResponse
    {
        try {
            // array data user
            $user = User::create([
                'name' => $request->name,
                'uuid' => Str::uuid(),
                'email' => $request->email,
                'password' => $request->password,
                'is_admin' => false
            ])->markEmailAsVerified();;
            // notfikasi sukses
            Toast::title('Berhasil')
                ->message('Kamu berhasil membuat akun.')
                ->success()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(15);
            // event daftar
            event(new Registered($user));
            // redirek halaman masuk
            return redirect()->route('masuk');
        } catch (\Exception $e) {
            // notifikasi gagal
            Toast::title('Gagal!')
                ->message($e->getMessage())
                ->danger()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(15);
            // redirek halaman masuk
            return redirect()->route('daftar');
        }
    }

    // otentikasi keluar
    public function keluar()
    {
        Auth::logout();
        // kembali ke view
        return redirect('/');
    }
}
