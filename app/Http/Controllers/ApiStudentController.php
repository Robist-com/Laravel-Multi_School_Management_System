<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Roll;
use Session;

class ApiStudentController extends Controller
{
    public function getStudent(Request $request)
    {
        $studentCount = Roll::where(['username' => Session::get('studentSession')])->count();
        // dd($studentCount); die;

    // if($studentCount > 0){
    //     Session::put('studentSession', $student['username']);
    // }
//   return view('welcome', compact('studentCount'));
        return $request;
    }
}
