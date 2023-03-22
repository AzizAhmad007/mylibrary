<?php

namespace App\Http\Controllers;

use App\Models\Returndetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class ReturndetailController extends Controller
{
    public function index()
    {
        $returndetail = Returndetail::all();
        return $returndetail;
    }

    public function store(Request $request)
    {
        try {
            $returndetail = $request->validate([
                'returnbook_id' => 'required',
                'book_code' => 'required',
            ]);

            Returndetail::create($returndetail);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => $returndetail
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

    public function show($id)
    {
        try {
            $returndetail = Returndetail::find($id);
            if ($returndetail == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $returndetail;

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => $returndetail
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
            $returndetail = $request->validate([
                'returnbook_id' => 'required',
                'book_code' => 'required',
            ]);

            $returndetail = Returndetail::find($id);
            $data = $request->all();

            $returndetail->update($data);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => $data
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
}
