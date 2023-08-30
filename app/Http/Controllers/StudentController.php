<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('student.view');
    }

    public function create()
    {
        $data = [
            'scope' => 'create'
        ];
        return view('student.form')->with($data);
    }

    public function store(Request $request)
    {
        // send data to database
        $student = new Student;

        $student->name = $request->name;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->email = $request->email;

        $student->save();

        return response()->json();
    }

    public function fetchStudentData()
    {
        $students = Student::all();
        return $students;
    }

    public function edit($id)
    {
        $data = [
            'scope' => 'edit',
            'id' => $id
        ];

        return view('student.form')->with($data);
    }

    public function editData($id)
    {
        $student = Student::find($id);
        return response()->json([
            'status' => 200,
            'data' => $student
        ]);
    }
}
