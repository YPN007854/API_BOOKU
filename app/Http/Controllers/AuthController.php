<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'Email' => 'required',
            'Password' => 'required',
        ]);

        $user = User::where('Email', $data['Email'])->first();

        // if (Auth::attempt($data)) {
        //     return response()->json([
        //         'message' => 'Login berhasil!',
        //         'user' => Auth::user(),
        //     ], 200);
        // }

        if ($data['Email'] && Hash::check($data['Password'], $user->Password)) {
            // $request->session()->regenerate();

            return response()->json([
                "message" => "Login Successfully",
                'data' => $data
            ], 200);
        }


        throw ValidationException::withMessages([
            'email' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
        ]);

        // try {
        //     $credentials = $request->validate([
        //         'Email' => 'required',
        //         'Password' => 'required',
        //     ]);

        //     if (Auth::attempt($credentials)) {
        //         $request->session()->regenerate();

        //         return response()->json([
        //             "message" => "Login Successfully",
        //             'data' => $credentials
        //         ], 200);
        //     }

        //     return response()->json([
        //         'message' => 'Authentication failed'
        //     ], 401);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'error' => $e->getMessage(),
        //     ], 400);
        // }
    }


    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                "NamaLengkap" => "required",
                "Username" => "required",
                "Email" => "required|email|unique:users",
                "Password" => "required|min:3",
                "Alamat" => "required"
            ]);
            $data["Password"] = Hash::make($data["Password"]);
            $newuser = User::create($data);
            $res = [
                'message' => 'succes create data',
                'data' => $newuser
            ];
            return response()->json($res);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ], 400);
        }
    }
}
