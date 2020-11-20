@extends('layouts.new-layouts.app')

@section('content')
<!-- <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"> <i class="fa fa"></i> ASSIGNED SUBJECTS</h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

 </section> -->
 <div class="content">
        <div class="clearfix"></div>
<!-- @include('table_style') -->
@include('flash::message')


<div class="clearfix"></div>
    <div class="page-title">

          <div class="title_right1">
            <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Select Creterials </h2>
                <ul class="nav navbar-right panel_toolbox">
                    
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

@if(!empty($course))
<form action="{{url('update-subject-detail', [$course->id])}}" method="POST">
@csrf
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
<!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive" cellspacing="0" width="100%"> -->
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
       </tr>
      
       </tbody>
       </table>
        </div>
    
    <div class="modal-footer">
         <a href="{{url('/enter-subject-detail')}}"><button type="button" class="btn btn-round btn-danger">Canecl</button></a>
       <button type="submit" class="btn btn-round btn-dark">Save Detail</button>
       </div>
    
</form>
@endif

<div class="table-responsive">

<h4 style="font-weight:bold; color:red" ><i class="fa fa-o"></i> ASSIGNED SUBJECTS</h4>


<div  id="wait"></div>


<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
<!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive" cellspacing="0" width="100%"> -->

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
            <label class="badge badge-success">P MARK {!! $teacher->totalpass !!}</label>
            </td>
           <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->wfull !!}
            </a>
            <label class="badge badge-success">P MARK {!! $teacher->wpass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->pfull !!}
            </a>
            <label class="badge badge-success">P MARK {!! $teacher->ppass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->mfull !!}
            </a>
            <label class="badge badge-success">P MARK {!! $teacher->mpass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->sfull !!}
            </a>
            <label class="badge badge-success">P MARK {!! $teacher->spass !!}</label>
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
</div>

 <!-- </div> -->
 <!-- </div> -->





@endsection