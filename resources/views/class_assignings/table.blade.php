@include('class_schedule-table_style')
<!------------------------------ Modal start from here okay-------------------------------- -->
<div class="modal fade" id="classschedule-show" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel" 
aria-hidden="true">
    <div class="modal-dialog" style="width:95%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-user-o">Generate a Class For Teacher</i></h4>
            </div>
            

            {!! Form::open(array('route' => 'insert', 'id'=> 'mult', 'method'=>'post')) !!}
            {{-- <form action="{{ route('classAssignings.store')}}" method="post"> --}}
                @csrf
            @include('class_assignings.fields')
    <div class="table-responsive">
    <table class="table" id="classAssignings-table">
        <thead>
           
            {{-- <tr>
                <th colspan="3"><i class="fa fa">Schedule Details</i> </th>
            </tr> --}}
        </thead>
        <tbody>
        @foreach($classSchedules as $classSchedule)
            <tr>
                <td><input type="checkbox" name="multiclass[]" value="{{$classSchedule->Scheduleid}}"></td>
                <td>{!! $classSchedule->faculty_name !!}</td>
                <td>{!! $classSchedule->department_name !!}</td>
                <td>{!! $classSchedule->course_name !!}</td>
                <td>{!! $classSchedule->class_name !!}</td>
                <td>{!! $classSchedule->level !!}</td>
                <td>{!! $classSchedule->shift !!}</td>
                <td>{!! $classSchedule->classroom_name!!}</td>
                <td>{!! $classSchedule->batch !!}</td>
                <td>{!! $classSchedule->name !!}</td>
                <td>{!! $classSchedule->time !!}</td>
                <td>{!! $classSchedule->semester_name !!}</td>
                <td> {!! date('d-m-Y', strtotime($classSchedule->start_date)); !!} </td>
                <td> {!! date('d-m-Y', strtotime($classSchedule->end_date)); !!} </td>
                {{-- <td>{!! $classSchedule->end_date !!}</td> --}}
            </tr>
            
        @endforeach
        </tbody>
        
    </table>
</div>
{{-- modal  button start here--}}
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
    {!! Form::submit('Generate Class Assign',array('class' => 'btn btn-success' )) !!}
      </div>   
      {{-- / modal button end here --}}
    </div>   
</div>   
</div>   
</div>   
{{-- Model Schedule End here --}}
{!! Form::close() !!}

<h1 style="font-weight:bold"><i class="fa fa-money"></i> CLASS ASSINGNING</h1>
<hr class="line">
<div class="panel panel-default">
<div  id="wait"></div>
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red">ASSINGNING</h4>
</div>
<form action="/search-teachers" method="GET">
   <div class="panel">
   <div class="panel-body">
            <div class="input-group col-md-4 pull-right" >
            <input type="search" name="search" id="search" value="{{request('search')}}" 
            class="form-control " placeholder="Search Teacher by Name or ID" >
            <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
            </span>
        </div>
        
    <div  id="wait"></div>
</div>
</div>
<!-- </div> -->
</form>

 

<table class="table" id1="classAssignings-table" id="table-class-info">
    <thead>
        <tr>
            <th rowspan="2">Teacher</th>
            <th rowspan="2">Course</th>
            <th rowspan="2">Semester</th> 
            <th rowspan="2"style="text-align: center; background:#ccc">Days</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Room and Class</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($classAssignings as $classAssigning)
<tr>
<td class="col-md-2" style="padding-top:70px;">{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
<!-- <td class="col-md-2">{!! $classAssigning->semester_name!!} <div style="text-decoration:underline">&nbsp;</div> <i class="badge badge-success"> {!! $classAssigning->batch !!}</i></td> -->

<td>
    <div class="top_row">
        <div>{!! $classAssigning->course_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->level !!}</i>
        </div>
 </td>

<td>
    <div class="top_row">
        <div>{!! $classAssigning->semester_name!!}</div>
        <!-- <div>World</div> -->
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->batch !!}</i>
        </div>
 </td>


 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classAssigning->name !!}</i></div>
        <div><i class="badge badge-success"> {!! $classAssigning->time !!}</i> </div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->shift !!}</i>
        </div>
 </td>

 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classAssigning->faculty_name !!}</i></div>
        </div>
        <div class="top_row">
        <div><i class="badge badge-success"> {!! $classAssigning->department_name !!}</i> </div>
        </div>
 </td>

<td> 
<i class="badge badge-success">{!! $classAssigning->classroom_name !!}</i> 
<i class="badge badge-success">{!! $classAssigning->class_name !!}</i>
</td>

        <td colspan="3">
             {!! Form::open(['route' => ['classAssignings.destroy', $classAssigning->class_assign_id], 'method' => 'delete']) !!}
              <div class='btn-group'>
                <a href="{!! url('print-class-assign-single', [$classAssigning->class_assign_id]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                {{-- <a href="{{ url('teacher-view-timetable',[$classAssigning->class_assign_id]) }}"><button type="button" class="btn btn-warning btn-sm" id='filter1'>filter</button></a>  --}}

              <!-- ----------------------------------------------------------- -->
              <!-- view modal button -->
              <a href="#" class="show-modal btn btn-warning btn-xs" data-id="{{$classAssigning->class_assign_id}}"
                data-name="{{$classAssigning->name}}" data-fname="{{$classAssigning->first_name}}"  
                data-lname="{{$classAssigning->last_name}}" data-shift="{{$classAssigning->shift}}"
                 data-level="{!! $classAssigning->level !!}"  data-time="{!! $classAssigning->time !!}"
                 data-classroom_name="{!! $classAssigning->classroom_name !!}" data-class_name="{!! $classAssigning->class_name !!}"
                 data-batch="{!! $classAssigning->batch !!}" data-course_name="{!! $classAssigning->course_name !!}"
                 data-semester_name="{!! $classAssigning->semester_name !!}"
                data-created_at="{{$classAssigning->created_at}}">
                <i class='glyphicon glyphicon-eye-open'></i></a> 
                <!-- view modal button

               <!-- ---------------------------------------------------------- -->

                <a href="{!! route('classAssignings.edit', [$classAssigning->class_assign_id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
               </div>
               {!! Form::close() !!}
               
               </td>

</tr>

@endforeach
    </tbody>
    
</table>
{{ $classAssignings->links() }}
<!-- this is the pagenation part okay. -->
{{-- </div> --}}
{{-- </div>
</div>
</div>
</div> --}}