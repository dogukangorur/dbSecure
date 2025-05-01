<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = DB::table("kart")->where("kullanici_id", Auth::user()->id)->get();
            return view("admin.cards", ["cards" => $data]);
        } else {
            return redirect()->route("login");
        }
    }
    public function destroy($id)
    {
            $deleted = DB::table('kart')->where('id', $id)->delete();
            if ($deleted) {
                toastr()->success("Kart Başariyla Silindi");
                return redirect()->back();
            } else {
                toastr()->error("Kart Silme İşlemi Başarisiz");
                return redirect()->back();
            }
       
    }
    public function show($id)
    {  
      $data= DB::table("kart")->where("id",$id)->first();
      return response()->json([
        "no"=>decrypt($data->kart_no),
        "cvv"=>decrypt($data->cvv),
        "skt"=>decrypt($data->skt)
      ]);  
    }
    public function showCreate()
    {  
      return view("admin.card-create");  
    }
    public function create(Request $request)
    {
        $request->validate([
            "cardName" => "required|max:50",
            "cardNo" => "required|max:16|min:16",
            "cardSkt" => "required|max:5|min:5",
            "cardCvv" => "required|max:3|min:3"
        ]);
        try {
            Card::create([
                "kullanici_id"=>Auth::user()->id,
                "kart_adi"=>$request->cardName,
                "kart_no"=>encrypt($request->cardNo),
                "skt"=>encrypt($request->cardSkt),
                "cvv"=>encrypt($request->cardCvv)
            ]);
            toastr()->success("Kart Basariyla Olusturuldu");
            return redirect()->route("cards");
        } catch (\Throwable $th) {
            toastr()->error("Hata");
            return redirect()->route("cards");
        }
        
    }
}
