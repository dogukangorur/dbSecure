<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;


class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        DB::table('users')->where('id', $user->id)->update([
            'last_login' => now()
        ]);
        DB::table('giris_log')->insert([
            "kullanici_id"=>$user->id,
            'login_date' => now()
        ]);
        
     
        $logCount = DB::table('giris_log')
        ->where('kullanici_id', $user->id)
        ->count();

     
        if ($logCount > 10) {
            DB::table('giris_log')
                ->where('kullanici_id', $user->id)
                ->orderBy('login_date', 'asc')  
                ->limit(1)  
                ->delete();  
              }
    }
}
