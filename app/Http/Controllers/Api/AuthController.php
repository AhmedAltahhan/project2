<?php

namespace App\Http\Controllers\Api;

use App\Events\LoginEvent;
use App\Events\SignupEventSubscriber;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\OtpResource;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\Code;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete;
        return response()->json(['message' => "logged Out"],200);
    }

    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();
        // $user->generateCode();

        $otp = $this->authService->otp($request->validated(),$user);
        event(new LoginEvent($otp->code));

         $otp = Otp::with('user')->whereUserId($user->id)->latest()->first();
        $mail = OtpResource::make($otp);
        $mail->notify(new Code);

        return AuthResource::make($user);
        // return response()->json(['data' => $user ,'error' => ''],200);
    }

    public function verify(OtpRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $otp = Otp::whereUser_id($user->id)->latest()->first();

        if ($request->code == $otp->code)
        {
            $token = $user->createToken('Auth-Token')->plainTextToken;
            return response()->json(['data' => $user,'message' => "Welcome ",'Token' => $token],200);
        }
    }

    public function register(SignupRequest $request)
    {
        $user = $this->authService->client($request->validated());
        event(new SignupEventSubscriber($user));
        return AuthResource::make($user);
        // return response()->json(['data' => $user ,'error' => ''],200);
    }

    public function purn()
    {
        $user = auth()->user();
        $this->authService->purn($user);
        return response()->json(['message' => "Done ",],200);
    }
}
