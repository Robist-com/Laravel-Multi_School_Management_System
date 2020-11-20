<style>
/* body {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #c7eae0;
    font-family: 'sans-serif', sans-serif;
} */

.tab-container {
    margin: 5% 10%;
    background-color: #c1e3d9;
    padding: 3%;
    border-radius: 4px;
}

.tab-menu {}

.tab-menu ul {
    margin: 0;
    padding: 0;
}

.tab-menu ul li {
    list-style-type: none;
    display: inline-block;
}

.tab-menu ul li a {
    text-decoration: none;
    color: rgba(0, 0, 0, 0.4);
    background-color: #b4cbc4;
    padding: 7px 25px;
    border-radius: 4px;
}

.tab-menu ul li a.active-a {
    background-color: #588d7d;
    color: #ffffff;
}

.tab {
    display: none;
}

.tab h2 {
    color: rgba(0, 0, 0, .7);
}

.tab p {
    color: rgba(0, 0, 0, 0.6);
    text-align: justify;
}

.tab-active {
    display: block;
}

/* ---------- NAVEGAÇÃO ABAS ---------- */

.tabs {
    display: flex;
    flex-wrap: wrap;
    max-width: 960px;
    margin: 0 auto;
    padding: 60px 0;
}

.tabs>label {
    order: 1;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    width: 120px;
    height: 50px;
    margin-right: 0.2rem;
    /* font-size: 1rem; */
    cursor: pointer;
    border-radius: 3px 3px 0 0;
    /* background: bisque; */
    font-weight: bold;
    transition: background ease-in-out 0.2s;
}

.tabs>label>img {
    width: 30px;
    max-width: 100%;
}

.tabs .tab {
    order: 99;
    flex-grow: 1;
    width: 100%;
    display: none;
    padding: 1rem;
    /* background: #c4c4c4; */
    border-radius: 3px;
}

.tabs input[type="radio"] {
    display: none;
}

.tabs input[type="radio"]:checked+label {
    background: #2A3F54;
    color: #ffff;
}

.tabs input[type="radio"]:checked+label+.tab {
    display: block;
}


.team_id {
    width: 50px;
    height: 30px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
}

/* CASO QUEIRA DEIXAR RESPONSIVO*/
@media (max-width: 739px) {

    /*.tabs .tab, .tabs label {
    order: initial;
  }*/
    .tab-1,
    .tab-2,
    .tab-3 {
        /*width: 100%;
    margin-right: 0;
    margin-top: 0.2rem;*/
        flex-direction: column;
        width: 80px;
        height: 80px;
    }
}

/*------------ Formulário ------------*/

/* Ajeitar input de passageiros/pessoas/quartos, colocar responsivo e com grid, botar ícones dentro de placeholder */

.form-label {
    /* margin-top: 10px;
  margin-bottom: 5px; */
}

.form-input {
    padding: 10px 15px;
    margin: 0 20px 10px 5px;
    border-radius: 3px;
    /* font-family: Lato, 'Segoe UI', Tahoma, Verdana, sans-serif; */
    color: #7D7575;
    border: none;
}

input[type="text"] {
    padding: 12px;
}

.form-btn {
    background-color: dodgerblue;
    border-radius: 3px;
    width: 200px;
    padding: 12px;
    text-transform: uppercase;
    color: #fff;
    border: none;
    cursor: pointer;
}
</style>

<style>
.dropzone {
    /* width: 100px; */
    /* height: 100px;
    min-height: 0px !important; */
    /* zoom:4px; */
    zoom: 0.7;
}


/* Style the horizontal ruler */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}


/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and delete button on extra small screens
@media screen and (max-width: 300px) {

    .cancelbtn,
    .deletebtn {
        width: 100%;
    }
} */

/* a {
    display: inline-block;
    margin-bottom: 20px;
    color: #000;
    font-family: Arial, sans-serif;
} */
</style>

<div class="block-header">
    <h2>
        MEDIA GALLERY
    </h2>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    MEDIA GALLERY
                </h2>
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
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="">Upload image</label>
                        <form action="{{route('media.store')}}" method="post" enctype="multipart/form-data"
                            class="dropzone">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                            <input name="school_id" type="hidden" value="{{auth()->user()->school_id}}" />
                        </form>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <label for="">Upload Video</label>
                        <form action="{{route('videomedia.store')}}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <span>Only embaded link</span>
                            <div class="form-line">
                            <input required type="text" id="media" name="video_manager_url" class="form-control"
                                placeholder="Example: https://www.youtube.com/embed/WjNDkWLHFMw">
                            </div>
                        <input name="school_id" type="hidden" value="{{auth()->user()->school_id}}" />
                        <br>
                        <button class="btn btn-round bg-teal pull-right">Save Video</button>
                   
                    </form>
                    </div>
                </div>

                <!-- </div> -->
                <div class="tab-menu">
                    <ul>
                        <li><a href="#" class="tab-a active-a" data-id="tab1">Images</a></li>
                        <li><a href="#" class="tab-a" data-id="tab2">Videos</a></li>
                        <li><a href="#" class="tab-a" data-id="tab3">Others</a></li>
                    </ul>
                </div>
                <div class="tab tab-active" data-id="tab1">
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

                <div class="tab " data-id="tab2">
                <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Video Gallery</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            @foreach($media_videos as $manager)
                            <div class="col-md-4">
                            <iframe id="video" width="320" height="215" src="{{$manager->video_filename}}" frameborder="0" allowfullscreen></iframe>
                              <br>
                              <div class="modal-footer text-center">
                             <label for="">Video Name</label>
                              </div>
                              </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>

                <div class="tab " data-id="tab3">
                    <h2>what</h2>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript">
$(document).ready(function() {
    // alert(1);
})
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


// Get the modal
// var modal = document.getElementById('id01');

$(document).ready(function() {
    // alert(1)
    $('.tab-a').click(function() {
        $(".tab").removeClass('tab-active');
        $(".tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
        $(".tab-a").removeClass('active-a');
        $(this).parent().find(".tab-a").addClass('active-a');
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