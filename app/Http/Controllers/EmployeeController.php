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
        $employee = $request->all();

        Employee::create($employee);

        return response()->json(['message' => 'success']);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $data = $request->all();

        $employee->update($data);

        return response()->json(['message' => 'update success']);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'delete success']);
    }
}
