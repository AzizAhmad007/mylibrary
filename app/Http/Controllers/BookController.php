<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::all();
        return $book;
    }

    public function store(Request $request)
    {
        try {
            $book = $request->validate([
                'rack_id' => 'required',
                'category_id' => 'required',
                'book_title' => 'required',
                'book_author' => 'required',
                'publisher_book' => 'required',
                'publisher_year' => 'required',
                'stock' => 'required'
            ]);
            //$book = $request->all();
            // Ambil record terakhir
            $data = Book::orderBy('id', 'desc')->first();
            //$ddata[0]->id
            if ($data == NULL) {
                // jika buku tidak ditemukan set last ID = 1
                $lastID = 1;
            } else {
                // jika buku ditemukan set last ID = ID buku terakhir
                $lastID = $data->id;
            }
            //set new id = last id ditambah 1
            $newID = $lastID + 1;
            // format code
            $code = "BOK" . date('mY') . sprintf("%03d", $newID);
            // masukkan formatted code kedalam buku[code]
            $book['code'] = $code;
            Book::create($book);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $book
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

        $book = Book::find($id);
        return $book;
    }

    public function update(Request $request, $id)
    {
        try {
            $book = $request->validate([
                "rack_id" => 'required',
                "category_id" => 'required',
                "book_title" => 'required',
                "book_author" => 'required',
                "publisher_book" => 'required',
                "publisher_year" => 'required',
                "stock" => 'required'
            ]);

            $book = Book::find($id);
            $data = $request->all();
            $book->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'error kesalahan saat update data',
                'statusCode' => 400,
                "data" => null
            ]);
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json(['message' => 'delete success']);
    }
}
