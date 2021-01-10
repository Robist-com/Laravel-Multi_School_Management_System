@extends('layouts.new-layouts.app')
<!-- @include('table_style') -->
@section('content')
@if (Session::get('success'))
<div class="alert alert-success">
  <button data-dismiss="alert" class="close" type="button">×</button>
    <strong>Process Success.</strong> {{ Session::get('success')}}

</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2><i class="glyphicon glyphicon-user"></i> Grading Rules</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

 
            


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
                   @if($gpa)
                     <form role="form" action="{{url('/gpa/update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                       <input type="hidden" name="id" value="{{$gpa->id}}">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="row">
                     <div class="col-md-12">
                        @if(auth()->user()->group == "Admin")
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building blue"></i></span>
                          <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select School</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($classRoom)) @if($school->id === $classRoom->school_id) selected  @endif @endif>{{$school->name}}</option>
                            @endforeach
                          </select>
      
                        </div>
                        </div>
                        </div>
                      @else
                      <input type="hidden" name="school_id" id="school_id" class="form-control"   value="{{auth()->user()->school->id}}" >
                      @endif
                       <div class="col-md-4">
                           <div class="form-group">
                         <label for="for">Grade For[100 Marks]</label>
                         <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                             <select name="for" class="form-control">
                              
                               <option value="1"   @if($gpa->for=="1") selected="true" @endif>100 Marks </option>
                               <option value="3" @if($gpa->for=="3") selected="true" @endif>75 Marks </option>

                               <option value="2" @if($gpa->for=="2") selected="true" @endif>50 Marks </option>
                               <option value="4" @if($gpa->for=="4") selected="true" @endif>30 Marks </option>
                               <option value="5" @if($gpa->for=="5") selected="true" @endif>25 Marks </option>
                               <option value="6" @if($gpa->for=="6") selected="true" @endif>20 Marks </option>
                               <option value="7" @if($gpa->for=="7") selected="true" @endif>15 Marks </option>
                               <option value="8" @if($gpa->for=="8") selected="true" @endif>10 Marks </option>
                             
                             </select>
                         </div>
                     </div>
                       </div>
                       <div class="col-md-2">
                           <div class="form-group">
                         <label for="gpa">Grade</label>
                         <div class="input-group">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                             <input type="text" class="form-control" required name="grade" value="{{$gpa->grade}}" placeholder="A+,B,C etc">
                         </div>
                     </div>
                       </div>
                       <div class="col-md-2">
                         <div class="form-group">
                             <label for="grade">Point</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input type="text" class="form-control" value="{{$gpa->gpa}}" required name="gpa" placeholder="4.00,3.50 etc">
                             </div>
                         </div>
                       </div>
                       <div class="col-md-2">
                         <div class="form-group">
                             <label for="markfrom">Mark From</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input type="text" class="form-control" value="{{$gpa->markfrom}}" required name="markfrom" placeholder="40,60,90 etc">
                             </div>
                         </div>
                       </div>
                       <div class="col-md-2">
                         <div class="form-group">
                             <label for="markto">Mark To</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input type="text" class="form-control" value="{{$gpa->markto}}" required name="markto" placeholder="40,60,90 etc">
                             </div>
                         </div>
                       </div>

                     </div>
                   </div>
                 
                    <button class="btn btn-primary pull-right btn-round" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>
                    <a href="{{url('gpa')}}" class="btn btn-default btn-round pull-right"> Cancel </a>   
                  </form>
                    @else
                    <form role="form" action="{{url('/gpa/create')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                    <div class="col-md-12">
                    @if(auth()->user()->group == "Admin")
                   <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building blue"></i></span>
                      <select name="school_id" id="school_id" class="form-control">
                        <option value="">Select School</option>
                        @foreach(auth()->user()->school->all() as $school)
                        <option value="{{$school->id}}" @if(isset($classRoom)) @if($school->id === $classRoom->school_id) selected  @endif @endif>{{$school->name}}</option>
                        @endforeach
                      </select>
  
                    </div>
                    </div>
                    </div>
                   @else
                   <input type="hidden" name="school_id" id="school_id" class="form-control"   value="{{auth()->user()->school->id}}" >
                   @endif
                      <div class="col-md-4">
                          <div class="form-group">
                        <label for="for">Grade For</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <select name="for" class="form-control">

                              <option value="1">100 Marks </option>
                              <option value="3"> 75 Marks </option>
                              <option value="2">50 Marks </option>
                              
                              <option value="4">30 Marks </option>
                              <option value="5">25 Marks </option>
                              <option value="6">20 Marks </option>
                              <option value="7">15 Marks </option>
                              <option value="8">10 Marks </option>

                            </select>
                        </div>
                    </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                        <label for="gpa">Grade</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <input type="text" class="form-control" required name="grade"  placeholder="A+,B,C etc">
                        </div>
                    </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="grade">Point</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required name="gpa" placeholder="4.00,3.50 etc">
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="markfrom">Mark From</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required name="markfrom" placeholder="40,60,90 etc">
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="markto">Mark To</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required name="markto" placeholder="40,60,90 etc">
                            </div>
                        </div>
                      </div>

                    </div>
                  </div>


                      <button class="btn btn-dark btn-round pull-right" type="submit"><i class="glyphicon glyphicon-plus "></i>Add</button>
                      <br>
                        </form>
                    @endif
                    <br>
                  </div>


                @if(count($gpaes)>0)
                <div class="row">
                  <div class="col-md-12">
                    <!-- <table id="gpaList" class="table table-striped table-bordered table-hover"> -->
                    <table id="datatable-keytable" class="table table-striped table-bordered">
                                                               <thead>
                                                                   <tr>
                                                                       <th>GPA For</th>
                                                                       <th>GPA Point</th>
                                                                       <th>Grade</th>
                                                                       <th>Mark From</th>

                                                                        <th>Mark To</th>
                                                                          <th>Action</th>
                                                                   </tr>
                                                               </thead>
                                                               <tbody>
                                                                 @foreach($gpaes as $gpa)

                                                                   <tr>
                                                                     @if($gpa->for=="1")
                                                                      <td>100 Marks</td>
                                                                      @elseif($gpa->for=="3")
                                                                        <td>75 Marks</td>
                                                                        @elseif($gpa->for=="2")
                                                                        <td>50 Marks</td>
                                                                        @elseif($gpa->for=="4")
                                                                        <td>30 Marks</td>
                                                                        @elseif($gpa->for=="5")
                                                                        <td>25 Marks</td>
                                                                        @elseif($gpa->for=="6")
                                                                        <td>20 Marks</td>
                                                                        @elseif($gpa->for=="7")
                                                                        <td>15 Marks</td>
                                                                        @else
                                                                        <td>10 Marks</td>
                                                                      @endif
                                                                      <td>{{$gpa->gpa}}</td>
                                                                     <td>{{$gpa->grade}}</td>
                                                                     <td>{{$gpa->markfrom}}</td>
                                                                     <td>{{$gpa->markto}}</td>

                                                             <td>
                                                                       <a title='Edit' class='btn btn-info btn-sm' href='{{url("/gpa/edit")}}/{{$gpa->id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger btn-sm' href='{{url("/gpa/delete")}}/{{$gpa->id}}'> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                                     </td>
                                                                 @endforeach
                                                                 </tbody>
                                      </table>

                  </div>
                </div>
                @endif

                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@stop
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#gpaList').dataTable();
    });
</script>

@stop
