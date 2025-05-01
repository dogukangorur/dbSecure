<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'last_login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($user->isDirty('last_login')) {
                DB::table('giris_log')->insert([
                    'kullanici_id' => $user->id,
                    'login_date' => now(),
                ]);

                // Kullanıcının son 10 kaydı dışında kalanları sil
                DB::table('giris_log')
                    ->where('kullanici_id', $user->id)
                    ->orderBy('login_date', 'asc')
                    ->limit(1)
                    ->offset(10)
                    ->delete();
            }
        });
    }
}
