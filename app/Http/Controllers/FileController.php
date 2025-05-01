<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function encryption(){
        return view("admin.encryption");
    }
    public function decryption(){
        $fileTypes = DB::table("dosya_turleri")->get();
        return view("admin.decryption",["fileTypes"=>$fileTypes]);
    }
    public function encrypt(Request $request){
        if (!$request->hasFile('encFile')) {
            return response()->json(['error' => 'Dosya alınamadı'], 400);
        }

        $file = $request->file('encFile');
        if (!$file->isValid()) {
            return response()->json(['error' => 'Geçersiz dosya'], 400);
        }

        $fileContent = file_get_contents($file->getRealPath());

        $encdata = encrypt($fileContent); 
        $pass =$request->input("encKey");

        $hashedKey = hash('sha256', $pass);
        $totalEncData = $hashedKey.$encdata;

        $substring = strtoupper(substr($totalEncData, 34, 16));
       $totalEncData = substr_replace($totalEncData, $substring, 34, 16);
         
        return response()->json(["data"=>$totalEncData]); 
    }
    public function decrypt(Request $request){
        if (!$request->input('decArea')) {
            return response()->json(['error' => 'Dosya alınamadı'], 400);
        }

        $fileContent = $request->input("decArea");
        $fileType = $request->input("fileType");

        $pass = $request->input("decKey");
        $hashedKey = hash('sha256', $pass);
    

        $substring = strtolower(substr($fileContent, 34, 16));
        $totalEncData = substr_replace($fileContent, $substring, 34, 16);


        $hased = substr($totalEncData, 0, 64);
        $pureData = substr($totalEncData, 64);


        if($hased !== $hashedKey){
            return response()->json(["data"=>"hata"]);
        }
        else{
            $pureData = substr($fileContent, 64);
            $decdata = decrypt($pureData);
            $fileName=now()->format("dmYHis").$fileType;

            if (in_array($fileType, [".jpg", ".jpeg", ".png",".pdf",".docx",".xlsx"])) {
                $base64Data = base64_encode($decdata);
                return response()->json([
                    'file_name' => $fileName,
                    'file_content' => $base64Data,
                    'file_type' => $fileType
                ]);
            }
        

            return response()->json([
                'file_name' => $fileName,
                'file_content' => $decdata
            ]);

           
           
        }
    }
    public function index(){
        $files = File::where("kullanici_id",Auth::user()->id)->get();
        return view("admin.files",["files"=>$files]);
    }

    public function save(Request $request){
        if (!$request->hasFile('encFile')) {
            return response()->json(['error' => 'Dosya alınamadı'], 400);
        }

        $file = $request->file('encFile');
        if (!$file->isValid()) {
            return response()->json(['error' => 'Geçersiz dosya'], 400);
        }
        $originalName = $file->getClientOriginalName();
        $originalName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileContent = file_get_contents($file->getRealPath());

        $encdata = encrypt($fileContent); 
        $pass =$request->input("encKey");

        $hashedKey = hash('sha256', $pass);
        $totalEncData = $hashedKey.$encdata;

        $substring = strtoupper(substr($totalEncData, 34, 16));
        $totalEncData = substr_replace($totalEncData, $substring, 34, 16);

        $fileType = $request->input("fileType");
        $fileName=now()->format("dmYHis").$fileType;

        $path="encrypted_files/{$fileName}.enc";
        Storage::put($path, $totalEncData);
        File::create([
            "kullanici_id"=>Auth::user()->id,
            "dosya_tanim"=>$pass,
            "dosya_orj_adi"=>$originalName,
            "dosya_adi"=>$fileName,
            "dosya_ex"=>$extension,
            "dosya_yolu"=>$path
        ]);
        return  response()->json([
            "data"=>"Kayıt işlemi Başarılı"
        ]);
    }
    public function download($id){
     
        $file =File::find($id);
        $key =$file->dosya_tanim;
        
        $path = $file->dosya_yolu;
        $fileContent = Storage::get($path);
        $hashedKey = hash('sha256', $key);

        $substring = strtolower(substr($fileContent, 34, 16));
        $totalEncData = substr_replace($fileContent, $substring, 34, 16);

        $pureData = substr($totalEncData, 64);
        $pureData = substr($fileContent, 64);
        $decdata = decrypt($pureData);

        $fileName=$file->dosya_orj_adi.".".$file->dosya_ex;

        if (in_array($file->dosya_ex, ["jpg", "jpeg","png","pdf","docx","xlsx"])) {
            $base64Data = base64_encode($decdata);
            switch ($file->dosya_ex) {
                case 'jpg':
                    $mimeType='image/jpeg';
                    break;
                case 'jpeg':
                    $mimeType = 'image/jpeg';
                    break;
                case 'png':
                    $mimeType = 'image/png';
                    break;
                case 'pdf':
                    $mimeType = 'application/pdf';
                    break;
                case 'docx':
                    $mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                    break;
                case 'xlsx':
                    $mimeType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                    break;
                default:
                    $mimeType = 'application/octet-stream'; 
                    break;
            }
            return response()->make(
                base64_decode($base64Data), // Base64 verisini çöz
                200,
                [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
                ]
            );
        }
    

        return response($decdata)
        ->header('Content-Type', 'text/plain')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
            
    }

}
