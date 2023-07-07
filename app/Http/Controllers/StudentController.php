<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $all_students = Student::get();
        return view('welcome', compact('all_students'));
    }
    public function store(Request $data){
        // dd($data->input());
        // echo $data->name;
        $data->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $student = new Student;
        $student->name = $data->name;
        $student->email = $data->email;
        $student->save();

        return redirect()->route('home')->with('success','Data is added successfully');
    }
    public function edit($id){
        $student_single =Student::where('id',$id)->first();
        return view('edit', compact('student_single'));
    }
    public function update(Request $data , $id){
        $data->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
        // dd($data->input());
        $student = Student::where('id',$id)->first();
        $student->name = $data->name;
        $student->email = $data->email;
        $student->update();
        return redirect()->route('home')->with('success','Data is updated successfully');
    }

    public function delete($id){
        $student = Student::where('id',$id)->first();
        $student->delete();
        return redirect()->route('home')->with('success','Data is deleted successfully');
    }
}
