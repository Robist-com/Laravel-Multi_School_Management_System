<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherSalaryController extends Controller
{
    public function index(Request $request)
    {
        return view('teachers.salaries.index');
    }
}