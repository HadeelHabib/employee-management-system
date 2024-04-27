<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class employescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            $employee=Employee::with('department')->get();
            return response()->json([
                'status'=>'succses',
                'employee'=>$employee
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'email'=>'required',
                'description'=>'required|string',
                'position'=>'required|string',
                'departments_id'=>'required',
            ]);


            try {
                \DB::beginTransaction();
                $employee=Employee::create([
                    'first_name'=>$request->first_name ,
                    'last_name'=>$request->last_name ,
                    'email'=>$request->email,
                    'description'=>$request->description,
                    'position'=>$request->position,
                    'departments_id'=>$request->departments_id,

    
                ]);
                \DB::commit();
            return response()->json([
                'status'=>'succses',
                'employee'=>$employee
            ]);
            } catch (\Throwable $th) {
                \DB::rollBack();
                
                return response()->json([
                    'status'=>'error',
                    
                ]);
            }
    }


    
    public function update(Request $request, Employee $employee)
    {
        try {
            $employee->department_id = $request->input('department_id') ?? $employee->department_id;
            $employee->first_name = $request->input('first_name') ?? $employee->first_name;
            $employee->last_name = $request->input('last_name') ?? $employee->last_name;
            $employee->email = $request->input('email') ?? $employee->email;
            $employee->position = $request->input('position') ?? $employee->position;

            $employee->save();
            $employees = $employee;
            return response()->json([
                'status'=>'succses',
                'employees'=>$employees
            ]);
        } catch (\Throwable $th) {
          
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'status'=>'Employee Deleted',
            
        ]);
    }
    public function restore(String $id)
    {
        try {
            $employee = Employee::withTrashed()->findOrFail($id);
            $employee->restore();
            return response()->json([
                'status'=>'succses',
                'employees'=>$employee
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }
    
    public function forceDelete(Employee $employee)
    {
        try {
            $employee->forceDelete();
            return response()->json([
                'status'=>'employee force deleted successfully',
                
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }



}
