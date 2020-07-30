@extends('layouts.app')
@section('title', 'Teacher Edit')
    
@section('content')
    {{-- <section class="content-header">
        <h1>
            Teacher Edit
        </h1>
   </section> --}}
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {{-- {!! Form::model($teacher, ['route' => ['teachers.update', $teacher->teacher_id], 'method' => 'put', 'enctype'=>'multipart/form-data' ]) !!} --}}
                   <form method="post" action="{{ route('teachers.update', $teacher->teacher_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
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
/* 
     .btn-choose{
        padding: 5px;
        text-align: center;
        background: gray;
        border:none;
        bac
         color: black; 
         border-radius: 50%; 
    }  */



.btn-outline-secondary{
  position: relative
  margin: auto
  padding: 19px 22px
  transition: all .2s ease
}
.btn-outline-secondary:hover{
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
{{-- the code start here --}}
  <div class="row">
        <div class="col-lg-12">
        {{-- <div class="panel panel-default"> --}}
    
                <div class="panel-heading">
                <b><i class="fa fa-book"></i> Edit Details</b>
                <b class="pull-right"></b>
                </div>
                <div class="panel-body" styte="padding-bottom:4px;">
                <hr class="line">
                
                <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" required>
                    <input type="hidden" name="dateregistered" id="dateregistered" 
                    value="{{date('Y-m-d')}}">
                    <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9">
    
                    {{---------------First Name------------------}}
    
                    <div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" name="first_name" id="first_name" class="form-control 
                    text-capitalize"value="{{$teacher->first_name}}">
                    </div>
                    </div>
    
                    {{---------------Last Name------------------}}
    
                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="last_name" id="last_name" class="form-control  
                        text-capitalize"value="{{$teacher->last_name}}">
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
                                <input type="radio" name="gender" id="gender" value="0" {{$teacher->gender  == '0' ? 'checked' : ''}} >
                                Male
                            </label>
                            </td>
                            <td>
                            <label>
                                <input type="radio" name="gender" id="gender" value="1" {{$teacher->gender  == '1' ? 'checked' : ''}} >
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
                        <input type="text" name="dob" id="dob" class="form-control  text-capitalize"
                        value="{{$teacher->dob}}" >
                        </div>
                        </div>
                        </div>
    
                        {{--------------------Passport-----------------}}
    
                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                        value="{{$teacher->passport}}">
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
                                <input type="radio" name="status" id="status" value="0" {{$teacher->status  == '0' ? 'checked' : ''}} >
                                {{-- {{ $teacher->status == '0' ? 'selected' : ''}} --}}
                                Single
                            </label>
                            </td>
                            <td>
                            <label>
                                <input type="radio" name="status" id="status" value="1" {{$teacher->status  == '1' ? 'checked' : ''}}>
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
                        <input type="text" name="nationality" id="nationality" class="form-control 
                         text-capitalize"value="{{$teacher->nationality}}">
                        </div>
                        </div>
                    
                    {{-------------------------Phone-----------------}}
    
                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="phone" id="phone" class="form-control 
                         text-capitalize" value="{{$teacher->phone}}">
                        </div>
                        </div>
    
                    {{------------------------Email-----------------}}
    
                        <div class="col-md-8">
                        <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control 
                         text-capitalize" value="{{$teacher->email}}" >
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
                        {{-- WE WILL ADD ANOTHER DIV FOR OUR SEMESTER FIELD 
                            OKAY BUT I WILL NOT USE THAT FIELD HENCE WE ARE
                            HAVING THAT INSIDE OUR CLASS ASSIGNING SO WE WILL
                            REMOVE IT FROM HERE OKAY. --}}

    
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
                            <input type="hidden" name="hidden_image" value="{{ $teacher->image }}" />
                            {{-- Html::image is the same as asset okay they all calling from public folder okay --}}
                            <img class="teacher-image" src="{{ asset('teacher_images/' .$teacher->image ) }}" 
                             style="border-radius:100%; width:150px;height:150px; 
                             vartical-align:middle;" 
                             alt="Teacher picture" 
                              id="showImage">
                                    {{-- {!!Html::image('teacher_images/' .$teacher->image, 
                                      ['class'=>'teacher-image', 'id'=>'showImage'])!!} --}}
                                    <input type="file" name="image" id="image" 
                                    accept="image/x-png,image/png,image/jpg,image/jpeg">
                                    {{-- <img src="{{ asset('teacher_images/' .$teacher->image ) }}" alt="image"> --}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                    <input type="button" name="browse_file" id="browse_file" 
                    class="btn-choose  text-capitalize btn btn-outline-secondary"value="Choose">
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        {{-- <br> --}}
                                        
                    {{-------------------------Address-----------------}}
    
                            <div class="content">
                                <div class="panel-heading" style="margin-top: -20px;">
                                <b><i class="fa fa-map-marker"></i> Address</b>
                                </div>
                                <hr class="line">
    
                    {{---------------------Address------------------------------}}
                            <div class="row">
                            <div class="col-md-12" style="padding-left:50px;">
                            <div class="form-group">
                            <textarea placeholder="Enter Address Here" name="address" id="address"
                             cols="40" rows="2" class="form-control  text-capitalize">{{$teacher->address}}</textarea>
                            </div>
                            </div>
                            </div>
                            </div>
                    </div>
                    </div>
    
                    <div class="modal-footer">
                            <a type="button" class="btn btn-danger"" href="{!! route('teachers.index') !!}">back</a> 
                     {!! Form::submit('Update Teacher', ['class' => 'btn btn-info']) !!}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      </div>
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

                        // $('#dob').datepicker({
                        //         changeMonth:true,
                        //         changeYear:true,
                        //         dateFormat:'yy-mm-dd'
                        // });
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

                        // $(document).ready(function(){

// jQuery(function($){
// $(document).ajaxSend(function() {
//     $("#overlay").fadeIn(300);　
// });
    
// $('#button').click(function(){
//     alert(1)
//     // $.ajax({
//     //     type: 'GET',
//     //     success: function(data){
//     //         console.log(data);
//     //     }
//     // }).done(function() {
//     //     setTimeout(function(){
//     //         $("#overlay").fadeOut(300);
//     //     },500);
//     // });
// });	
// });       
                        //------------------------------------------------------
</script>
@endsection