<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $user = Auth::create([
            'nama'=> $request->nama,
            'username'=> $request->username,
            'no_telp'=> $request->no_telp,
            'password'=> bcrypt($request->password),
        ]);

        // make token automatically when customer register
        $token = $user->CreateToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response([
            $response,
            'message' => 'Anda berhasil login!'
        ],201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // check email in database where $fields base on customer input
        $user = Auth::where('username', $fields['username'])->first();

        // check password in database where $fields base on customer input value
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'password atau username salah!'
            ],401);
        }


        // print new token
        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' =>$user,
            'token' =>$token
        ];

        return response($response,201);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return[
            'message'=>"Anda berhasil logout, silahkan login!"
        ];
    }
}