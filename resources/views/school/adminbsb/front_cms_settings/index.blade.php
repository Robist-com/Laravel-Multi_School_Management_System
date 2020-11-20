<style>
.teacher-image {
    height: 76px;
    padding-left: 1px;
    padding-right: 1px;

    background: #eee;
    width: 220px;
    margin: 0 auto;
    /* border-radius: 50%; */
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #0000;


}

.teacher-image_fav {
    height: 50px;
    padding-left: 1px;
    padding-right: 1px;

    background: #eee;
    width: 220px;
    margin: 0 auto;
    /* border-radius: 50%; */
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #0000;

}

.image>input[type="file"] {
    display: none;
    cursor: pointer;
}

.btn-choose {
    padding: 5px;
    text-align: center;
    border: 1px solid !important;
    color: black;
    border-radius: 0%;
    /* width:55%; */
}

.btn-choose:hover {
    background-color: #605ca8;
    transform: translateX(0);
    transition: all .3s ease;
    color: white;
}


ul {
    list-style-type: none;
}

.theme {
    display: inline-block;
}

input[type="checkbox"][name^="theme_name"] {
    display: none;
}

label {
    border: 1px solid #fff;
    padding: 10px;
    display: block;
    margin: 10px;
    cursor: pointer;
}

label:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
}

label img {
    height: 150px;
    width: 150px;
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
}

/* :checked+label {
    border-color: #ddd;
} */

:checked+label:before {
    background-color: #26A69A;
    transform: scale(1);
    /* color: rgba(61, 63, 67, 1); */
	 font-family: FontAwesome;
	 border: 2px solid rgba(29, 201, 115, 1);
	 content: "\f00c";
	 font-size: 24px;
	 position: absolute;
	 top: -25px;
	 left: 10%;
	 transform: translateX(-50%);
	 height: 50px;
	 width: 50px;
	 line-height: 50px;
	 text-align: center;
	 border-radius: 50%;
}

:checked+label img {
    transform: scale(0.9);
    content: "✓";
    box-shadow: 0 0 5px #333;
    z-index: -1;
    color:#ffffff;
}


h1 {
	 color: rgba(24, 25, 27, 1);
	 margin-bottom: 2rem;
}
 section {
	 display: flex;
	 flex-flow: row wrap;
}
 section > div {
	 flex: 1;
	 padding: 0.5rem;
}
 input[type="radio"] {
	 display: none;
}
 input[type="radio"]:not(:disabled) ~ .style {
	 cursor: pointer;
}
 input[type="radio"]:disabled ~ .style {
	 color: rgba(188, 194, 191, 1);
	 border-color: rgba(188, 194, 191, 1);
	 box-shadow: none;
	 cursor: not-allowed;
}
 .style {
	 height: 100%;
	 display: block;
	 background: white;
	 /* border: 2px solid rgba(32, 223, 128, 1); */
	 /* border-radius: 20px; */
	 padding: 1rem;
	 margin-bottom: 1rem;
	 text-align: center;
	 /* box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5); */
	 position: relative;
}
 input[type="radio"]:checked + .style {
	 /* background: rgba(32, 223, 128, 1); */
	 color: rgba(255, 255, 255, 1);
	 /* box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75); */
}
 /* input[type="radio"]:checked + .style::after {
	 color: rgba(61, 63, 67, 1);
	 font-family: FontAwesome;
	 border: 2px solid rgba(29, 201, 115, 1);
	 content: "\f00c";
	 font-size: 24px;
	 position: absolute;
	 top: -25px;
	 left: 50%;
	 transform: translateX(-50%);
	 height: 50px;
	 width: 50px;
	 line-height: 50px;
	 text-align: center;
	 border-radius: 50%;
} */

	 font-weight: 900;
}
 @media only screen and (max-width: 700px) {
	 .style {
		 flex-direction: column;
	}
}
 

</style>

@include('school.website.gallary.style')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                FRONT CMS SETTINGS
            </h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="body">
            @if(is_null($front_cms))
            <form action="{{route('front_cms.store')}}" class="form-horizontal" method="post" autocomplete="off">
            @else
            <form action="{{route('front_cms.update', $front_cms->id)}}" class="form-horizontal" method="post" autocomplete="off">
                @method('put')
            @endif
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row"></div>
                        <div class="col-md-6">
                            <div class="col-md-4">
                                <span>Auto Updates</span>
                            </div>
                            <div class="col-md-8">
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <span>Auto Updates</span>
                            </div>
                            <div class="col-md-8">
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <span>Auto Updates</span>
                            </div>
                            <div class="col-md-8">
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <spand>Logo (80px X 76px)</spand>
                            </div>
                            <div class="col-md-7">
                                <div class="image">
                                    {!!Html::image('institute_logo/default_logo.jpg',
                                    null, ['class'=>'teacher-image', 'id'=>'showImage'])!!}
                                    <input type="file" name="image_logo" id="image"
                                        accept="image/x-png,image/png,image/jpg,image/jpeg" style="cursor:pointer">
                                    <span id="browse_file"></span>
                                    <input type="button" name="browse_file"
                                        class="form-control  text-capitalize btn-choose" class="btn btn-outline-danger"
                                        value="Choose" style="display:none">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <spand>Favicon (32px X 32px)</spand>
                            </div>
                            <div class="col-md-7">
                                <div class="image">
                                    {!!Html::image('institute_logo/default_logo.jpg',
                                    null, ['class'=>'teacher-image_fav', 'id'=>'showImage_fav'])!!}
                                    <input type="file" name="image_fav" id="image_fav"
                                        accept="image/x-png,image/png,image/jpg,image/jpeg" style="cursor:pointer">
                                    <span id="browse_file_fav"></span>
                                    <input type="button" name="browse_file_fav"
                                        class="form-control  text-capitalize btn-choose_fav"
                                        class="btn btn-outline-danger" value="Choose" style="display:none">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <spand>Footer Text</spand>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="footer_text" id="footer_text" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <spand>Meta Tag</spand>
                            </div>
                            <div class="col-md-7">
                                <textarea name="meta_tags" id="meta_tags" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-5">
                                <spand>Google Analytics</spand>
                            </div>
                            <div class="col-md-7">
                                <textarea name="google_analytics" id="google_analytics" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Social Links</label>
                            <div class="col-md-4">
                                <spand>FaceBook URL</spand>
                            </div>
                            <div class="col-md-8">
                                <input type="text" placeholder="https://www.facebook.com/-----" value="{{$front_cms->facebook_link}}" name="facebook_link" id="facebook_link" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <spand>Instagram URL</spand>
                            </div>
                            <div class="col-md-8">
                                <input type="text" placeholder="https://www.instagram.com/-----" value="{{$front_cms->instagram_link}}" name="instagram_link" id="instagram_link" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <spand>Twiter URL</spand>
                            </div>
                            <div class="col-md-8">
                                <input type="text" placeholder="https://www.twitter.com/-----" value="{{$front_cms->twitter_link}}" name="twitter_link" id="twitter_link" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <spand>WhatsApp URL</spand>
                            </div>
                            <div class="col-md-8">
                                <input type="text" placeholder="https://www.whatsapp.com/-----" value="{{$front_cms->whatsapp_link}}" name="whatsapp_link" id="whatsapp_link" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <spand>Youtube URL</spand>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{$front_cms->youtube_link}}" name="youtube_link" id="youtube_link" class="form-control">
                            </div>

                        </div>
                                        
                        <div class="col-md-12">
                            <hr>
                            <label>Default Themes</label>
                            <ul class="style">
                                <li class="theme gallery-list">
                                    <input type="radio" id="theme_orange" name="theme_name" @if($front_cms->theme_status == 1 && $front_cms->theme_name == 'theme_orange') checked @endif value="theme_orange" data-school_id="{{auth()->user()->school_id}}"/>
                                    <label for="theme_orange"><img src="{{asset('themes_template/theme_orange.png')}}" /></label>
                                </li>

                                <li class="theme">
                                    <input type="radio" id="theme_dark_blue" name="theme_name" value="theme_dark_blue" @if($front_cms->theme_status == 1 && $front_cms->theme_name == 'theme_dark_blue') checked @endif data-school_id="{{auth()->user()->school_id}}"/>
                                    <label for="theme_dark_blue"><img
                                    src="{{asset('themes_template/theme_dark-blue.png')}}" /></label>
                                </li>

                                <li class="theme">
                                    <input type="radio" id="theme_marong" name="theme_name" value="theme_marong" @if($front_cms->theme_status == 1 && $front_cms->theme_name == 'theme_marong') checked @endif data-school_id="{{auth()->user()->school_id}}"/>
                                    <label for="theme_marong"><img
                                    src="{{asset('themes_template/theme_marong.png')}}" /></label>
                                </li>

                                <li class="theme">
                                    <input type="radio" id="theme_blue" name="theme_name" value="theme_blue" @if($front_cms->theme_status == 1 && $front_cms->theme_name == 'theme_blue') checked @endif data-school_id="{{auth()->user()->school_id}}"/>
                                    <label for="theme_blue"><img
                                    src="{{asset('themes_template/theme_blue.png')}}" /></label>
                                    <div id="test"> </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn bg-teal" id="btn_save_seetings">Save</button>
        </div>
        </form>

    </div>
</div>

@section('js')
<script>


$(document).ready(function(){

     var themeName =   $('input[name=theme_name]').val();
    if (themeName === 'theme_orange') {
        $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#F58000"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#F58000"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">')
    }else if(themeName === 'theme_blue'){
        $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#03A9F4"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#03A9F4"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');

    }else if(themeName === 'theme_dark_blue'){
        $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#202C45"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#202C45"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');
        
    }else if(themeName === 'theme_marong'){
        $('#test').html(' <input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#BD0745"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#BD0745"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');
    }
    // alert(themeName);

            $('#theme_orange').on('change', function(){
            // $('#theme_switcher').prop('checked');
            let template = $(this).prop('checked') === true ? 'theme_orange' : '';
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();
            let header_bg = $('#header_background_color_orange').val();
            let header_fg = $('#header_forground_color_orange').val();
            let footer_bg = $('#footer_background_color_orange').val();
            let footer_fg = $('#footer_forground_color_orange').val();
// alert(template)
           if(template == 'theme_orange'){
            $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#F58000"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#F58000"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">')


           }

    })

    $('#theme_blue').on('change', function(){
            // $('#theme_switcher').prop('checked');
            let template = $(this).prop('checked') === true ? 'theme_blue' : '';
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();
            let header_bg = $('#header_background_color_orange').val();
            let header_fg = $('#header_forground_color_orange').val();
            let footer_bg = $('#footer_background_color_orange').val();
            let footer_fg = $('#footer_forground_color_orange').val();
   
        if (template == 'theme_blue') {
            $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#03A9F4"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#03A9F4"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');
           
        }

    })

    
    $('#theme_dark_blue').on('change', function(){
            // $('#theme_switcher').prop('checked');
            let template = $(this).prop('checked') === true ? 'theme_dark_blue' : '';
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();
            let header_bg = $('#header_background_color_orange').val();
            let header_fg = $('#header_forground_color_orange').val();
            let footer_bg = $('#footer_background_color_orange').val();
            let footer_fg = $('#footer_forground_color_orange').val();
   
        if (template == 'theme_dark_blue') {
            $('#test').html('<input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#202C45"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#202C45"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');

        }
    })

    $('#theme_marong').on('change', function(){
            // $('#theme_switcher').prop('checked');
            let template = $(this).prop('checked') === true ? 'theme_marong' : '';
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();
            let header_bg = $('#header_background_color_orange').val();
            let header_fg = $('#header_forground_color_orange').val();
            let footer_bg = $('#footer_background_color_orange').val();
            let footer_fg = $('#footer_forground_color_orange').val();
            // alert(template)
        if (template == 'theme_marong') {
            $('#test').html(' <input type="hidden" name="header_bg_color" id="header_background_color_orange" value="#BD0745"><input type="hidden" name="header_fg_color" id="header_forground_color_orange" value="#ffffff"><input type="hidden" name="footer_bg_color" id="footer_background_color_orange" value="#BD0745"><input type="hidden" name="footer_fg_color" id="footer_forground_color_orange" value="#ffffff"><input type="hidden" name="theme_status" value="1">');
        }
    })


    $('#btn_save_seetings1').on('click', function(){
        theme_orange();
        alert(1)
    })
    
})





$('#showImage').on('click', function() {
    $('#image').click();
})
$('#image').on('change', function(e) {
    showFile(this, '#showImage');
});

function showFile(fileInput, img, showName) {
    if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(img).attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
    $(showName).text(fileInput.files[0].name)
};
</script>
@endsection