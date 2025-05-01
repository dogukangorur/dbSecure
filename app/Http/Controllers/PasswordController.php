<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PasswordController extends Controller
{
    public function index(){
        $data = Password::where("kullanici_id", Auth::user()->id)->get();     
        return view("admin.passwords",["passwords"=>$data]);
    }
    public function destroy($id){
        $deleted = Password::where("id",$id)->delete();
            if ($deleted) {
                toastr()->success("Şifre Başariyla Silindi");
                return redirect()->back();
            } else {
                toastr()->error("Şifre Silme İşlemi Başarisiz");
                return redirect()->back();
            }
    }
    public function show($id)
    {  
      $data= Password::where("id",$id)->first();
      return response()->json([
        "sifreAdi"=>$data->sifre_adi,
        "kullaniciAdi"=>$data->kullanici_adi,
        "sifre"=>decrypt($data->sifre)
      ]);  
    }
    public function showCreate()
    {  
      return view("admin.password-create");  
    }


    public function create(Request $request)
    {
        $request->validate([
            "userName"=>"required",
            "passwordName" => "required|max:50",
            "passwordNo" => "required"
        ]);
        try {
            Password::create([
                "kullanici_id"=>Auth::user()->id,
                "kullanici_adi"=>$request->userName,
                "sifre_adi"=>$request->passwordName,
                "sifre"=>encrypt($request->passwordNo)
            ]);
            toastr()->success("Şifre Basariyla Olusturuldu");
            return redirect()->route("passwords");
        } catch (\Throwable $th) {
            toastr()->error("Hata");
            return redirect()->route("passwords");
        }
        
    }
}
