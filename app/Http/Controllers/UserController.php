<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function store(Request $request)
    {
        try {
            $user = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'level' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);

            //$user = $request->all();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => $request->level,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => Hash::make($request->password)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => $e->getMessage(),
                //'error' => 'Terjadi kesalahan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            if ($user == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $user;

            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => 'Data tidak ditemukan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'level' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);

            $user = User::find($id);
            $user = $request->all();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => $request->level,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => Hash::make($request->password)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => $e->getMessage(),
                //'error' => 'Terjadi kesalahan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $user = User::find($id);
            $user->delete();

            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => 'Data tidak ditemukan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
}
