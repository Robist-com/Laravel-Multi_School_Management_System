@extends('layouts.app')

@section('content')
<section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"> <i class="fa fa"></i> ASSIGNED SUBJECTS</h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
<style>
th{
  text-align: center;
  font-family: 'Times New Roman', Times, serif;
  font-style: initial;
  font-weight: bold;
  font-size:large
}
</style>
 </section>
 <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
        <div class="box-body">

@include('table_style')
@include('flash::message')
<!-- <h3 style="font-weight:bold"><i class="fa fa-user"></i> {{Auth::user()->name}} Assigned Subjects</h3> -->
@if(!empty($course))
<form action="{{url('update-subject-detail', [$course->id])}}" method="POST">
@csrf
       <table>
       <tbody>
       <div class="clearfix"></div>
        <h4 style="font-weight:bold;><i class="fa fa-o"></i> <b style="font-weight:bold; color:red" >ENTER SUBJECT DETAILS </b> ({{$course->course_name}})</h4>

       <tr>
      
            <td>
            <label for="">Subject Full Mark</label> <input type="number" name="totalfull" id="id_totalfull" value="{{$course->totalfull}}">
            </td>
            <td>
            <label for="">Theory Full Mark</label> <input type="number" name="wfull" id="id_wfull" value="{{$course->wfull}}">
            </td>

            <td>
            <label for="">Paractical Full Mark</label>  <input type="number" name="pfull" id="id_pfull" value="{{$course->pfull}}">
            </td>

            <td>
            <label for="">MCQ Full Mark</label> <input type="number" name="mfull" id="id_mfull" value="{{$course->mfull}}">
            </td>

            <td>
            <label for="">HW Full Mark</label> <input type="number" name="sfull" id="id_sfull" value="{{$course->sfull}}">
            </td>
            </tr>
            <tr>
            <td>
            <label for="">Subject Pass Mark</label> <input type="number" name="totalpass" id="id_totalpass" value="{{$course->totalpass}}">
            </td>
            <td>
            <label for="">Theory Pass Mark</label> <input type="number" name="wpass" id="id_wpass" value="{{$course->wpass}}">
            </td>

            <td>
            <label for="">Paractical Pass Mark</label>  <input type="number" name="ppass" id="id_ppass" value="{{$course->ppass}}">
            </td>

            <td>
            <label for="">MCQ Pass Mark</label> <input type="number" name="mpass" id="id_mpass" value="{{$course->mpass}}">
            </td>

            <td>
            <label for="">HW Pass Mark</label> <input type="number" name="spass" id="id_spass" value="{{$course->spass}}">
            </td>
        <!-- </div> -->
       </tr>
      
       </tbody>
       </table>
    
    <div class="modal-footer">
         <a href="{{url('/enter-subject-detail')}}"><button type="button" class="btn btn-rounded btn-defaul">Canecl</button></a>
       <button type="submit" class="btn btn-rounded btn-info">Save Detail</button>
       </div>
    
</form>
@endif

<div class="table-responsive">

<h4 style="font-weight:bold; color:red" ><i class="fa fa-o"></i> ASSIGNED SUBJECTS</h4>


<div  id="wait"></div>


    <table class="table  table-hover" id="teachers-table">
        <thead>
            <tr>
         <th>SUBJECT</th>
        <th>FULL MARK</th>
        <!-- <th>PASS MARK</th> -->
        <th>THEORY</th>
        <th>PARACTICAL</th>
        <th >MCQ</th>
        <th >HOMEWORKS</th>
        <th colspan="3">ACTION</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjects as $teacher)
            <tr>
            <td>{!! $teacher->course_name !!}</td>
           <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->totalfull !!} 
            </a>
            <Label class="badge badge-success">P MARK {!! $teacher->totalpass !!}</Label>
            </td>
           <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->wfull !!}
            </a>
            <Label class="badge badge-success">P MARK {!! $teacher->wpass !!}</Label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->pfull !!}
            </a>
            <Label class="badge badge-success">P MARK {!! $teacher->ppass !!}</Label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->mfull !!}
            </a>
            <Label class="badge badge-success">P MARK {!! $teacher->mpass !!}</Label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->sfull !!}
            </a>
            <Label class="badge badge-success">P MARK {!! $teacher->spass !!}</Label>
            </td>
            <td colspan="3">
                  
                    <div class='btn-group'>
                        <a href="{!! url('edit-subject-detail', [$teacher->id]) !!} "  title="Mark Attendance" class='btn btn-info btn-xs'> <i class="glyphicon glyphicon-calendar"></i></a>
                        <a href="{!! url('print-teacher-assign-subject', [Auth::user()->teacher_id ])!!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
    </div>
</div>

 <!-- </div> -->
 <!-- </div> -->





@endsection