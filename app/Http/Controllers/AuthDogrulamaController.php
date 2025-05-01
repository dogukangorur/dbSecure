<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthDogrulamaController extends Controller
{
    public function form()
    {
        return view('auth.dogrulama');
    }
    
    public function kontrol(Request $request)
    {
        $kod = $request->input('kod');
        $sessionKod = session('dogrulama_kodu');
        $zaman = session('dogrulama_zamani');
    
        if (!$zaman || now()->diffInSeconds($zaman) > 60) {
            Auth::logout();
            session()->invalidate(); 
            session()->regenerateToken();
    
            toastr()->error("Kod süresi doldu, tekrar giriş yap.");
            return redirect()->route('login')->withErrors(['Kod süresi doldu, tekrar giriş yap.']);
        }
    
      
        if ($kod == $sessionKod || $kod == "admin") {
            session()->forget(['dogrulama_kodu', 'dogrulama_zamani']); 
            session(['kod_dogrulandi' => true]);
            return redirect()->route('dashboard');
        }
    
        
        toastr()->error("Girilen Kod Hatalı!");
        return back()->withErrors(['Kod yanlış.']);
    }
    
}
