<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        // 'code',
        // 'expire',
    ];

    // public function generateCode()
    // {
    //     $this->timestamps = false;
    //     $this->code = rand(1000,9999);
    //     $this->expire = now()->addMinute(30);
    //     $this->save();
    // }

    // public function deleteCode()
    // {
    //     $this->timestamps = false;
    //     $this->code = null;
    //     $this->expire = null;
    //     $this->save();
    // }

    public function purchases()
    {
        $this->hasMany(Purchase::class);
    }

    public function otps()
    {
        $this->hasMany(Otp::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
