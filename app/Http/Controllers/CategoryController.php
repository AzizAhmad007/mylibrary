<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
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
        $category = $request->all();

        Category::create($category);

        return response()->json(['message' => 'success']);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();

        $category->update($data);

        return response()->json(['message' => 'update success']);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'delete success']);
    }
}
