
        <?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-users"> ASSIGNED SUBJECTS</i> </h2>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
    </div>
    <br><br>
    <div class="card">
        <div class="body">

        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <!-- <h2>Select Creterials </h2> -->
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
       <button type="submit" class="btn btn-round bg-teal">Save Detail</button>
       </div>
    
</form>
@endif

<div class="table-responsive">

<h4 style="font-weight:bold; color:red" ><i class="fa fa-o"></i> ASSIGNED SUBJECTS</h4>


<div  id="wait"></div>


<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action js-exportable">
<!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive" cellspacing="0" width="100%"> -->

        <thead>
            <tr>
         <th>SUBJECT</th>
        <th>FULL MARK</th>
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
            <label class="badge bg-teal">P MARK {!! $teacher->totalpass !!}</label>
            </td>
           <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->wfull !!}
            </a>
            <label class="badge bg-teal">P MARK {!! $teacher->wpass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->pfull !!}
            </a>
            <label class="badge bg-teal">P MARK {!! $teacher->ppass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->mfull !!}
            </a>
            <label class="badge bg-teal">P MARK {!! $teacher->mpass !!}</label>
            </td>
            <td> <a  href="" class='btn btn-default btn-xs'title="View Profile">
            F MARK {!! $teacher->sfull !!}
            </a>
            <label class="badge bg-teal">P MARK {!! $teacher->spass !!}</label>
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


