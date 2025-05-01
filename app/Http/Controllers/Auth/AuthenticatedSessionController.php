<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mailgun\Mailgun;   
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frond.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

    $request->session()->regenerate();

    $kodArray = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
    $karistirilmis = str_shuffle($kodArray);
    $kod = substr($karistirilmis, 0, 8);
    session([
        'dogrulama_kodu' => $kod,
        'dogrulama_zamani' => now(),
        'kod_dogrulandi' => false 
    ]);

        $mg = Mailgun::create(getenv('MAILGUN_SECRET') ?: 'MAILGUN_SECRET');

        $result = $mg->messages()->send(
    'sandboxb002329903494e2e9ae1c303971a5d83.mailgun.org', 
    [
        'from' => 'dbSecure <postmaster@sandboxb002329903494e2e9ae1c303971a5d83.mailgun.org>',
        'to' => Auth::user()->email,
        'subject' => 'Doğrulama Kodu',
        'text' => 'Merhaba '. Auth::user()->name ." ,  Doğrulama kodun : ".$kod
    ]
    );
   
            toastr()->success("Doğrulama kodu gönderildi. Lütfen e-postanızı kontrol edin.");
            return redirect()->route('dogrulama.form');
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toastr()->success("Çıkış İşlemi Başarılı");
        return redirect('/');
    }
}
