<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return $category;
    }

    public function store(Request $request)
    {
        $data = Auth::user();
        //dd($data);
        try {
            $category = $request->validate([
                'name' => 'required',
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
            $category = Category::find($id);
            if ($category == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $category;

            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $category
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
            $category = $request->validate([
                'name' => 'required',
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
            $category = Category::find($id);
            if ($category == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $category = Category::find($id);
            $category->delete();

            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $category
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
