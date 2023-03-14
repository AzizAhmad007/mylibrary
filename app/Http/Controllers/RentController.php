<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Http\Controllers\Controller;
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
                'code' => 'required',
                'book_id' => 'required',
                'customer_id' => 'required',
                'employee_id' => 'required',
                'rent_date' => 'required',
                'return_date' => 'required'
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
            $code = "RNT" . date('mY') . sprintf("%04d", $newID);
            //masukkan formatted code kedalam rent[code]
            $rent['code'] = $code;
            Rent::create($rent);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $rent
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat insert data',
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
                'rent_date' => 'required',
                'return_date' => 'required'
            ]);

            $rent = Rent::find($id);
            $data = $request->all();
            $rent->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'error kesalahan saat update data',
                'statusCode' => 400,
                "data" => null
            ]);
        }
    }

    public function show($id)
    {
        $rent = Rent::find($id);
        return $rent;
    }

    public function destroy($id)
    {
        $rent = Rent::find($id);
        $rent->delete();
        return response()->json(['message' => 'delete success']);
    }
}
