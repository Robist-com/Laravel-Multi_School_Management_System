@extends('layouts.app')

@section('content')


<style>
    .teacher-image{
        height:160px;
        padding-left:1px;
        padding-right: 1px;

        background: #eee;
        width:140px;
        margin: 0 auto;
        border-radius: 50%;
        vertical-align: middle;
       
    }
    .image{
        vertical-align: middle;
        width:50px;
        height: 50px;
        border-radius: 50%;
    }
    .image > input[type="file"]{
        display: none;
    }

    .btn-choose{
        padding: 5px;
        text-align: center;
        border:1px solid !important;
        color: black;
        border-radius: 50%;
    }

    .btn-choose:hover{
    background-color: #605ca8;
    transform: translateX(0);
    transition: all .3s ease;
    color:white;
}

    fieldset{
        margin-top: 5px;
    }
    fieldset legend{
        display: block;
        width:100%;
        padding: 0;
        font-size: 15px;
        border: 0;
        line-height: inherit;
        color: #797979;
        border-bottom: 1px solid #e5e5e5;
    }

    .info{
        float: right;
    }

</style>
<section class="content-header">
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<i class="fa fa-id-badge" aria-hidden="true"> Edit Admission</i></h1>
<a  class="pull-left btn btn-danger" href="{{route('admissions.index')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
</section>
   <div class="content">
   <div class="clearfix"></div>
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {{-- {!! Form::model($admission, ['route' => [], 'method' => 'patch']) !!} --}}
               <form action="{{route('admissions.update', $admission->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- thats all insie the edit file okay --}}

                   <!-- <div class="panel panel-default">
    
                    <div class="panel-heading">
                    <b><i class="fa fa-book"></i> Details</b>
                    <b class="pull-right"></b>
                    </div> -->
                   
                    <div class="panel-body" styte="padding-bottom:4px;">
                    <b><i class="fa fa-book"></i> Student Details</b>
                    <hr class="line">
                    {{-- and we can also user anothet rand() inside the controller okay --}}
                        <input type="hidden" value="{{Auth::id()}}"
                         name="user_id" id="user_id" required>
                        <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
        
                        {{---------------First Name------------------}}
        
                        <div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" value="{{$admission->first_name}}" name="first_name" id="first_name" class="form-control 
                         text-capitalize"placeholder="Enter First Name Here">
                        </div>
                        </div>
        
                        {{---------------Last Name------------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" value="{{$admission->last_name}}" name="last_name" id="last_name" class="form-control  
                            text-capitalize"placeholder="Enter Last Name Here">
                            </div>
                            </div>
        
                        {{--------------Gender------------------}}
        
                            <div class="col-md-4">
                                <div class="form-group">
                                <fieldset>
                                <legend for="gender">Gender</legend>
                                <table style="width:100%;margin-top: 14px;">
                                <tr style="border-bottom: 1px solid #ccc;">
                                <td>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="0"
                                    {{($admission->gender == 0)? 'checked' : ''}} >
                                    Male
                                </label>
                                </td>
                                <td>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="1"
                                    {{($admission->gender == 1)? "checked" : ''}}>
                                    Female
                                </label>
                                </td>
                                </tr>
                                </table>
                                </fieldset>
                                </div>
                            </div>
                            </div>
        
                            {{------------DOB-----------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar teacherdob"></i>
                            </div>
                            <input type="text" value="{{$admission->dob}}" name="dob" id="dob" class="form-control  text-capitalize"
                             placeholder="YYY-MM-DD" >
                            </div>
                            </div>
                            </div>
        
                            {{--------------------Passport-----------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" value="{{$admission->passport}}" name="passport" id="passport" class="form-control  text-capitalize"
                             placeholder="Enter Passport Number Here">
                            </div>
                            </div>
        
                        {{----------------------Status------------------}}
        
                            <div class="col-md-4">
                                <div class="form-group">
                                <fieldset>
                                <legend>Status</legend>
                                <table style="width:100%;margin-top: -14px;">
                                <tr style="border-bottom: 1px solid #ccc;">
                                <td>
                                <label>
                                    <input type="radio" name="status" id="status" value="0"
                                    {{$admission->status == '0' ? 'checked' : ''}}>
                                    Single
                                </label>
                                </td>
                                <td>
                                <label>
                                    <input type="radio" name="status" id="status" value="1"
                                    {{$admission->status == '1' ? 'checked' : ''}} >
                                    Married
                                </label>
                                </td>
                                </tr>
                                </table>
                                </fieldset>
                                </div>
                            </div>
                        
                        {{--------------------------Nationality-----------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" value="{{$admission->nationality}}" name="nationality" id="nationality" class="form-control 
                             text-capitalize" placeholder="Enter Nationality Here">
                            </div>
                            </div>
                        
                        {{-------------------------Phone-----------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" value="{{$admission->phone}}" name="phone" id="phone" class="form-control 
                             text-capitalize" placeholder="Enter Phone Number Here">
                            </div>
                            </div>
        
                        {{------------------------Email-----------------}}
        
                            <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" value="{{$admission->email}}" name="email" id="email" class="form-control 
                             text-capitalize" placeholder="Enter Email Address Here" >
                            </div>
                            </div>
    
                            {{------------------------Faculty-----------------}}
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="faculty_id" id="faculty_id" class="form-control" >
                                        <option value="0" selected="true" disabled="true">Choose Faculty</option>
                                        @foreach($faculties as $faculty)
                                        <option value="{{$faculty->faculty_id}}"
                                            {{$faculty->faculty_id == $admission->faculty_id ? 'selected' : ''}}  >{{$faculty->faculty_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
    
                              {{------------------------Department-----------------}}
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="department_id" id="department_id" class="form-control" >
                                        <option value="0" selected="true" disabled="true">Choose Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->department_id}}"
                                         {{$department->department_id == $admission->department_id ? 'selected' : ''}}>
                                            {{$department->department_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>  
    
                                  {{------------------------Batch-----------------}}
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="batch_id" id="batch_id" class="form-control" >
                                        <option value="0" selected="true" disabled="true">Choose Batch</option>
                                        @foreach($batches as $batch)
                                        <option value="{{$batch->id}}"
                                        {{$batch->id === $admission->batch_id ? 'selected' : ''}}>
                                        {{$batch->batch}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div> 
    
                                 
                            {{---------------------Address------------------------------}}
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <textarea placeholder="Enter Address Here" name="address" id="address"
                                     cols="40" rows="2" class="form-control  text-capitalize">{{$admission->address}}</textarea>
                                    </div>
                                    </div>
                                    {{--------------------- Current Address------------------------------}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <textarea placeholder="Enter Current Address Here" name="current_address" id="current_address"
                                         cols="40" rows="2" class="form-control  text-capitalize">{{$admission->current_address}}</textarea>
                                        </div>
                                        </div>
                                   
                            
    
                    {{-- this field will be a hidden field okay so that our image can be fine --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="" id="" style="display:none"></select>
                                </div>
                            </div>
                        </div>
                    {{-- ends here okay --}}
        
                        {{-------------------------image-----------------}}
        
                            <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group form-group-login">
                            <table style="margin:0 auto;">
                            <thead>
                                <tr class="info">
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="image">
                                {{-- Html::image is the same as asset okay they all calling from public folder okay --}}
                                        {!!Html::image('student_images/' .$admission->image, 
                                        null, ['class'=>'teacher-image', 'id'=>'showImage'])!!}
                                        <input type="file" name="image" id="image" 
                                        accept="image/x-png,image/png,image/jpg,image/jpeg">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;background:#ffff;">
                                    <input type="button" name="browse_file" id="browse_file" 
                                    class=" btn btn-default btn-lg text-capitalize btn-choose " 
                                     value="Choose">
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            </div>
                            </div>
                            </div>
                            {{-- <br> --}}
                                            
                        {{-------------------------Guadian Details -----------------}}
                                <div class="content">
                                <div class="panel-heading" style="margin-top: -20px;">
                                <b><i class="fa fa-map-marker"></i> Guadians Details</b>
                                </div>
                                <hr class="line">
                                <div class="panle-body" styte="padding-bottom:10px;margin-top: 0;">
        
                        {{---------------------Father Name------------------------------}}
                                <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                <input type="text" value="{{$admission->father_name}}" name="father_name" id="father_name" class="form-control 
                                 text-capitalize" placeholder="Enter Father Name" >
                                </div>
                                </div>
                                 {{---------------------Father Phone------------------------------}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" value="{{$admission->father_phone}}" name="father_phone" id="father_phone" class="form-control 
                                     text-capitalize" placeholder="Enter Father Phone Number" >
                                    </div>
                                    </div>
    
                                    {{---------------------Mother Name------------------------------}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" value="{{$admission->mother_name}}" name="mother_name" id="mother_name" class="form-control 
                                     text-capitalize" placeholder="Enter Mother Name" >
                                    </div>
                                    </div>
                                    </div>
                        </div>
                        </div>
        
                        <div class="modal-footer">
                        <a href="{{route('admissions.index')}}"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></a>
                         {!! Form::submit('Update Student', ['class' => 'btn btn-info']) !!}
              </div>
              </div>
                          
                        <!-- </div> -->
              {!! Form::close() !!}
            </div>

                   
               <!-- </div> -->
           </div>
       <!-- </div> -->
   </div>
@endsection


@section('scripts')

        <script type="text/javascript">
        
        //------------------Date Of Birth Change-----------
                    $('#dob').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
        //---------------------Browse image----------------
                        $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })

                        $('#dob').datepicker({
                                changeMonth:true,
                                changeYear:true,
                                dateFormat:'yy-mm-dd'
                        });
                        //---------------------------------------
                        function showFile(fileInput,img,showName){
                            if (fileInput.files[0]){
                                var reader = new FileReader();
                                reader.onload = function(e){
                                    $(img).attr('src', e.target.result);
                                }
                                reader.readAsDataURL(fileInput.files[0]);
                            }
                            $(showName).text(fileInput.files[0].name)
                        };
                        //------------------------------------------------------
                        </script>
@endsection