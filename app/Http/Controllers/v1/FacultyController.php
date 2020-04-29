<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use Exception;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::get();
        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully get all faculties',
            'data' => $faculties
        ]);
    }

    public function store(FacultyRequest $request)
    {
        $data = $request->validated();
        try {
            $data['user_id'] = auth()->user()->id;
            $faculty = Faculty::create($data);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to add new faculty',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully add new faculties',
            'data' => $faculty
        ]);
    }

    public function show($id)
    {
        try {
            $faculty = Faculty::findOrFail($id);
            return response()->json([
                'status' => 'ok',
                'code' => 200,
                'message' => 'Successfully get faculty',
                'data' => $faculty
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to get faculty',
                'data' => []
            ]);
        }
    }

    public function update(FacultyRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $faculty = Faculty::findOrFail($id)->update($data);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to update faculty',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully update faculty',
            'data' => []
        ]);
    }

    public function destroy($id)
    {
        try {
            $faculty = Faculty::findOrFail($id)->delete();
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to delete faculty',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully delete faculty',
            'data' => []
        ]);
    }

    public function getFacultyStudents($id)
    {
        try {
            $facultyStudents = Faculty::with('students')->findOrFail($id);
            return $facultyStudents;
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed to get faculty students',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'message' => 'Successfully get faculty students',
            'data' => $facultyStudents
        ]);
    }
}
