<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class departmentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
            $departments = Department::with('employee')->get();
            return response()->json([
                'status'=>'succses',
                'departments'=>$departments
            ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|string',
                'description'=>'required|string',
                
            ]);
        try {
            $department = Department::create([
                'name'        => $request->name,
                'description' => $request->description
            ]);
           
            return response()->json([
                'status'=>'succses',
                'department'=>$department
            ]);}
            catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }

    public function update(Request $request, Department $department)
    {
        try {
            $department->name = $request->input('name') ?? $department->name;
            $department->description = $request->input('description') ?? $department->description;
            $department->save();
            return response()->json([
                'status'=>'succses',
                'department'=>$department
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
    public function destroy(Department $department)
    {
        {
            $department->delete();
            return response()->json([
                'status'=>'department Deleted',
                
            ]);
        }
    }
    public function restore(String $id)
    {
        try {
            $department = Department::withTrashed()->findOrFail($id);
            $department->restore();
            return response()->json([
                'status'=>'succses',
                'department'=> $department($department)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }
    
    public function forceDelete(Department $department)
    {
        try {
            $department->forceDelete();
            return response()->json([
                'status'=>'department force deleted successfully',
                
            ]);
           
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                
            ]);
        }
    }


}


