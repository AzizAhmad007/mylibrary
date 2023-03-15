<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        $rent = Rent::all();
        return $rent;
    }
    public function store(Request $request)
    {
        try {
            $rent = $request->validate([
                'book_id' => 'required',
                'customer_id' => 'required',
                'employee_id' => 'required',
                'date_rent' => 'required',
                'date_return' => 'required'
            ]);
            //$rent = $request->all();
            // Ambil record terakhir
            $data = Rent::orderBy('id', 'desc')->first();
            //$ddata[0]->id
            if ($data == NULL) {
                // jika rent tidak ditemukan set last ID = 1
                $lastID = 1;
            } else {
                // jika rent ditemukan set last ID = ID customer terakhir
                $lastID = $data->id;
            }
            //set new id = last id ditambah 1
            $newID = $lastID + 1;
            // format code
            $code = "RNT" . date('mY') . sprintf("%03d", $newID);
            //masukkan formatted code kedalam rent[code]
            $rent['code'] = $code;
            Rent::create($rent);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $rent
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
            $rent = $request->validate([
                'code' => 'required',
                'book_id' => 'required',
                'customer_id' => 'required',
                'employee_id' => 'required',
                'date_rent' => 'required',
                'date_return' => 'required'
            ]);

            $rent = Rent::find($id);
            $data = $request->all();
            $rent->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
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

    public function show($id)
    {
        try {
            $rent = Rent::find($id);
            if ($rent == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $rent;
            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $rent
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

    public function destroy($id)
    {
        try {
            $rent = Rent::find($id);
            if ($rent == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $rent->delete();
            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $rent
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
