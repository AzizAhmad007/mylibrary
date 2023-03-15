<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

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
            $code = "CUS" . date('mY') . sprintf("%03d", $newID);
            //masukkan formatted code kedalam customer[code]
            $customer['code'] = $code;
            Customer::create($customer);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $customer
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
            $customer = Customer::find($id);
            if ($customer == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $customer;

            return response()->json([
                'message' => 'Data Ditemukan',
                'statusCode' => 200,
                'data' => $customer
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
            $customer = Customer::find($id);
            if ($customer == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $customer->delete();
            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $customer
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
