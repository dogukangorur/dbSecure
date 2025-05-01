<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\File;
use App\Models\Password;
use Illuminate\Support\Facades\Mail;
use Mailgun\Mailgun;    
class DashboardController extends Controller
{

    public function index(){
        return view('admin.admin');
    }
    public function getChartData(){
        $cardCount=Card::where("kullanici_id",Auth::user()->id)->count();
        $passwordCount=Password::where("kullanici_id",Auth::user()->id)->count();
        $fileCount =File::where("kullanici_id",Auth::user()->id)->count();
        return response()->json([
            "cardCount"=>$cardCount,
            "passwordCount"=>$passwordCount,
            "fileCount"=>$fileCount
        ]);

    }

}
