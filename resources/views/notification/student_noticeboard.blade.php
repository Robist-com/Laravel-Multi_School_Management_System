
@extends('layouts.app')

@section('content')
<section class="content-header">
        <h1>
            Notication Board
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
<!-- <!DOCTYPE html><html class=''> -->
    <!-- <form action="{{url('save-notice')}}" method="post"> -->
    {!! Form::open(['route' => 'save-notice']) !!}
        @csrf
<style class="cp-pen-styles"></style>

    <div class="col-md-12">
    <input type="text" name="type" id="id_type" class="form-control" placeholder="Enter Notification Type">
    </div>
</div>
<br>
<!-- <div id="tinymce-form"> -->

<fieldset class="form-group">
    <textarea 
            class="form-control" 
            id="editor" 
            name="body" 
            rows="5" 
            placeholder="Content"
            v-tinymce-editor="content">          
    </textarea>
</fieldset>
<!-- </div> -->

<div class="row">
    <div class="col-md-6">
    <input type="text" name="start_date" id="start_date" class="form-control">
    </div>
    <div class="col-md-6">
    <input type="text" name="end_date" id="end_date" class="form-control">
    </div>
    <br><br>
    <!-- Status Field -->
    <div class="form-group col-sm-6" name="status" id="status">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
    </div>
<div class="modal-footer">
    <a href="{{url('home')}}"><button class="btn btn-default btn-rounded"> Cancel </button></a>
    <button type="submit" class="btn btn-success btn-rounded"> Create Notication </button>
</div>
</form>
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