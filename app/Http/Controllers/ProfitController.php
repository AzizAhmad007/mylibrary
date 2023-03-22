<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfitController extends Controller
{
    /**
     * filter
     * @param mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date'  => 'required',
        ]);

        //get data profits by range date
        $profit = Profit::with('returnbook')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        //get total profit by range date
        $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');

        return response()->json([
            'message' => 'success',
            'statusCode' => 200,
            'data' => $profit,
        ]);
    }
}
