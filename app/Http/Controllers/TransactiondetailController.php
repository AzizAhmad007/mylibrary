<?php

namespace App\Http\Controllers;

use App\Models\Transactiondetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class TransactiondetailController extends Controller
{
    public function store(Request $request)
    {
        try {
            $Transactiondetail = $request->validate([
                'rent_date_return' => 'required',
                'returnbook_date_return' => 'required',

            ]);

            $Transactiondetail = $request->all();

            $data = new Transactiondetail();
            $charge = 0;

            // jika tanggal pengembalian kurang dari atau sama dengan tanggal jatuh tempo
            if ($data->returnbook_date_return <= $data->rent_date_return) {
                $charge = 0;

                // jika tanggal pengembalian lebih dari tanggal jatuh tempo
            } else {

                // hitung selisih hari antara tanggal pengembalian dengan tanggal jatuh tempo
                $charge_days = $data->returnbook_date_return->diffInDays($data->rent_date_return);

                // tambahkan denda sesuai dengan selisih hari
                $charge = $charge_days * 5000;
            }
            $data->denda = $charge;
            $data->save();

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $Transactiondetail
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
}
