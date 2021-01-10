@extends('layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop
@section('content')

<section class="content-header">
        <h1 class="pull-right">
        <i class="glyphicon glyphicon-cog">INSTITUTION SETTINGS</i>
        </h1>
            <h1> </h1>
</section >
<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
 
                        <form role="form" action="{{url('/institute')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="type">Name</label>
                                                <input type="text" class="form-control" required name="name" placeholder="Institute Name" value="{{$institute->name}}">

                                            </div>
                                         </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="type">Establish</label>
                                                <input type="text" class="form-control" required name="establish" placeholder="1990" value="{{$institute->establish}}">

                                            </div>
                                        </div>
                                  </div>
                              </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Web Stie</label>
                                                <input type="text"  class="form-control" required name="web" placeholder="www.ictinnovations.com" value="{{$institute->web}}">

                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Email</label>
                                                <input type="email" class="form-control" required name="email" placeholder="admin@shanixlab.com" value="{{$institute->email}}">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <div class="row">

                                <div class="col-md-12">
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label for="type">Phone/Mobile No</label>
                                              <input type="text" class="form-control" required name="phoneNo" placeholder="+8801554322707" value="{{$institute->phoneNo}}">

                                          </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="type">Address</label>
                                                <textarea type="text" class="form-control" required name="address" placeholder="Address">{{$institute->address}}</textarea>

                                            </div>
                                    </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="type">Logo</label>
                                                <input type="file" class="form-control"  name="logo">

                                            </div>
                                        </div>
                            </div>
                            </div>


                          @if(Auth::user()->login=='3939919@gmail.com')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="type">Grade System</label>
<!--                                                <input data-no-uniform="true" name="grade_system"  @if($gradsystem=='' || $gradsystem=='auto') checked @endif type="checkbox" class="iphone-toggle">
 -->                                        
                                                <div class="input-group">
                                                <input class="chb form-control" data-toggle="toggle" id="grade_system" data-on="Auto" data-off="Manual" data-width="100"   name="grade_system" data-onstyle="danger" data-offstyle="success" type="checkbox" @if($gradsystem=='' || $gradsystem=='auto') checked @endif  >                                            
                                            </div>
                                    </div>
                                    </div>
                                    
                                    </div>
                            </div>
                                
                            @endif
                            <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-check"></i> Save</button>
                            <br>
                            <br>
                        </form>

                </div>
                </div>
        <div class="text-center">
        
        </div>
    </div>


@stop
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#toggle-one').bootstrapToggle();
  })
    iOSCheckbox.defaults.checkedLabel='Auto';
    iOSCheckbox.defaults.uncheckedLabel='Manual';
</script>
@stop
