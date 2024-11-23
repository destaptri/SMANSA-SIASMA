<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;

class AuthenticatedSessionController extends Controller
{
    use HasRoles;
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil user yang sedang login
        /** @var \App\Models\User */
        $user = Auth::user();

        // Cek role dan arahkan ke halaman yang sesuai
        if ($user->hasRole('Super Admin')) {
            return redirect()->intended(route('dashboard'));
        } elseif ($user->hasRole('Admin')) {
            return redirect()->intended(route('pencarian-data'));
        } elseif ($user->hasRole('Kepala Sekolah')) {
            return redirect()->intended(route('laporan'));
        } elseif ($user->hasRole('Alumni')) {
            return redirect()->intended(route('beranda'));
        }

        // Default redirect jika tidak ada role yang cocok
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
