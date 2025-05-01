<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
class Card extends Model
{
    use HasFactory;

    protected $table = 'kart';
    protected $fillable = ["kullanici_id",'kart_adi', 'kart_no', 'skt', 'cvv'];   
}
