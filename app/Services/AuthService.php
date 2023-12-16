<?php


namespace App\Services;

use App\Models\Otp;
use App\Models\User;

class AuthService
{
    public function client(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' =>  $data['email'],
            'phone' =>  $data['phone'],
        ]);
        return $user;
    }

    public function otp(array $data,$user)
    {
        $otp = Otp::create([
            'user_id' => $user->id,
            'code' => rand(1000,9999),
            'expire' =>  now()->addMinute(30),
        ]);
        return $otp;
    }

    public function purn($user)
    {
        $otp =  Otp::whereUser_id($user->id)->latest()->first();
        Otp::whereUser_id($user->id)->delete();
    }
}
