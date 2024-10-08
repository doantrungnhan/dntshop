<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
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
    public function store(Request $request): RedirectResponse
{
    // Validate dữ liệu đầu vào
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Lấy dữ liệu mail và password từ request
    $user = $request->only('email', 'password');

    // Regenerate session để bảo vệ người dùng
    $request->session()->regenerate();

    // Điều hướng người dùng đến trang chủ hoặc trang yêu cầu
    return redirect()->intended(route('home'));
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
