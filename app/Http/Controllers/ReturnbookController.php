<?php

namespace App\Http\Controllers;

use App\Models\Returnbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use DateTime;

class ReturnbookController extends Controller
{
    public function index()
    {
        $returnbook = Returnbook::all();
        return $returnbook;
    }
    public function store(Request $request)
    {
        try {
            $returnbook = $request->validate([
                'rent_code' => 'required',
                'customer_code' => 'required',
                'user_id' => 'required',
                'date_return' => 'required',
                'rent_date_promise' => 'required',
            ]);

            //$returnbook = $request->all();
            $return = new DateTime($returnbook['date_return']);
            $promise = new DateTime($returnbook['rent_date_promise']);

            $diff = date_diff($promise, $return);
            $charge = $diff->days * 5000;

            $returnbook['charge'] = $charge;
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

    public function show($id)
    {
        try {
            $returnbook = Returnbook::find($id);
            if ($returnbook == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $returnbook;
            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $returnbook
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
