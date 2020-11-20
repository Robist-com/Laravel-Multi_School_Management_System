@extends('layouts.new-layouts.app')

@section('content')
@include('flash::message')
@include('adminlte-templates::common.errors')
@if(isset($school_new))
{!! Form::open(['route' => 'news.update', 'enctype' => 'multipart/form-data']) !!}
@csrf
@else
{!! Form::open(['route' => 'news.store', 'enctype' => 'multipart/form-data']) !!}
@csrf
@endif

<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>



<div class="x_content">
@if(isset($school_new))
<a href="{{route('news.index')}}" class="btn btn-dark btn-sm  pull-left"><i class="fa fa-arrow-left"></i>
            Return</a>
    <style class="cp-pen-styles"></style>
    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
    <input type="hidden" name="news_id" id="news_id" value="{{$school_new->id}}">

    <div class="col-md-12 ">
        <div class="col-md-9">
            <div class="x_panel ">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label for="">Title <b style="color:red">*</b></label>
                    <input name="title" id="title" type="text" class="form-control " placeholder="Title"
                        aria-describedby="inputSuccess2Status4" autocomplete="off" @if(isset($school_new)) value="{{$school_new->title}}" @endif >
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label for="">Date <b style="color:red">*</b></label>
                    <input name="news_date" id="start_date" type="text" class="form-control " placeholder="Title"
                        aria-describedby="inputSuccess2Status4" autocomplete="off" @if(isset($school_new)) value="{{$school_new->news_date}}" @endif >
                </div>
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="x_panel ">
                <label for="">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" @if(isset($school_new)) value="{{$school_new->image}}" @endif >
                <br>
                @if(isset($school_new)) <img src="{{asset('school_images/news/' .$school_new->image)}}" alt="" width="170px" name="featured_image"> @endif   
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="x_panel ">
                <!-- <label for="">Save </label> -->
                <!-- <a href="{{url('home')}}"><button class="btn btn-danger btn-round"> Cancel </button></a> -->
                <button type="submit" class="btn btn-dark btn-round "> Publish News </button>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div id="alerts"></div>
            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                            class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
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
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                            class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                            class="fa fa-underline"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                            class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                            class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                            class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                            class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                            class="fa fa-align-justify"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i
                            class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                        <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" title="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i
                            class="fa fa-picture-o"></i></a>
                    <input type="file" name="homework_file" id="homework_file" data-role="magic-overlay"
                        data-target="#pictureBtn" data-edit="insertImage">
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                </div>
            </div>

            <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true">@if(isset($school_new)) {{$school_new->body}} @endif </div>

            <textarea name="body" id="body" style="display:none">>@if(isset($school_new)) {{$school_new->body}} @endif </textarea>

            <div class="col-md-12" name="status" id="status">
                <br><br>
                <!-- {!! Form::label('status', 'Status:') !!} -->
                <label class="checkbox-inline">
                    {!! Form::hidden('status', 0) !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat'] ) !!} Status
                </label>
            </div>
            </form>
        </div>
    </div>
    @endif

    @if(isset($schoolnews))
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{route('news.create')}}" class="btn btn-dark btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
                <div class="x_panel">

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table js-exportable">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Title</th>
                                    <th class="column-title">Body</th>
                                    <th class="column-title">Date</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">image</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($schoolnews as $news)
                                <tr class="even pointer">
                                    <td>{!! $news->title !!}</td>
                                    <td>{!! $news->body !!}</td>
                                    <td>{!! $news->news_date !!}</td>
                                    <!-- <td>{!! $news->end_date !!}</td> -->
                                    <td>
                                        @if($news->status == 1)
                                        <label for="" style="color:#26B99A"><i
                                                class="fa fa-check-circle fa-lg"></i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="fa fa-ban fa-lg"></i></label>
                                        @endif
                                    </td>
                                    <td data-toggle="tooltip" data-placement="right" title="View Full detail">
                                        <img id="myImg" src="{{asset('school_images/news/' .$news->image)}}" alt=""
                                            width="15px" srcset="">
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['news.delete', $news->id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-news_id="{{$news->id}}" data-news="{{$news->news}}"
                                                        data-news_description="{{$news->news_description}}"
                                                        data-course_id="{{$news->course['course_name']}}"
                                                        data-created_at="{{$news->created_at}}"
                                                        data-updated_at="{{$news->updated_at}}" data-toggle="modal"
                                                        data-target="#news-show">
                                                        <i class="glyphicon glyphicon-print"></i> print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-news_id="{{$news->id}}" data-news="{{$news->news}}"
                                                        data-news_description="{{$news->news_description}}"
                                                        data-course_id="{{$news->course['course_name']}}"
                                                        data-created_at="{{$news->created_at}}"
                                                        data-updated_at="{{$news->updated_at}}" data-toggle="modal"
                                                        data-target="#news-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('news.edit', [$news->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                <a id="delete_link" href="#"
                                                    data-confirm= "Are you sure want to delete {{$news->news}} ?"><i
                                                            class="fa fa-trash fa-lg"></i> Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      @endif
</div>
</div>

<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js'></script>
<script>
// $(function() {

// tinymce directive
// 	Vue.directive('tinymce-editor',{ 
//   	twoWay: true,
//     bind: function() {
//     	var self = this;
//       tinymce.init({
//       	selector: '#editor',
//         setup: function(editor) {

//         	// init tinymce
//         	editor.on('init', function() {
//  						tinymce.get('editor').setContent(self.value);
//           });

//           // when typing keyup event
//           editor.on('keyup', function() {

//             // get new value
//           	var new_value = tinymce.get('editor').getContent(self.value);

//             // set model value
//             self.set(new_value)
//           });
//         }
//       });
//     },
//     update: function(newVal, oldVal) {
//     	// set val and trigger event
//     	$(this.el).val(newVal).trigger('keyup');
//     }

//   })

// 	new Vue({
//   	el: '#tinymce-form',
//     data: {
//     	content: ' '
//     }
//   })


// })

$(document).ready(function() {
    //{{---------------------Show Start Date-------------------}}  

    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
        // autoCompelete: false
    });
    //  {{----------------------------Show End Date---------------------}}  
    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
        // autoComplete: false
    });

    // $('#editor-one').on('keyup', function(){
    //     var editor_one  =  this.text();
    //     // alert(editor_one)
    //     $('#body').val(editor_one);
    // })

    $('.placeholderText').keyup(function() {
        var edit = $('.placeholderText').text();
        $('#body').val(edit);
    })

    //    var editor_one =  $("#editor-one").val();
    //    alert(editor_one);
    //                 $('#body').val(editor_one);

})
//# sourceURL=pen.js
</script>
<!-- </body></html> -->

@endsection