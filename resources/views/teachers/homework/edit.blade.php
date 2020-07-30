@extends('layouts.app')

@section('content')
<div class="content">

<div class="clearfix"></div>
<div class="box box-primary">
    <div class="box-body">
        <!-- Split button -->
   <div class="btn-group">
                    <button type="button" class="btn btn-danger">{{$edit_homework->class_code}}</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    <li>
                    <a data-toggle="tooltip" title="{{$edit_homework->class_name}}" class="dropdown-item" href="#">
                    <label for=""  class="active">{{$edit_homework->semester_name}} </label> | {{$edit_homework->class_code}}
                    </a></li>
                    </ul>
                    </div>
                    <div class="row">
                    </div>
        <h3 > <b style="font-weight:bold; color:red">{{$edit_homework->semester_name}}</b>  <b>{{$edit_homework->course_name}}</b></h3>
         <a href="#"><button class="btn btn-info">Homework Edit</button></a>
    
    </div>
</div>




    <!-- <div class="content">
        @include('adminlte-templates::common.errors') -->
        <div class="box box-primary">

            <div class="box-body">
    <form action="{{route('homework-update', $edit_homework->id)}}" method="post" enctype="multipart/form-data">
        @csrf
<style class="cp-pen-styles"></style>

    <input type="hidden" name="class_code" id="id_class" value="{{$edit_homework->class_code}}" class="form-control" placeholder="Enter Class ">
    <input type="hidden" name="subject_id" id="id_subject_id" value="{{$edit_homework->subject_id}}" class="form-control" placeholder="Enter Subject ">
    <input type="hidden" name="grade" id="id_grade" value="{{$edit_homework->semester_id}}" class="form-control" placeholder="Enter Subject ">
    <input type="hidden" name="teacher_id" id="id_teacher_id" value="{{$edit_homework->teacher_id}}" class="form-control" placeholder="Enter Subject ">
   
<!-- <div id="tinymce-form"> -->

<fieldset class="form-group">
    <textarea 
            class="form-control" 
            id="editor" 
            name="body" 
            rows="5" 

            placeholder="Content"
            v-tinymce-editor="content">{{$edit_homework->body}}    
    </textarea>
</fieldset>
<!-- </div> -->

<div class="row">
<div class="col-md-12">
   <label for="">Choose Homework File</label> <input type="file" name="homework_file" id="homework_file" value="{{$edit_homework->file}}" class="form-control" placeholder="Enter Start Date">
        <img  src="{{asset('teacher_homeworks/' .$edit_homework->file)}}"}} alt="">
        <input type="text" name="" id="" value="{{$edit_homework->file}}">
    </div>
<br><br><br><br>
    <div class="col-md-6">
    <input type="text" name="start_date" id="start_date" class="form-control" value="{{$edit_homework->start_date}}" placeholder="Enter Start Date" auto-complete="off">
    </div>
    <div class="col-md-6">
    <input type="text" name="end_date" id="end_date" class="form-control" value="{{$edit_homework->end_date}}" placeholder="Enter End Date" auto-complete="off">
    </div>
    </div>
    <br><br>
    <!-- Status Field -->
    <div class="col-md-12" name="status" id="status">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
    </div>
    </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success btn-rounded"> Update Homework </button>
</form>
<a href="{{route('homework-list')}}"><button class="btn btn-default btn-rounded"> Cancel </button></a>
</div>
</div>


            </div>
        <!-- </div> -->
    <!-- </div> -->
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js'></script>
<script >$(function() {

	// tinymce directive
	Vue.directive('tinymce-editor',{ 
  	twoWay: true,
    bind: function() {
    	var self = this;
      tinymce.init({
      	selector: '#editor',
        setup: function(editor) {
        
        	// init tinymce
        	editor.on('init', function() {
 						tinymce.get('editor').setContent(self.value);
          });
          
          // when typing keyup event
          editor.on('keyup', function() {
          	
            // get new value
          	var new_value = tinymce.get('editor').getContent(self.value);
            
            // set model value
            self.set(new_value)
          });
        }
      });
    },
    update: function(newVal, oldVal) {
    	// set val and trigger event
    	$(this.el).val(newVal).trigger('keyup');
    }
  
  })

	new Vue({
  	el: '#tinymce-form',
    data: {
    	content: ' '
    }
  })


})

$(document).ready(function(){
    //{{---------------------Show Start Date-------------------}}  
   
    $('#start_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                        // autoCompelete: false
                    });
    //  {{----------------------------Show End Date---------------------}}  
             $('#end_date').datetimepicker({
           format:'YYYY-MM-DD',
            useCurrent: false
            // autoComplete: false
        });

})
//# sourceURL=pen.js
</script>
<!-- </body></html> -->






@endsection