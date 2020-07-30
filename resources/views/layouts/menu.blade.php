@php
use App\Models\ClassSchedule;
$teacher_id = Auth::user()->teacher_id;
$teacherclass = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->select('semesters.id as semester_id','semesters.*','courses.*',
            'classes.id as class_id','classes.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->first();

@endphp

 @if(Auth::user()->role_id == 1)

 <li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-tachometer" aria-hidden="true"></i><span> Dashboard</span></a>
</li>

<!-- <li class="{{ Request::is('semesters*') ? 'active' : '' }}">
    <a href="{!! route('semesters.index') !!}"><i class="fa fa-edit"></i><span> Grades</span></a>
</li> -->

<!-- <li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-th"></i><span>Courses</span></a>
</li> -->



 <li class="treeview">
<a href="#">
<i class="fa fa-grip-horizontal"></i> <span> General</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
 </a>
<ul class="treeview-menu">

<li class="{{ Request::is('classes*') ? 'active' : '' }}">
    <a href="{!! route('classes.index') !!}"><i class="fa fa-edit"></i><span> Classes</span></a>
</li>

<li class="{{ Request::is('batches*') ? 'active' : '' }}">
    <a href="{!! route('batches.index') !!}"><i class="fa fa-edit"></i><span> Batches</span></a>
</li>

<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('levels*') ? 'active' : '' }}">
    <a href="{!! route('levels.index') !!}"><i class="fa fa-edit"></i><span> Levels</span></a>
</li>

<li class="{{ Request::is('days*') ? 'active' : '' }}">
    <a href="{!! route('days.index') !!}"><i class="fa fa-edit"></i><span> Days</span></a>
</li>

<li class="{{ Request::is('shifts*') ? 'active' : '' }}">
    <a href="{!! route('shifts.index') !!}"><i class="fa fa-edit"></i><span> Shifts</span></a>
</li>

<li class="{{ Request::is('times*') ? 'active' : '' }}">
    <a href="{!! route('times.index') !!}"><i class="fa fa-edit"></i><span> Times</span></a>
</li>

<li class="{{ Request::is('classRooms*') ? 'active' : '' }}">
    <a href="{!! route('classRooms.index') !!}"><i class="fa fa-edit"></i><span> Class Rooms</span></a>
</li>

<li class="{{ Request::is('academics*') ? 'active' : '' }}">
    <a href="{!! route('academics.index') !!}"><i class="fa fa-edit"></i><span> Academics</span></a>
</li>

<li class="{{ Request::is('semesters*') ? 'active' : '' }}">
    <a href="{!! route('semesters.index') !!}"><i class="fa fa-edit"></i><span> Grade</span></a>
</li>

 </ul>
 </li>

<!-- ---------------------------------------------------------------- -->
 <li class="treeview">
<a href="#">
 <i class="fa fa-compress"></i> <span> Schedule</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
 </a>
<ul class="treeview-menu">

<li class="{{ Request::is('classSchedules*') ? 'active' : '' }}">
    <a href="{!! route('classSchedules.index') !!}"><i class="fa fa-edit"></i><span> Class Schedules</span></a>
</li>

<!-- <li class="{{ Request::is('classAssignings*') ? 'active' : '' }}">
    <a href="{!! route('classAssignings.index') !!}"><i class="fa fa-edit"></i><span> Class Assignings</span></a>
</li> -->

</ul>
 </li>

 <li class="treeview">
    <a href="#">
        <i class="fa fa-group"></i> <span> Students</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

    <li class="{{ Request::is('students*') ? 'active' : '' }}">
        <a href="{!! url('all/student/list') !!}"><i class="fa fa-edit"></i><span> Student List</span></a>
    </li>

    <!-- <li class="{{ Request::is('classAssignings*') ? 'active' : '' }}">
        <a href="{!! route('classAssignings.index') !!}"><i class="fa fa-edit"></i><span> Class Assignings</span></a>
    </li> -->

    </ul>
     </li>

 <!-- ------------------------------------ FACULTY AND DEPARTMENT---------------------------- -->
 <li class="treeview">
    <a href="#">
     <i class="fa fa-university"></i> <span> Groups</span>
    <span class="pull-right-container">
    <i class="fa fa-university pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('faculties*') ? 'active' : '' }}">
            <a href="{!! route('faculties.index') !!}"><i class="fa fa-edit"></i><span> Student Group</span></a>
        </li>

        <li class="{{ Request::is('departments*') ? 'active' : '' }}">
            <a href="{!! route('departments.index') !!}"><i class="fa fa-building"></i><span> Class Group</span></a>
        </li>
    </ul>
     </li>


</li><li class="{{ Request::is('admissions*') ? 'active' : '' }}">
    <a href="{!! route('admissions.index') !!}"><i class="fa fa-file"></i><span> Admissions</span></a>
</li>



<li class="{{ Request::is('admissions*') ? 'active' : '' }}">
    <a href="{!! url('timetables') !!}"><i class="fa fa-calendar"></i><span> Time Table</span></a>
</li>

 <!-- ------------------------------------ FACULTY AND DEPARTMENT---------------------------- -->
 <li class="treeview">
    <a href="#">
     <i class="fa fa-suitcase"></i> <span> Teachers</span>
    <span class="pull-right-container">
    <i class="fa fa-suitcase pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">
<li class="{{ Request::is('teachers*') ? 'active' : '' }}">
    <a href="{!! route('teachers.index') !!}"><i class="fa fa-plus"></i><span>Add Teacher</span></a>
</li>
<li class="{{ Request::is('teacherlist*') ? 'active' : '' }}">
    <a href="{!! url('teachers/list') !!}"><i class="fa fa-suitcase"></i><span> Teacher List</span></a>
</li>
</ul>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span> Users</span></a>
</li>



<!-- I WILL CODE FROM HERE OKAY -->
{{-- @if(Auth::user()->role_id < 2) --}}
<li class="{{ Request::is('attendances*') ? 'active' : '' }}">
    <a href="{!! route('attendances.index') !!}"><i class="fa fa-calendar"></i><span> Attendances</span></a>
</li>
 @if(Auth::user()->role_id == 2)
<li class="{{ Request::is('enter-subject-detail*') ? 'active' : '' }}">
    <a href="{!! url('enter-subject-detail') !!}"><i class="fa fa-edit"></i><span> Assign Subjects</span></a>
</li>
@endif

<!-- ---------------------------------------------------------------- -->
<li class="treeview">
    <a href="#">
     <i class="fa fa-money"></i> <span>Fees</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

   <li class="{{ Request::is('fees*') ? 'active' : '' }}">
        <a href="{{ url('view/fee/collection') }}"><i class="fa fa-edit"></i><span>Fee Collection</span></a>
    </li>
    <li class="{{ Request::is('fees*') ? 'active' : '' }}">
        <a href="{{ url('student/list/fee/collection') }}"><i class="fa fa-edit"></i><span>Student Fee Collection</span></a>
    </li>

    <li class="{{ Request::is('feeStructures*') ? 'active' : '' }}">
        <a href="{{ route('feeStructures.index') }}"><i class="fa fa-edit"></i><span>Fee Structures</span></a>
    </li>

    <li class="{{ Request::is('studentFees*') ? 'active' : '' }}">
        <a href="{{ route('studentFees.index') }}"><i class="fa fa-edit"></i><span>Student Fees</span></a>
    </li>
    </ul>
</li>


<li class="treeview">
    <a href="#">
     <i class="fa fa-money"></i> <span>Report</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

    <li class="{{ Request::is('fees*') ? 'active' : '' }}">
        <a href="{{ route('Reports') }}"><i class="fa fa-edit"></i><span>Reports</span></a>
    </li>

    <li class="{{ Request::is('fees*') ? 'active' : '' }}">
        <a href="{{ route('getFeeReport') }}"><i class="fa fa-file"></i><span>Fees Report</span></a>
    </li>

    <li class="{{ Request::is('feeStructures*') ? 'active' : '' }}">
        <a href="{{ route('feeStructures.index') }}"><i class="fa fa-edit"></i><span>Fee Structures</span></a>
    </li>

    <li class="{{ Request::is('studentFees*') ? 'active' : '' }}">
        <a href="{{ route('studentFees.index') }}"><i class="fa fa-edit"></i><span>Student Fees</span></a>
    </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
     <i class="fa fa-money"></i> <span>Salaries</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

<li class="{{ Request::is('teacherSalaries*') ? 'active' : '' }}">
    <a href="{{ route('teacherSalaries.index') }}"><i class="fa fa-edit"></i><span>Teacher Salaries</span></a>
</li>

<li class="{{ Request::is('salaryTypes*') ? 'active' : '' }}">
    <a href="{{ route('salaryTypes.index') }}"><i class="fa fa-edit"></i><span>Salary Types</span></a>
</li>
</ul>
</li>

<li class="{{ Request::is('transactions*') ? 'active' : '' }}">
        <a href="{{ route('transactions.index') }}"><i class="fa fa-money"></i><span>Transactions</span></a>
    </li>

<li class="treeview">
    <a href="#">
     <i class="fa fa-gear"></i> <span> Exam Management </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('examanagements*') ? 'active' : '' }}">
            <a href="{!! url('question') !!}"><i class="fa fa-edit"></i><span> List</span></a>
        </li>

        <li class="{{ Request::is('examanagements*') ? 'active' : '' }}">
            <a href="{!! url('question/create') !!}"><i class="fa fa-edit"></i><span> Add Question</span></a>
        </li>
    </ul>
     </li>

     <li class="{{ Request::is('results*') ? 'active' : '' }}">
        <a href="{!! url('result/home') !!}"><i class="fa fa-list"></i><span> Results Management</span></a>
    </li>

     <li class="treeview">
    <a href="#">
     <i class="fa fa-gear"></i> <span> Settings </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

    <li class="{{ Request::is('school_settings*') ? 'active' : '' }}">
        <a href="{!! url('institute') !!}"><i class="glyphicon glyphicon-cog"></i><span> Institution Settings</span></a>
    </li>
    <li class="{{ Request::is('notice*') ? 'active' : '' }}">
    <a href="{!! route('notice') !!}"><i class="fa fa-th"></i><span>Notice Board</span></a>
    </li>

    </ul>
     </li>

    <li class="treeview">
    <a href="#">
     <i class="fa fa-gear"></i> <span> Mark Management </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
     </a>
    <ul class="treeview-menu">

   <li class="{{ Request::is('examanagements*') ? 'active' : '' }}">
        <a href="{!! url('/mark/create') !!}"><i class="fa fa-home"></i><span>Marks Entry</span></a>
    </li>
    <li class="{{ Request::is('examanagements*') ? 'active' : '' }}">
        <a href="{!! url('/show/mark/list') !!}"><i class="fa fa-list"></i><span>Mark List</span></a>
    </li>
    
    </ul>
     </li>
        {{-- TEACHERS SIDEBAR FEATURES  --}}
     @else

    @if($teacherclass)
    </li><li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a href="{!! url('/home') !!}"><i class="glyphicon glyphicon-dashboard"></i><span> Dashboard</span></a>
    </li>

    <li class="treeview">
        <a href="#">
         <i class="fa fa-calendar"></i> <span>Attendance</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
         </a>
        <ul class="treeview-menu">

    <li class="{{ Request::is('mark-teacher-attendance*') ? 'active' : '' }}">
        <a href="{!! url('mark-teacher-attendance') !!}"><i class="fa fa-pencil"></i><span>Mark Attendance</span></a>
    </li>

    <li class="{{ Request::is('attendance/list*') ? 'active' : '' }}">
        <a href="{!! url('attendance/list') !!}"><i class="fa fa-list"></i><span>Attendance List</span></a>
    </li>
    </ul>
    </li>

    <li class="{{ Request::is('enter-subject-detail*') ? 'active' : '' }}">
    <a href="{!! url('enter-subject-detail') !!}"><i class="fa fa-edit"></i><span> Assign Subjects</span></a>
    </li>

    <li class="{{ Request::is('send-class-homework*') ? 'active' : '' }}">
    <a href="{!! url('send-class-homework') !!}"><i class="fa fa-edit"></i><span>Home Works</span></a>
    </li>
    
    <li class="{{ Request::is('generate-teacher-timetable*') ? 'active' : '' }}">
        <a href="{!!  url('generate-teacher-timetable')  !!}"><i class="fa fa-th"></i><span>Time Table</span></a>
    </li>

     <li class="treeview">
        <a href="#">
         <i class="glyphicon glyphicon-duplicate"></i> <span>Exams</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
         </a>
        <ul class="treeview-menu">

    <li class="{{ Request::is('mark/entry*') ? 'active' : '' }}">
        <a href="{{ url('mark/entry') }}"><i class="fa fa-pencil"></i><span>Enter Marks</span></a>
    </li>

    <li class="{{ Request::is('get/mark/list*') ? 'active' : '' }}">
        <a href="{{ url('get/mark/list') }}"><i class="fa fa-list"></i><span>Mark List</span></a>
    </li>
    </ul>
    </li>

    <li class="treeview">
        <a href="#">
         <i class="glyphicon glyphicon-registration-mark"></i> <span>Results</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
         </a>
        <ul class="treeview-menu">

    <li class="{{ Request::is('teacher/gradesheet*') ? 'active' : '' }}">
        <a href="{{ url('teacher/gradesheet') }}"><i class="glyphicon glyphicon-tasks"></i><span>Result Card</span></a>
    </li>

    </ul>
    </li>

    <li class="treeview">
        <a href="#">
         <i class="fa fa-money"></i> <span>Salaries</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
         </a>
        <ul class="treeview-menu">

    <li class="{{ Request::is('teacherSalaries*') ? 'active' : '' }}">
        <a href="{{ route('teacherSalaries.index') }}"><i class="fa fa-edit"></i><span>Teacher Salaries</span></a>
    </li>

    <li class="{{ Request::is('salaryTypes*') ? 'active' : '' }}">
        <a href="{{ route('salaryTypes.index') }}"><i class="fa fa-edit"></i><span>Salary Types</span></a>
    </li>
    </ul>
    </li> 

@endif

@endif




