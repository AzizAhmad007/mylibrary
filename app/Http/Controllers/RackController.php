<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index()
    {
        $rack = Rack::all();
        return $rack;
    }

    public function store(Request $request)
    {
        try {
            $rack = $request->validate([
                'name_rack' => 'required',
                'location_rack' => 'required'
            ]);

            //$data = $request->all();
            Rack::create($rack);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $rack
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

    public function show($id)
    {
        $rack = Rack::find($id);
        return $rack;
    }

    public function update(Request $request, $id)
    {
        try {
            $rack = $request->validate([
                'name_rack' => 'required',
                'location_rack' => 'required'
            ]);
            $rack = Rack::find($id);
            $data = $request->all();

            $rack->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                'data' => $data
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

    public function destroy($id)
    {
        $rack = Rack::find($id);
        $rack->delete();
        return response()->json(['message' => 'delete success']);
    }
}
