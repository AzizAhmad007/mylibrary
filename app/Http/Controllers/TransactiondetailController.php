<?php

namespace App\Http\Controllers;

use App\Models\Transactiondetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class TransactiondetailController extends Controller
{
    public function store(Request $request)
    {
        try {
            $Transactiondetail = $request->validate([
                'rent_date_promise' => 'required',
                'returnbook_date_return' => 'required',
            ]);

            //$Transactiondetail = $request->all();
            $promiseTime = $Transactiondetail['rent_date_promise'];
            $returnTime = $Transactiondetail['returnbook_date_return'];
            $moneyFine = 5000;
            if ($returnTime > $promiseTime) {
                $promiseTimeAfterParse = Carbon::parse($promiseTime);
                $returnTimeAfterparse = Carbon::parse($returnTime);
                $diffInDays = $returnTimeAfterparse->diffInDays($promiseTimeAfterParse);
                $charge = $diffInDays * $moneyFine;
            } else {
                $charge = 0;
            }
            $Transactiondetail['charge'] = $charge;
            Transactiondetail::create($Transactiondetail);

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
