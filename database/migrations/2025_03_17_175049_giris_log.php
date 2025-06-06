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
        Schema::create("giris_log",function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('kullanici_id');
            $table->foreign("kullanici_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamp("login_date");
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
