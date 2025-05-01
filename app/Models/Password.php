<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Password extends Model
{
    use HasFactory;

    protected $table = 'sifre';
    protected $fillable = ["kullanici_id","kullanici_adi",'sifre_adi', 'sifre'];

}
