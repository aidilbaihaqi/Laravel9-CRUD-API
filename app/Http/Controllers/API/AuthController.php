<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;


class AuthController extends Controller
{
    public function register(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'message' => 'Berhasil register',
            'token'=>$token
        ], 200);
    }
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)) {
            $token = Auth::user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'message' => 'Berhasil login',
                'token'=>$token
            ], 200);
        }else {
            return response()->json(['error'=>'Cannot Login'], 401);
        }
    }
    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
            'message' => 'Berhasil logout'
        ]);

    }
}
