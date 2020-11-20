<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>
@include('admins.id_cards.style')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>ID ACRD TEMPLATES </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        @if(isset($card_templateEdit))
        <a href="{{url('design/id_card')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Return</a>
        @endif
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

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
                    @if(isset($add_member))
                    @if(isset($card_templateEdit))
                    {!! Form::model($card_templateEdit, ['route' => ['student_idCard.update', $card_templateEdit->id],
                    'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' =>
                    'multipart/form-data']) !!}
                    @csrf
                    @else
                    {!! Form::open(['route' => 'student_idCard.store', 'class' => 'form-horizontal form-label-left',
                    'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    @endif

                    <!-- <div class="col-md-12"> -->
                    <!-- <div class="col-md-4"> -->

                        @if(auth()->user()->group == "Admin")
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                    <option>Choose School</option>
                                    @foreach (auth()->user()->school->all() as $school)
                                    <option value="{{ $school->id }}"
                                        @if(isset($card_templateEdit)){{$card_templateEdit->school_id == $school->id ? 'selected' : ''}}
                                        @endif>
                                        {{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                        @endif

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default color is white"></b> <label for="">ID
                                    Card Title </label>
                                <select name="card_title" id="card_title" class="form-control bootstrap-select"
                                    @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_signature}}"
                                    @endif autocomplete="off" required>
                                    <option value="">Select</option>
                                    <option value="student_id_card" @if(isset($card_templateEdit))
                                        @if($card_templateEdit->card_title === 'student_id_card') selected @endif
                                        @endif >Student ID Card</option>
                                    <option value="staff_id_card" @if(isset($card_templateEdit))
                                        @if($card_templateEdit->card_title === 'staff_id_card') selected @endif
                                        @endif >Staff ID Card</option>
                                    <option value="admit_card" @if(isset($card_templateEdit)) @if($card_templateEdit->
                                        card_title === 'admit_card') selected @endif @endif
                                        >Admit Card</option>
                                    <option value="leaving_certificate" @if(isset($card_templateEdit))
                                        @if($card_templateEdit->card_title === 'leaving_certificate') selected
                                        @endif @endif >Leaving Certificate</option>
                                </select>
                            </div>
                        </div>
                       


                        <!---------------------------------
                        CUSTOM FILE INPUTS FOR IMAGES
                        ---------------------------------->

                        <div id="page">
                        
                        @if(isset($card_templateEdit))
                        <div class="wrap-custom-file">
                            <input type="file" name="school_background_image" id="image1" accept=".gif, .jpg, .png" />
                            <label  for="image1">
                            <input type="hidden" name="edit_school_background_image" id="" value="edit_school_background_image">
                            <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_background_image)}}"
                                    alt="" srcset="" width="120px" id="edit_school_background_image">
                             <span for="">Background Image <i class="fa fa-plus-circle"></i></span>
                            </label>
                        </div>
                        @else
                        <div class="wrap-custom-file">
                            <input type="file" name="school_background_image" id="image1" accept=".gif, .jpg, .png" />
                            <label  for="image1">
                             <span for="">Background Image <i class="fa fa-plus-circle"></i></span>
                            </label>
                        </div>
                        @endif

                        @if(isset($card_templateEdit))
                        <div class="wrap-custom-file">
                            <input type="file" name="school_logo" id="image2" accept=".gif, .jpg, .png" />
                            <label  for="image2">
                            <input type="hidden" name="edit_school_logo" id="" value="edit_school_logo">
                            <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_logo)}}"
                                    alt="" srcset="" width="120px" id="edit_school_logo">
                             <span for="">Background Image <i class="fa fa-plus-circle"></i></span>
                            </label>
                        </div>
                        @else
                        <div class="wrap-custom-file">
                            <input type="file" name="school_logo" id="image2" accept=".gif, .jpg, .png" />
                            <label  for="image2">
                             <span for="">Background Image <i class="fa fa-plus-circle"></i></span>
                            </label>
                        </div>
                        @endif
                        

                        @if(isset($card_templateEdit))
                        <div class="wrap-custom-file">
                            <input type="file" name="school_signature" id="image3"  accept=".gif, .jpg, .png" />
                            <label  for="image3">
                            <input type="hidden" name="edit_school_signature" id="" value="edit_school_signature">
                            <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_signature)}}"
                                    alt="" srcset="" width="120px" id="edit_school_signature">
                            <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                        @else
                        <div class="wrap-custom-file">
                            <input type="file" name="image3" id="image3" accept=".gif, .jpg, .png" />
                            <label  for="image3">
                            <span>School Signature</span>
                            <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                        @endif
                                
                        @if(isset($card_templateEdit))
                        <div class="wrap-custom-file">
                            <input type="file" name="qrcode" id="image4" accept=".gif, .jpg, .png" />
                            <label  for="image4">
                            <input type="hidden" name="edit_qrcode" id="" value="edit_qrcode">
                            <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->qrcode)}}"
                                    alt="" srcset="" width="120px" id="edit_qrcode">
                            <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                        @else
                        <div class="wrap-custom-file">
                            <input type="file" name="qrcode" id="image4" accept=".gif, .jpg, .png" />
                            <label  for="image4">
                            <span>Qrcode / Barcode</span>
                            <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                        @endif
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="file" name="school_background_image" id="background_image"
                                    class="form-control" autocomplete="off">
                                @if(isset($card_templateEdit))
                                <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_background_image)}}"
                                    alt="" srcset="" width="120px">
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default color is white"></b> <label
                                    for="">Logo</label>
                                <input type="file" name="school_logo" id="logo" class="form-control" autocomplete="off">
                                @if(isset($card_templateEdit))
                                <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_logo)}}"
                                    alt="" srcset="" width="120px">
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default color is white"></b> <label for="">Signature
                                </label>
                                <input type="file" name="school_signature" id="signature" class="form-control"
                                    autocomplete="off" @if(isset($card_templateEdit))
                                    @if(!$card_templateEdit->school_signature) required @endif @else required
                                @endif>
                                @if(isset($card_templateEdit))
                                <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_signature)}}"
                                    alt="" srcset="" width="120px">
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default color is white"></b> <label for="">QRCode
                                    / BarCode </label>
                                <input type="file" name="qrcode" id="qrcode" class="form-control" autocomplete="off">
                                @if(isset($card_templateEdit))
                                <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->qrcode)}}"
                                    alt="" srcset="" width="120px">
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default header fore color is black"></b> <label
                                    for=""> Header Fore Color </label>
                                <input type="color" name="school_header_color" id="header_color" class="form-control"
                                    @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_header_color}}"
                                    @else value="#000" @endif autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default header background color is white"></b>
                                <label for=""> Header Background Color </label>
                                <input type="color" name="school_header_bgcolor" id="school_header_bgcolor"
                                    class="form-control" @if(isset($card_templateEdit))
                                    value="{{$card_templateEdit->school_header_bgcolor}}" @else value="#ffffff" @endif
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default footer fore color is black "></b> <label
                                    for=""> Footer Fore Color </label>
                                <input type="color" name="school_footer_color" id="school_footer_color"
                                    class="form-control" @if(isset($card_templateEdit))
                                    value="{{$card_templateEdit->school_footer_color}}" @else value="#000" @endif
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                    data-placement="right" title=" default footer background color is white "></b>
                                <label for=""> Footer Background Color </label>
                                <input type="color" name="school_footer_bgcolor" id="school_footer_bgcolor"
                                    class="form-control" @if(isset($card_templateEdit))
                                    value="{{$card_templateEdit->school_footer_bgcolor}}" @else value="#ffffff" @endif
                                    autocomplete="off">
                            </div>
                        </div>

                        @include('admins.id_cards.adminbsb.features')


                        <div class="modal-footer">
                            @if(isset($card_templateEdit))
                            {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                            @else
                            <button type="submit" class="btn btn-round bg-teal">Save</button>
                            @endif
                        </div>

                        {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>
            <!-- </div> -->

            <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">
                <b for="">ID Card List</b>
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
                
                <table class="table table-striped table-bordered bulk_action " cellspacing="0" width="100%">
                    <thead>
                        <tr class="headings">

                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Card Title">Card
                                Title</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Preview Sample Card you make">Card Preview</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Created Date">
                                Created Date</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Make Operation ">
                                Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($card_template as $card)
                        <tr class="even pointer">
                            <td class="">@if($card->card_title == 'student_id_card') Student ID Card
                                @elseif($card->card_title == 'staff_id_card') Staff ID Card
                                @elseif($card->card_title == 'admit_card') Admit Card
                                @elseif($card->card_title == 'leaving_certificate') Leaving Certificate
                                @endif</td>
                            <td class="" data-toggle="modal" data-target="#return_book" data-card_id="{{$card->id}}"
                                data-student_name="{{$card->student_name}}">
                                preview</td>
                            <td class="">{!!date('d/m/Y', strtotime( $card->created_at)) !!}</td>
                            <td class="">
                                <a href="{!! route('student_idCard.edit', [$card->id]) !!}" class="fa fa-edit"></a>
                                <a href="{!! route('student_idCard.edit', [$card->id]) !!}" class="fa fa-times"></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="return_book" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><span class="fa fa-head"></span> </h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="" id="card_id">
                                        @include('admins.id_cards.table')
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>


@section('js')

<script>
$(document).ready(function() {
    var card_title = $('#card_title').val();
// alert(1)
    if (card_title == 'student_id_card') {
        $('#id_switcher_student').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_leaving_certificate').hide();
        $('#id_switcher_admit_card').hide();
        // alert(card_title)
    } else if (card_title == 'staff_id_card') {

        $('#id_switcher_staff').show();
        $('#id_switcher_student').hide();
        $('#id_switcher_admit_card').hide();
        $('#id_switcher_leaving_certificate').hide();

    } else if (card_title == 'admit_card') {

        $('#id_switcher_admit_card').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_student').hide();
        $('#id_switcher_leaving_certificate').hide();
    } else if (card_title == 'leaving_certificate') {

        $('#id_switcher_leaving_certificate').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_student').hide();
        $('#id_switcher_admit_card').hide();

    } else {
        $('#id_switcher_student').hide();
        $('#id_switcher_staff').hide();
        $('#id_switcher_admit_card').hide();
        $('#id_switcher_leaving_certificate').hide();
    }


    var sList = "";
$('input[type=checkbox]').each(function () {
    sList += "(" + $(this).val() + "-" + (this.checked ? "checked" : "not checked") + ")";
});
// alert(sList)

});



$('#card_title').on('change', function() {

    var card_title = $('#card_title').val();

    if (card_title == 'student_id_card') {
        $('#id_switcher_student').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_leaving_certificate').hide();
        $('#id_switcher_admit_card').hide();
        // alert(card_title)
    } else if (card_title == 'staff_id_card') {

        $('#id_switcher_staff').show();
        $('#id_switcher_student').hide();
        $('#id_switcher_admit_card').hide();
        $('#id_switcher_leaving_certificate').hide();

    } else if (card_title == 'admit_card') {

        $('#id_switcher_admit_card').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_student').hide();
        $('#id_switcher_leaving_certificate').hide();
    } else if (card_title == 'leaving_certificate') {

        $('#id_switcher_leaving_certificate').show();
        $('#id_switcher_staff').hide();
        $('#id_switcher_student').hide();
        $('#id_switcher_admit_card').hide();

    } else {

    }

})

function Printcontent(el) {
    // alert(1)
    var restorpage = document.body.innerHTML;
    var printContent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = restorpage;
    window.close();
}


$('#date').datetimepicker({
    format: 'Y-m-d',
    timepicker: false
});


// {{--------------------------Level Side-------------------------}} 
$('#return_book').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var level = button.data('level')
    var course_id = button.data('course_id')
    var level_description = button.data('level_description')
    var card_id = button.data('card_id')
    var student_name = button.data('student_name')

    // $('#email_user').val(email);

    var modal = $(this)

    modal.find('.modal-title').text('Send Email');
    modal.find('.modal-body #level').val(level);
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_description').val(level_description);
    modal.find('.modal-body #card_id').val(card_id);
    modal.find('.modal-body #student_name').val(student_name);

    $('#student_name_text').text(student_name)



});

// {{--------------------------Level view Side-------------------------}} 
$('#level-show').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var level = button.data('level')
    var course_id = button.data('course_id')
    var level_description = button.data('level_description')
    var created_at = button.data('created_at')
    var updated_at = button.data('updated_at')
    var level_id = button.data('level_id')

    var modal = $(this)

    modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
    modal.find('.modal-body #level').val(level);
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_description').val(level_description);
    modal.find('.modal-body #created_at').val(created_at);
    modal.find('.modal-body #updated_at').val(updated_at);
    modal.find('.modal-body #level_id').val(level_id);
});

/**
 * CUSTOM FILE INPUTS FOR IMAGES
 *
 * Version: 1.0.0
 *
 * Custom file inputs with image preview and 
 * image file name on selection.
 */

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




$('input[name="school_background_image"]').on('change', function(){

    var $file = $(this),
      $label = $file.next('label'),
      $labelText = $label.find('input[name="edit"]'),
      labelDefault = $labelText.text();
      var edit_school_background_image =  $('input[name="edit_school_background_image"]').val();
  
  // When a new file is selected
  $file.on('change', function(event){
    var fileName = $file.val().split( '\\' ).pop(),
        tmppath = URL.createObjectURL(event.target.files[0]);
    //Check successfully selection
    // alert(edit_school_logo)
		if( fileName ){
            $label
        .addClass('file-ok')
        .css('background-image', 'url(' + tmppath + ')');
			$labelText.text(fileName);

            if(edit_school_background_image == 'edit_school_background_image'){
            $('#edit_school_background_image').attr("src",  fileName );
        }
           
    }else{
      $label.removeClass('file-ok');
			$labelText.text(labelDefault);
    }
  });

})

$('input[name="school_signature"]').on('change', function(){

var $file = $(this),
  $label = $file.next('label'),
  $labelText = $label.find('input[name="edit"]'),
  labelDefault = $labelText.text();
  var edit_school_signature =  $('input[name="edit_school_signature"]').val();

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

         if(edit_school_signature == 'edit_school_signature'){
            $('#edit_school_signature').attr("src",  fileName );
        }
       
}else{
  $label.removeClass('file-ok');
        $labelText.text(labelDefault);
}
});

})

$('input[name="school_logo"]').on('change', function(){

var $file = $(this),
  $label = $file.next('label'),
  $labelText = $label.find('input[name="edit"]'),
  labelDefault = $labelText.text();

  var edit_school_logo =  $('input[name="edit_school_logo"]').val();

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

         if(edit_school_logo == 'edit_school_logo'){
            $('#edit_school_logo').attr("src",  fileName );
        }
       
}else{
  $label.removeClass('file-ok');
        $labelText.text(labelDefault);
}
});

})

$('input[name="qrcode"]').on('change', function(){

var $file = $(this),
  $label = $file.next('label'),
  $labelText = $label.find('input[name="edit"]'),
  labelDefault = $labelText.text();

  var edit_qrcode =  $('input[name="edit_qrcode"]').val();

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

         if(edit_qrcode == 'edit_qrcode'){
            $('#edit_qrcode').attr("src",  fileName );
        }
       
}else{
  $label.removeClass('file-ok');
        $labelText.text(labelDefault);
}
});

})
</script>

@endsection