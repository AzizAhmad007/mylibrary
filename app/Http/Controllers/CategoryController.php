<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return $category;
    }

    public function store(Request $request)
    {
        try {
            $category = $request->validate([
                'name_category' => 'required',
                'description' => 'required',
            ]);

            //$category = $request->all();
            Category::create($category);

            return response()->json([
                'message' => 'success',
                'statusCOde' => 200,
                "data" => $category
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
        $category = Category::find($id);
        return $category;
    }

    public function update(Request $request, $id)
    {
        try {
            $category = $request->validate([
                'name_category' => 'required',
                'description' => 'required',
            ]);

            $category = Category::find($id);
            $data = $request->all();
            $category->update($data);

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
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'delete success']);
    }
}
