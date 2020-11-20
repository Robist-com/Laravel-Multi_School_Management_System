<?php $url = Request::is('get-class-attendance/*');?>

<h2><i class="fa fa-users"> HOMEWORKS</i> </h2>
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
                        <h2>Homework Edit </h2>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn bg-teal btn-round">{{$edit_homework->class_code}}</button>
                            <button type="button" class="btn bg-teal btn-round dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a data-toggle="tooltip" title="{{$edit_homework->class_name}}"
                                        class="dropdown-item" href="#">
                                        <label for="" class="active">{{$edit_homework->semester_name}} </label> |
                                        {{$edit_homework->class_code}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                        </div>
                        <h3> @if(isset($class_assign)) @foreach ($class_assign as $n => $result) <b
                                style="font-weight:bold; color:red">{{$result->semester_name}}</b>
                            <b>{{$result->course_name}}</b> @endforeach @endif
                        </h3>
                        <a href="{{url('homework-list')}}" data-toggle="tooltip" data-placement="right"
                            title="View homework list"><button class="btn bg-teal btn-round">Homework List</button></a>

                    </div>
                </div>
                <div class="">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <div class="clearfix"></div>
                            </div>

                            <h2> <b style="font-weight:bold; color:red">{{$edit_homework->semester_name}}</b>
                                <b>{{$edit_homework->course_name}}</b>
                            </h2>

                            <form action="{{route('homework-update', $edit_homework->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <style class="cp-pen-styles"></style>

                                <input type="hidden" name="class_code" id="id_class"
                                    value="{{$edit_homework->class_code}}" class="form-control"
                                    placeholder="Enter Class ">
                                <input type="hidden" name="subject_id" id="id_subject_id"
                                    value="{{$edit_homework->subject_id}}" class="form-control"
                                    placeholder="Enter Subject ">
                                <input type="hidden" name="grade" id="id_grade" value="{{$edit_homework->semester_id}}"
                                    class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="teacher_id" id="id_teacher_id"
                                    value="{{$edit_homework->teacher_id}}" class="form-control"
                                    placeholder="Enter Subject ">

                                <textarea id="ckeditor" name="body">{{$edit_homework->body}}</textarea>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wrap-custom-file">
                                            <input type="file" name="homework_file" id="homework_file"
                                                accept=".gif, .jpg, .png" />
                                            <label for="homework_file">
                                                <span>Change File / Upload New</span>
                                                <i class="fa fa-plus-circle"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{asset('teacher_homeworks/' .$edit_homework->file)}}" }} alt=""
                                            width="150px">
                                        <input type="hidden" name="hidden_image" id="" value="{{$edit_homework->file}}">
                                    </div>

                                    <div class="form-group">
                                        <div class="control-group col-md-6">
                                            <div class="controls">
                                                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                    <div class="form-line">
                                                        <input name="start_date" id="start_date" type="text"
                                                            class="form-control has-feedback-left" id="single_cal4"
                                                            placeholder="Start Date"  value=" {{date('Y-m-d', strtotime($edit_homework->start_date))}}"
                                                            aria-describedby="inputSuccess2Status4" autocomplete="off">
                                                    </div>
                                                    <span class="fa fa-calendar-o form-control-feedback left"
                                                        aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group col-md-6">
                                            <div class="controls">
                                                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                    <div class="form-line">
                                                        <input name="end_date" id="end_date" type="text"
                                                            class="form-control has-feedback-left" id="single_cal5"
                                                            placeholder="End Date"  value="{{date('Y-m-d', strtotime($edit_homework->end_date))}}"
                                                            aria-describedby="inputSuccess2Status5" autocomplete="off">
                                                    </div>
                                                    <span class="fa fa-calendar-o form-control-feedback left"
                                                        aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status5" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <!-- Status Field -->
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <div class="demo-switch-title">Status</div>
                                            <div class="switch">
                                                <label><input type="checkbox" name="status" id="status" {{$edit_homework->status == 1 ? 'checked' : ''}}><span
                                                        class="lever switch-col-teal"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <br><br>
                                  
                                    <div class="col-md-12"></div>
                                    <div class="modal-footer">
                                        <a href="{{route('homework-list')}}"><button class="btn btn-danger btn-round"
                                                data-toggle="tooltip" data-placement="left" title="Cancel Updating">
                                                Cancel
                                            </button></a>
                                        <button type="submit" class="btn bg-teal btn-round" data-toggle="tooltip"
                                            data-placement="top" title="Click to Update"> Update Homework </button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script
        src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js'></script>
    <!-- @section('js') -->
    <script>
    $(document).ready(function() {
        //{{---------------------Show Start Date-------------------}}  
        $('#start_date').datetimepicker({
            format: 'Y-m-d',
            useCurrent: false,
            timepicker: false
        });
        //  {{----------------------------Show End Date---------------------}}  
        $('#end_date').datetimepicker({
            format: 'Y-m-d',
            useCurrent: false,
            timepicker: false
            // autoComplete: false
        });

    })

    $('#status').on('change', function() {
        var test = $(this).prop('checked') === true ? 1 : 0;
        $('#status').val(test);
    });

    $(function() {
        //CKEditor
        CKEDITOR.replace('ckeditor');
        CKEDITOR.config.height = 160;

        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 160,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '../../plugins/tinymce';
    });

    $('input[type="file"]').each(function(){
  // Refs
  var $file = $(this),
      $label = $file.next('label'),
      $labelText = $label.find('input[name="edit"]'),
      labelDefault = $labelText.text();
  
  // When a new file is selected
  $file.on('change', function(event){
    var fileName = $file.val().split( '\\' ).pop(),
        tmppath = URL.createObjectURL(event.target.files[0]);
    //Check successfully selection
		if( fileName ){
            $label
        .addClass('file-ok')
        .css('background-image', 'url(' + tmppath + ')');
			$labelText.text(fileName);
           
    }else{
      $label.removeClass('file-ok');
			$labelText.text(labelDefault);
    }
  });
  
// End loop of file input elements  
});


    </script>
    <!-- </body></html> -->






    <!-- @endsection -->