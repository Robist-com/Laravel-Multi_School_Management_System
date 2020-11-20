 <!-- Tabs With Icon Title -->

 <div class="block-header">
    <h2>
        MEDIA GALLERY
    </h2>
</div>

 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            MEDIA GALLERY
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">image</i> IMAGE GALLERY
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">movie</i> VIDEO GALLERY
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">keyboard_voice</i> VOICE MESSAGES
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">settings</i> SETTINGS
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">

                                <label for="">Upload image</label>
                                <form action="{{route('media.store')}}" method="post" enctype="multipart/form-data"
                                    class="dropzone">
                                    @csrf
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                    <input name="school_id" type="hidden" value="{{auth()->user()->school_id}}" />
                                </form>

                                <h2>Media Gallery</h2>
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    @foreach($media_images as $manager)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{asset('school_images/media_manager/' .$manager->filename)}}"
                                            data-sub-html="Demo Description">
                                            <img class="img-responsive thumbnail"
                                                src="{{asset('school_images/media_manager/' .$manager->filename)}}">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">

                                <!-- <div class="col-md-6 col-sm-6 col-xs-12 "> -->
                                    <label for="">Upload Video  </label>  <span> Only embaded link</span>
                                    <form action="{{route('videomedia.store')}}" method="post" enctype="multipart/form-data"
                                        autocomplete="off">
                                        @csrf

                                        <div class="form-group">
                                        <div class="form-line">
                                        <input required type="text" id="v_name" name="v_name" class="form-control"
                                            placeholder="Example: Test Video">
                                        </div>
                                        </div>
                                       
                                        <div class="form-group">
                                        <div class="form-line">
                                        <input required type="text" id="media" name="video_manager_url" class="form-control"
                                            placeholder="Example: https://www.youtube.com/embed/WjNDkWLHFMw">
                                        </div>
                                        </div>
                                    <input name="school_id" type="hidden" value="{{auth()->user()->school_id}}" />
                                    <br>
                                    <button class="btn btn-round bg-teal pull-right">Save Video</button>
                            
                                </form>
                                <!-- </div> -->
                                <h2>Video Gallery</h2>
                                <div class="row">
                                @foreach($media_videos as $manager)
                                <div class="col-md-4">
                                <iframe id="video" width="320" height="215" src="{{$manager->video_filename}}" frameborder="0" allowfullscreen></iframe>
                                <br>
                                <div class="modal-footer text-center">
                                <label for="">{{$manager->video_name}}</label>
                                </div>
                                </div>
                                @endforeach
                        </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <b>Voice Notes</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <b>Settings Content</b>
                                    <p>
                                       No Files to Download
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->

            @section('js')
<script type="text/javascript">
// $(document).ready(function() {
//     // alert(1);
// })
// Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drop files ";
// Dropzone.options.dropzone = {
//     maxFilesize: 12,
//     renameFile: function(file) {
//         var dt = new Date();
//         var time = dt.getTime();
//         return time + file.name;
//     },
//     acceptedFiles: ".jpeg,.jpg,.png,.gif",
//     addRemoveLinks: true,
//     timeout: 5000,
//     success: function(file, response) {
//         // console.log(response);
//         console.log(response.success);
//         // success: function (data) {
//         toastr.options.closeButton = true;
//         toastr.options.closeMethod = 'fadeOut';
//         toastr.options.closeDuration = 100;
//         toastr.success(response.success);
//     },
//     error: function(file, response) {
//         toastr.options.closeButton = true;
//         toastr.options.closeMethod = 'fadeOut';
//         toastr.options.closeDuration = 100;
//         toastr.error(response.success);
//         return false;
//     }
// };

$("#delete_media").click(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "delete/media_manager/" + id,
        type: 'DELETE', // Just delete Latter Capital Is Working Fine
        dataType: "JSON",
        data: {
            "id": id // method and token not needed in data
        },
        success: function(response) {
            console.log(response); // see the reponse sent
        },
        error: function(xhr) {
            console.log(xhr.responseText); // this line will save you tons of hours while debugging
            // do something here because of error
        }
    });
});


$(document).ready(function() {
    $('#play-video').on('click', function(ev) {

        $("#video")[0].src += "?autoplay=1";
        ev.preventDefault();

    });
});

$(function () {
    $('#aniimated-thumbnials').lightGallery({
        thumbnail: true,
        selector: 'a'
    });
});


</script>
@endsection