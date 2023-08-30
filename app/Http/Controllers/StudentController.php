<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // auth routes
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

    public function fetchStudentData(Request $request)
    {
        // $query = Student::all();
        $query = Student::select('id', 'name', 'class', 'section', 'email');
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->orWhere('name', 'like', '%' . $request->search . '%');
                $q->orWhere('class', 'like', '%' . $request->search . '%');
                $q->orWhere('email', 'like', '%' . $request->search . '%');
                $q->orWhere('section', 'like', '%' . $request->search . '%');
            });
        }

        $students = $query->get();

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

    public function update(Request $request, $id)
    {
        // update data
        $student = Student::find($id);

        $student->name = $request->name;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->email = $request->email;

        $student->update();

        return response()->json();
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();

        return response()->json();
    }
}
