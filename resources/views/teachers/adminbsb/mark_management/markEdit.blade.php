@extends('layouts.new-layouts.app')
@section('content')

    <div class="content">
    @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
        <div class="page-title">
              <div class="title_left">
                <h2> Teacher Marks List</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="content">
            <div class="clearfix"></div>
            <div class="x_panel">
                  <div class="x_title">
                   <h2>Edit Mark</h2>
                        <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" data-toggle="tooltip" title=" show collapse"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a href="{{url('get/mark/list')}}" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="left" title="return back"><i class="fa fa-arrow-circle-left" aria-hidden="true"> back</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                <div  id="wait"></div>
                    @if (isset($marks))
                   <form role="form" action="{{url('/teacher/mark/update')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="id" value="{{$marks->id }}">
		            <input type="hidden" name="subject" value="{{$marks->course_code }}">
		            <input type="hidden" name="class" value="{{$marks->class_code }}">
                   <div class="row">
                   <div class="col-md-12">

                   <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="rollNo">Roll No</label>
                                <input type="text" class="form-control" readonly="true"  name="rollNo" value="{{$marks->roll_no}}">
                        </div>
                      </div>

                      <div class="col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label for="regiNo">Department</label>
                            <input type="text" class="form-control" readonly="true"  name="department" value="{{$marks->department_name}}">
                    </div>
                       </div>

                       <div class="col-md-2 col-sm-6 col-xs-12">
                       <div class="form-group">
                           <label for="regiNo">Class</label>
                               <input type="text" class="form-control" readonly="true"  name="class1" value="{{$marks->class_name}}">
                       </div>
                     </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                       <div class="form-group">
                           <label for="name">Name</label>
                               <input type="text" class="form-control" readonly="true"  name="name" value="{{$marks->first_name}}  {{$marks->last_name}}">
                       </div>
                     </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="name">Course</label>
                                <input type="text" class="form-control" readonly="true"  name="subject1" value="{{$marks->course_code}}  {{$marks->course_name}}">
                        </div>
                      </div>
                   </div>
                 </div>
                 <div class="row">
                 <div class="col-md-12">
                 <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="form-group">
                         <label for="written">Written</label>
                             <input type="number" class="form-control" required="true"  name="written" value="{{$marks->written}}">
                     </div>
                   </div>
                   <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="form-group">
                         <label for="mcq">MCQ</label>
                             <input type="number" class="form-control" required="true"  name="mcq" value="{{$marks->mcq}}">
                     </div>
                   </div>
                   <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="form-group">
                         <label for="practical">Practical</label>
                             <input type="number" class="form-control" required="true"   name="practical" value="{{$marks->practical}}">
                     </div>
                   </div>
                   <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="form-group">
                         <label for="ca">SBA</label>
                             <input type="number" class="form-control" required="true"   name="ca" value="{{$marks->ca}}">
                     </div>
                   </div>
                   <!-- <div class="col-md-2 col-sm-4 col-md-12"> -->
                   <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="form-group">
                         <label for="Absent">Absent</label>
                             <input type="text" class="form-control" required="true"   name="Absent" value="{{$marks->Absent}}">
                     </div>
                   </div>
                 </div>
               </div>

              
               <div class="modal-footer">
                   <button class="btn btn-dark btn-round pull-right" type="submit"><i class="glyphicon glyphicon-check"></i>Update</button>
                 </div>
                 </form>
                @else
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>There is no such Student!<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                         @endif





        </div>
    </div>
</div>
</div>
</div>
<!-- </div>
</div> -->
@stop
@section('script')

<script type="text/javascript">

</script>
@stop
