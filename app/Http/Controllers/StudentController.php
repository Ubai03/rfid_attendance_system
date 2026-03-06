<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('students', compact('students'));
    }

    public function store(Request $request)
    {
        Student::create([
            'name' => $request->name,
            'matric_no' => $request->matric_no,
            'course' => $request->course,
            'rfid_code' => $request->rfid_code
        ]);

        return redirect()->route('students');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->update([
            'name' => $request->name,
            'matric_no' => $request->matric_no,
            'course' => $request->course,
            'rfid_code' => $request->rfid_code
        ]);

        return redirect()->route('students')->with('success','Student updated');
    }

    public function destroy($id)
    {
        Student::destroy($id);

        return redirect()->route('students')->with('success','Student deleted');
    }
}