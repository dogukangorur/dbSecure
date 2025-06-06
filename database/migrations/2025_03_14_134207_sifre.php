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
        Schema::create("sifre",function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('kullanici_id');
            $table->foreign("kullanici_id")         
                ->references("id")                 
                ->on("users")                      
                ->onDelete("cascade");
            $table->string("sifre_adi");
            $table->string("sifre");
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
