<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("kart",function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('kullanici_id');
            $table->foreign("kullanici_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("kart_adi",50);
            $table->string("kart_no",20);
            $table->string("skt",10);
            $table->string("cvv",10);
            $table->timestampsTz();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
