<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function index(Request $request){
        $data =DB::table("giris_log")->where("kullanici_id",Auth::user()->id)->orderBy("login_date","desc")->get();
        return view("admin.logs",["logs"=>$data]);
    }
}
