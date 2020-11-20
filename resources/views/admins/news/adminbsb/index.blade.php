@include('flash::message')
@include('adminlte-templates::common.errors')

<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>NEWS </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        @if(isset($school_news))
            <a href="{{route('news.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="fa fa-arrow-left"></i>
            Return</a>
            @else
            <a href="{{route('news.create')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
      @endif
    </div>
    <br><br>
    <div class="row clearfix">
    @if(isset($school_new))
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($school_new))
                    <h2>Update news</h2>
                    @else
                    <h2>Create news</h2>
                    @endif

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                @if(isset($school_new))
                {!! Form::open(['route' => 'news.update', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                @else
                {!! Form::open(['route' => 'news.store', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                @endif
                    <div class="form-group">
                        <label for="">Title <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input name="title" id="title" type="text" class="form-control " placeholder="Title"
                                aria-describedby="inputSuccess2Status4" autocomplete="off" @if(isset($school_new)) value="{{$school_new->title}}" @endif >
                            <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                            <input type="hidden" name="news_id" id="news_id" @if(isset($school_new)) value="{{$school_new->id}}" @endif>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="">Date <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input name="news_date" id="start_date" type="text" class="form-control "
                                placeholder="Title" aria-describedby="inputSuccess2Status4" autocomplete="off" @if(isset($school_new)) value="{{$school_new->news_date}}" @endif >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="form-group ">
                        <label for="">Featured Image</label>
                        <input type="file" name="featured_image" id="featured_image" @if(isset($school_new)) value="{{$school_new->image}}" @endif >
                        <br>
                        @if(isset($school_new)) <img src="{{asset('school_images/news/' .$school_new->image)}}" alt="" width="170px"> @endif   
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <select name="status" id="status" class="form-control bootstrap-select">
                            @if(isset($school_new))
                                <option value="1" @if($school_new->status = 1) selected @endif>Active</option>
                                <option value="0" @if($school_new->status = 0) selected @endif>In Active</option>
                            @else
                            <option value="1">Active</option>
                                <option value="0">In Active</option>
                            @endif 
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                    @if(isset($school_new))
                        <button type="submit" class="btn bg-teal btn-round "> Update News </button>
                   @else
                   <button type="submit" class="btn bg-teal btn-round "> Create News </button>
                   @endif
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <textarea name="body" id="ckeditor"> @if(isset($school_new)) {{$school_new->body}}@endif</textarea>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    @endif
      @if(isset($school_news))
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>News Table</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">

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
                                @foreach($school_news as $news)
                                <tr class="even pointer">
                                    <td>{!! $news->title !!}</td>
                                    <td>{!! $news->body !!}</td>
                                    <td>{!! $news->news_date !!}</td>
                                    <!-- <td>{!! $news->end_date !!}</td> -->
                                    <td>
                                        @if($news->status == 1)
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
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
                                                            class="material-icons">delete_forever</i> Delete</a>
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
</div>
</div>
</div>

<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js'></script>
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

