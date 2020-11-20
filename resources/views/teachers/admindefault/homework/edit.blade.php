@extends('layouts.new-layouts.app')

@section('content')

<div class="content">

<div class="clearfix"></div>
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
    <h2>Homework Edit </h2>
    <div class="btn-group pull-right">
                    <button type="button" class="btn btn-dark btn-round">{{$edit_homework->class_code}}</button>
                    <button type="button" class="btn btn-dark btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <div class="clearfix"></div>
  </div>

        <h2 > <b style="font-weight:bold; color:red">{{$edit_homework->semester_name}}</b>  <b>{{$edit_homework->course_name}}</b></h2>

    <form action="{{route('homework-update', $edit_homework->id)}}" method="post" enctype="multipart/form-data">
        @csrf
<style class="cp-pen-styles"></style>

    <input type="hidden" name="class_code" id="id_class" value="{{$edit_homework->class_code}}" class="form-control" placeholder="Enter Class ">
    <input type="hidden" name="subject_id" id="id_subject_id" value="{{$edit_homework->subject_id}}" class="form-control" placeholder="Enter Subject ">
    <input type="hidden" name="grade" id="id_grade" value="{{$edit_homework->semester_id}}" class="form-control" placeholder="Enter Subject ">
    <input type="hidden" name="teacher_id" id="id_teacher_id" value="{{$edit_homework->teacher_id}}" class="form-control" placeholder="Enter Subject ">
   
  <div id="alerts"></div>
                  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      </ul>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li>
                          <a data-edit="fontSize 5">
                            <p style="font-size:17px">Huge</p>
                          </a>
                        </li>
                        <li>
                          <a data-edit="fontSize 3">
                            <p style="font-size:14px">Normal</p>
                          </a>
                        </li>
                        <li>
                          <a data-edit="fontSize 1">
                            <p style="font-size:11px">Small</p>
                          </a>
                        </li>
                      </ul>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                      <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                        <button class="btn" type="button">Add</button>
                      </div>
                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" title="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                      <input type="file"  name="homework_file" id="homework_file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage">
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                    </div>
                  </div>

                  <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true">{{$edit_homework->body}}</div>

                  <textarea name="body" id="descr" style="display:none;">{{$edit_homework->body}}</textarea>

<div class="row">
<div class="col-md-6">
   <label for="">Choose Homework File</label> 
   <input type="file" name="homework_file" id="homework_file" value="{{$edit_homework->file}}" class="form-control" placeholder="Enter Start Date">
        <!-- <img  src="{{asset('teacher_homeworks/' .$edit_homework->file)}}"}} alt="" width="150px">
        <input type="text" name="" id="" value="{{$edit_homework->file}}"> -->
    </div>
    <div class="col-md-6">
        <img  src="{{asset('teacher_homeworks/' .$edit_homework->file)}}"}} alt="" width="150px">
        <input type="hidden" name="hidden_image" id="" value="{{$edit_homework->file}}">
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
    <!-- {!! Form::label('status', 'Status:') !!} -->
    <label class="checkbox-inline">
        <!-- {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null, ['class'=> 'flat']) !!} status -->
        <input type="checkbox"  class="flat" name="status" id="status" @if($edit_homework->status == 1) checked value="1" @endif value="1">
    </label>
    </div>
<div class="modal-footer">
<a href="{{route('homework-list')}}"><button class="btn btn-danger btn-round" data-toggle="tooltip" data-placement="left" title="Cancel Updating"> Cancel </button></a>
    <button type="submit" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="top" title="Click to Update"> Update Homework </button>
</form>
</div>
</div>
</div>


            </div>
        </div>
    </div>
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
   
   $('#editor-one').on('keyup', function(){
    var edit = $('#editor-one').text();
    $('#descr').val(edit);
   })
    
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