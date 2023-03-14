<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        return $employee;
    }

    public function store(Request $request)
    {
        try {
            $employee = $request->validate([
                'name_employee' => 'required',
                'email' => 'required',
                'position_employee' => 'required',
                'phone_employee' => 'required',
                'address_employee' => 'required',
            ]);
            //$employee = $request->all();
            Employee::create($employee);

            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $employee
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat insert data',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = $request->validate([
                'name_employee' => 'required',
                'email' => 'required',
                'position_employee' => 'required',
                'phone_employee' => 'required',
                'address_employee' => 'required',
            ]);

            $employee = Employee::find($id);
            $data = $request->all();
            $employee->update($data);

            return response()->json([
                'message' => 'update success',
                'statusCode' => 200,
                'data' => $employee
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error kesalahan saat update data',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'delete success']);
    }
}
