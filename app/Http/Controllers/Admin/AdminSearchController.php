<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\School;

class AdminSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $search = $request->search;

         if($search!= ""){
            $students = Admission::where(function ($query) use ($search){
                $query->where('rolls.username', 'like', '%'.$search.'%')
                        ->Orwhere('admissions.first_name',$search)
                        ->Orwhere('levels.level',$search)
                        ->Orwhere('admissions.last_name',$search);
                    })
                        ->join('rolls', 'rolls.student_id', 'admissions.id')
                        ->join('schools', 'schools.id', 'admissions.school_id')
                        ->join('levels', 'levels.id', 'admissions.degree_id')
                        ->select('levels.level','rolls.username', 'admissions.first_name', 'admissions.last_name'
                        ,'admissions.image', 'schools.name')
                        ->orderBy('schools.name')
                        ->orderBy('levels.level')
                        ->paginate(10);

            $students->appends(['search' => $search]);
        }
        else {
            $students = Admission::join('rolls', 'rolls.student_id', 'admissions.id')
                            ->join('schools', 'schools.id', 'admissions.school_id')
                            ->join('levels', 'levels.id', 'admissions.degree_id')
                            ->select('levels.level','rolls.username', 'admissions.first_name', 'admissions.last_name'
                            ,'admissions.image', 'schools.name')
                            ->orderBy('schools.name')
                            ->orderBy('levels.level')
                            ->paginate(10);
        }   

        
    
                            return view('admins.search.all-students', ['students' => $students]);
    }

    public function searchTeacher(Request $request)
    {
          $search = $request->search;

         if($search!= ""){
            $teachers = Teacher::where(function ($query) use ($search){
                $query->where('teachers.roll_no', 'like', '%'.$search.'%')
                        ->Orwhere('teachers.first_name',$search)
                        ->Orwhere('teachers.last_name',$search);
                    })
                        ->join('schools', 'schools.id', 'teachers.school_id')
                        ->select('teachers.first_name', 'teachers.last_name'
                        ,'teachers.image', 'schools.name', 'teachers.roll_no', 'teachers.nationality')
                        ->orderBy('schools.name')
                        ->paginate(10);
                    // return $teachers;

            $teachers->appends(['search' => $search]);
        }
        else {
            $teachers = "No Data Found";
        }

       return view('admins.search.all-teachers', ['teachers' => $teachers]);
    }


        public function searchSchool(Request $request)
    {
          $search = $request->search;

         if($search!= ""){
            $schools = School::where(function ($query) use ($search){
                $query->where('schools.name', 'like', '%'.$search.'%')
                        ->Orwhere('institute.address',$search)
                        ->Orwhere('institute.establish',$search);
                    })
                        ->join('institute', 'institute.school_id', 'schools.id')
                        ->select('institute.phoneNo', 'institute.establish'
                        ,'institute.image', 'schools.name', 'schools.id', 'schools.is_active')
                        ->orderBy('schools.name')
                        ->paginate(10);
                    // return $schools;

            $schools->appends(['search' => $search]);
        }
        else {
            $schools = "No Data Found";
        }

       return view('admins.search.all-schools', ['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
