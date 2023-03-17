<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => $token
                ]);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                //'error' => $e->getMessage(),
                'error' => 'Terjadi kesalahan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function getUser()
    {
        try {
            $data = User::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                //'error' => $e->getMessage(),
                'error' => 'Terjadi kesalahan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
}
