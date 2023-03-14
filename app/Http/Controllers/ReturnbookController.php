<?php

namespace App\Http\Controllers;

use App\Models\Returnbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class ReturnbookController extends Controller
{
    public function store(Request $request)
    {
        try {
            $returnbook = $request->validate([
                'rent_code' => 'required',
                'rent_return_date' => 'required',

            ]);

            $rent = DB::connection('mysql')->select("select * from rents where code = '$request->rent_code'");
            $rent_return_date = date_timestamp_get($rent[0]->return_date);
            $rent_return_date = idate('z', $rent_return_date);
            $return_date = idate('z');

            $datedifference = $return_date - $rent_return_date;

            $data = new Returnbook();
            $data->rent_code = $request->rent_code;
            $data->rent_return_date = now();

            if ($datedifference <= 7) {
                $data->charge = 0;
            } else {
                $data->charge = ($datedifference - 7) * 5000;
            }
            Returnbook::create($data);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $returnbook
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => $e->getMessage(),
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
}
