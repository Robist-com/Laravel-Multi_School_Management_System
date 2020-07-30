@extends('layouts.app')
@section('content')

<div class="content">

<section class="content-header">
        <h1 class="pull-left">Marks Entry</h1>
        <h1 class="pull-right">
           <a type="button" href="{{url('get/mark/list')}}" class="btn btn-primary pull-right  style" style="margin-top: -10px;margin-bottom: 5px" >back</a>
        </h1>
    </section>

<div class="row">
<div class="box col-md-12">
        <div class="box-inner">
            <div data-original-title="" class="box-header well">
                <h2><i class="glyphicon glyphicon-book"></i> Marks Edit</h2>

            </div>
            <div class="box-content">
              @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                    @endif
                    @if (isset($marks))
                   <form role="form" action="{{url('/teacher/mark/update')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="id" value="{{$marks->id }}">
		            <input type="hidden" name="subject" value="{{$marks->course_code }}">
		            <input type="hidden" name="class" value="{{$marks->class_code }}">
                   <div class="row">
                   <div class="col-md-12">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="rollNo">Roll No</label>
                                <input type="text" class="form-control" readonly="true"  name="rollNo" value="{{$marks->roll_no}}">
                        </div>
                      </div>

                      <div class="col-md-2">
                      <div class="form-group">
                        <label for="regiNo">Department</label>
                            <input type="text" class="form-control" readonly="true"  name="department" value="{{$marks->department_name}}">
                    </div>
                       </div>

                       <div class="col-md-2">
                       <div class="form-group">
                           <label for="regiNo">Class</label>
                               <input type="text" class="form-control" readonly="true"  name="class1" value="{{$marks->class_name}}">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group">
                           <label for="name">Name</label>
                               <input type="text" class="form-control" readonly="true"  name="name" value="{{$marks->first_name}}  {{$marks->last_name}}">
                       </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Course</label>
                                <input type="text" class="form-control" readonly="true"  name="subject1" value="{{$marks->course_code}}  {{$marks->course_name}}">
                        </div>
                      </div>
                   </div>
                 </div>
                 <div class="row">
                 <div class="col-md-12">
                   <div class="col-md-2">
                     <div class="form-group">
                         <label for="written">Theory</label>
                         {{-- <div class="input-group"> --}}
                             {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span> --}}
                             <input type="number" class="form-control" required="true"  name="written" value="{{$marks->written}}">
                         {{-- </div> --}}
                     </div>
                   </div>
                   <div class="col-md-2">
                     <div class="form-group">
                         <label for="mcq">MCQ</label>
                         {{-- <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span> --}}
                             <input type="number" class="form-control" required="true"  name="mcq" value="{{$marks->mcq}}">
                         {{-- </div> --}}
                     </div>
                   </div>
                   <div class="col-md-2">
                     <div class="form-group">
                         <label for="practical">Practical</label>
                         {{-- <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span> --}}
                             <input type="number" class="form-control" required="true"   name="practical" value="{{$marks->practical}}">
                         {{-- </div> --}}
                     </div>
                   </div>
                   <div class="col-md-2">
                     <div class="form-group">
                         <label for="ca">Assignment</label>
                         {{-- <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span> --}}
                             <input type="number" class="form-control" required="true"   name="ca" value="{{$marks->ca}}">
                         {{-- </div> --}}
                     </div>
                   </div>
                   <div class="col-md-2">
                     <div class="form-group">
                         <label for="Absent">Absent</label>
                         {{-- <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span> --}}
                             <input type="text" class="form-control" required="true"   name="Absent" value="{{$marks->Absent}}">
                         {{-- </div> --}}
                     </div>
                   </div>
                 </div>
               </div>

               <div class="row">
               <div class="col-md-12">
                   <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-check"></i>Update</button>
                 </div>
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
@stop
@section('script')

<script type="text/javascript">

</script>
@stop
