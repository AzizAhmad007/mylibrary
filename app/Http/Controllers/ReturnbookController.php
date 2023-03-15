<?php

namespace App\Http\Controllers;

use App\Models\Returnbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class ReturnbookController extends Controller
{
    public function store(Request $request)
    {
        try {
            $returnbook = $request->validate([
                'rent_code' => 'required',
                'date_return' => 'required',
                'employee_id' => 'required'
            ]);

            //$returnbook = $request->all();
            Returnbook::create($returnbook);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $returnbook
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
