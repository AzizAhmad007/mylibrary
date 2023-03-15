<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

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
            $employee = Employee::find($id);
            if ($employee == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $employee;
            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $employee
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
            $employee = Employee::find($id);
            if ($employee == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $employee->delete();
            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $employee
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
