<?php

namespace App\Http\Controllers;

use App\Models\Returnbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnbookController extends Controller
{
    public function store(Request $request)
    {
        try {
            $returnbook = $request->validate([
                'rent_code' => 'required',
                'rent_return_date' => 'required',
                'charge' => 'required'
            ]);

            //$returnbook = $request->all();
            $data = new Returnbook();
            $data->rent_code = $request->rent_code;
            $data->rent_return_date = $request->rent_return_date;
            Returnbook::create($data);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $returnbook
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat insert data',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
}
