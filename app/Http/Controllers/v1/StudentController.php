<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Exception;

class StudentController extends Controller
{
    // Show All data 
    public function index()
    {
        $students = Student::get();
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully get all students',
            'data' => $students
        ], 200);
    }

    // Store data to database
    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        try {
            $student = Student::create($data);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to add new student',
                'data' => []
            ], 400);
        }
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully add new student',
            'data' => $student
        ], 200);

    }

    // Show data by id
    public function show($id)
    {
        try {
            $student = Student::findOrFail($id);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to find student',
                'data' => []
            ], 400);
        }
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully get student information',
            'data' => $student
        ]);
    }

    // Update data by id
    public function update(StudentRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $student = Student::findOrFail($id);
            $student->update($data);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to update student',
                'data' => []
            ], 400);
        }
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully update student information',
            'data' => $student
        ]);
    }

    // Delete daya by id
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to delete student',
                'data' => []
            ], 400);
        }
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully delete student information',
            'data' => []
        ]);
    }
}
