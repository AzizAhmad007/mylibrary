<?php

namespace App\Http\Controllers;

use App\Models\Returnbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnbookController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $data = new Returnbook();
        $data->rent_code = $request->rent_code;
        $data->rent_return_date = $request->rent_return_date;
        Returnbook::create($data);
        return response()->json(['message' => 'success']);
    }
}
