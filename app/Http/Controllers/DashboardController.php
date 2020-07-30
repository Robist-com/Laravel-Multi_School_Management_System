<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Repositories\AttendanceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
// use Illuminate\Http\Request; 
use App\models\Batch;
use App\models\Classes;
use App\models\ClassRoom;
use App\models\Course;
use App\models\Day;
use App\models\Level;
use App\models\Semester;
use App\models\Shift;
use App\models\Time;
use App\models\ClassSchedule;
use App\models\Admission;
use App\models\Teacher;
use App\Department;
use App\Faculty;
use App\models\FeeStructure;
use App\models\ClassAssigning;
use DB;

class DashboardController extends Controller
{

public function index()
{
    $batchCount = Batch::count();
    // $batchCount = Batch::count(); // this function ccount count the batch from the batch table but we are using modal okay.
    // $studentsCount = Admission::count(); 
    // $classCount = Classes::count();
    // $courseCount = Course::count();
    // $dayCount = Day::count();
    // $levelCount = Level::count();
    // $semesterCount =  Semester::count();
    // $shiftCount = Shift::count();
    // $timeCount = Time::count();
    // $classroomCount = ClassRoom::count();
    // $teachersCount = Teacher::count();
    // $classasignCount = ClassAssigning::count();
    // $classschedulCount = ClassSchedule::count();
    // $facultyCount = Faculty::count();
    // $departmentCount = Department::count();
    // $feeStructureCount = FeeStructure::count();
    dd( $batchCount);
    // return view('home', compact('batchCount'));
    // return view('admins.dashboard1', compact('batchCount',
    // 'studentsCount','classCount','courseCount','dayCount',
    // 'levelCount','semesterCount','shiftCount','timeCount',
    // 'classroomCount','teachersCount','classschedulCount','classasignCount',
    // 'facultyCount','departmentCount','feeStructureCount'));

}
}
