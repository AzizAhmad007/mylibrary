<?php

namespace App\Http\Controllers;

use App\Models\Rentdetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class RentdetailController extends Controller
{
    public function index()
    {
        $rentdetail = Rentdetail::all();
        return $rentdetail;
    }

    public function show($id)
    {
        try {
            $rentdetail = Rentdetail::find($id);
            if ($rentdetail == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $rentdetail;

            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $rentdetail
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

    public function store(Request $request)
    {
        try {
            $rentdetail = $request->validate([
                'rent_code' => 'required',
                'book_code' => 'required',
            ]);

            //$category = $request->all();
            Rentdetail::create($rentdetail);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => $rentdetail
            ]);
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

    public function update(Request $request, $id)
    {
        try {
            $rentdetail = $request->validate([
                'rent_code' => 'required',
                'book_code' => 'required',
            ]);
            $rentdetail = Rentdetail::find($id);
            $data = $request->all();

            $rentdetail->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                'data' => $data
            ]);
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

    public function destroy($id)
    {
        try {
            $rentdetail = Rentdetail::find($id);
            if ($rentdetail == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $rentdetail = Rentdetail::find($id);
            $rentdetail->delete();

            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $rentdetail
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
