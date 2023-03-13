<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Http\Controllers\Controller;
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
        $data = $request->all();

        Rack::create($data);

        return response()->json(['message' => 'success']);
    }

    public function show($id)
    {
        $rack = Rack::find($id);
        return $rack;
    }

    public function update(Request $request, $id)
    {
        $rack = Rack::find($id);
        $data = $request->all();

        $rack->update($data);

        return response()->json(['message' => 'update success']);
    }

    public function destroy($id)
    {
        $rack = Rack::find($id);
        $rack->delete();
        return response()->json(['message' => 'delete success']);
    }
}
