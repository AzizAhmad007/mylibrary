<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return $customer;
    }

    public function store(Request $request)
    {
        try {
            $customer = $request->validate([
                'code' => 'required',
                'name_customer' => 'required',
                'gender' => 'required',
                'phone_customer' => 'required',
                'address_customer' => 'required'
            ]);
            //$customer = $request->all();
            // Ambil record terakhir
            $data = Customer::orderBy('id', 'desc')->first();
            //$ddata[0]->id
            if ($data == NULL) {
                // jika customer tidak ditemukan set last ID = 1
                $lastID = 1;
            } else {
                // jika customer ditemukan set last ID = ID customer terakhir
                $lastID = $data->id;
            }
            //set new id = last id ditambah 1
            $newID = $lastID + 1;
            // format code
            $code = "CUS" . date('mY') . sprintf("%04d", $newID);
            //masukkan formatted code kedalam customer[code]
            $customer['code'] = $code;
            Customer::create($customer);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $customer
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat insert data',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = $request->validate([
                'code' => 'required',
                'name_customer' => 'required',
                'gender' => 'required',
                'phone_customer' => 'required',
                'address_customer' => 'required'
            ]);
            $customer = Customer::find($id);
            $data = $request->all();
            $customer->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat update data',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'delete success']);
    }
}
