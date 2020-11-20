@extends('layouts.new-layouts.app')


@section('content')
    <div class="content">
    @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
       
            <div class="clearfix"></div>

            <div class="page-title">
              <div class="title_left">
                @if(isset($add_book))
                <h2>Add card_templateEdit</h2>
                @elseif(isset($book_update))
                <h2>Update Book</h2>
                @else
                <h2>card_templateEdit List</h2>
                @endif
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" ="Search for...">
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
                    <ul class="nav navbar-right panel_toolbox">
                      @if(isset($card_templateEdit))
                      <a href="{{route('student_idCard.index')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-sign-out" aria-hidden="true"> Return </i></button></a>
                      @endif 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                @if(isset($add_member))
                  @if(isset($card_templateEdit))
                  {!! Form::model($card_templateEdit, ['route' => ['student_idCard.update', $card_templateEdit->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @else
                  {!! Form::open(['route' => 'student_idCard.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @endif

                  <div class="col-md-12">
                  <div class="col-md-4">

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($card_templateEdit)){{$card_templateEdit->school_id == $school->id ? 'selected' : ''}} @endif >
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
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default color is white"></b> <label for="">ID Card Title </label>
                   <select name="card_title" id="card_title"  class="form-control" @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_signature}}" @endif autocomplete="off" required>
                   <option value="">Select</option>
                   <option value="student_id_card" @if(isset($card_templateEdit)) @if($card_templateEdit->card_title === 'student_id_card') selected @endif  @endif >Student ID Card</option>
                   <option value="staff_id_card" @if(isset($card_templateEdit)) @if($card_templateEdit->card_title === 'staff_id_card') selected @endif  @endif >Staff ID Card</option>
                   <option value="admit_card" @if(isset($card_templateEdit)) @if($card_templateEdit->card_title === 'admit_card') selected @endif  @endif >Admit Card</option>
                   <option value="leaving_certificate" @if(isset($card_templateEdit)) @if($card_templateEdit->card_title === 'leaving_certificate') selected @endif  @endif >Leaving Certificate</option>
                   </select>
                    </div>
                    </div>
       
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default color is white"></b> <label for="">Background Image</label>
                        <input type="file" name="school_background_image" id="background_image" class="form-control"  autocomplete="off">
                        @if(isset($card_templateEdit)) 
                        <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_background_image)}}" alt="" srcset="" width="120px">
                        @endif 
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default color is white"></b> <label for="">Logo</label>
                        <input type="file" name="school_logo" id="logo" class="form-control"  autocomplete="off">
                        @if(isset($card_templateEdit)) 
                        <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_logo)}}" alt="" srcset="" width="120px">
                        @endif 
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default color is white"></b> <label for="">Signature </label>
                   <input type="file" name="school_signature" id="signature" class="form-control"  autocomplete="off" @if(isset($card_templateEdit)) @if(!$card_templateEdit->school_signature) required @endif @else required @endif>
                   @if(isset($card_templateEdit)) 
                   <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->school_signature)}}" alt="" srcset="" width="120px">
                   @endif 
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default color is white"></b> <label for="">QRCode / BarCode </label>
                   <input type="file" name="qrcode" id="qrcode" class="form-control"autocomplete="off">
                   @if(isset($card_templateEdit)) 
                   <img src="{{asset('certificate_template/school_images/' .$card_templateEdit->qrcode)}}" alt="" srcset="" width="120px">
                   @endif 
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default header fore color is black"></b> <label for="" > Header Fore Color </label>
                        <input type="color" name="school_header_color" id="header_color"  class="form-control"   @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_header_color}}" @else value="#000"  @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default header background color is white"></b> <label for="" > Header Background Color </label>
                        <input type="color" name="school_header_bgcolor" id="school_header_bgcolor"  class="form-control"   @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_header_bgcolor}}" @else value="#ffffff" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default footer fore color is black "></b> <label for="" > Footer Fore Color </label>
                        <input type="color" name="school_footer_color" id="school_footer_color" class="form-control"   @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_footer_color}}" @else  value="#000" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" default footer background color is white "></b> <label for="" > Footer Background Color </label>
                        <input type="color" name="school_footer_bgcolor" id="school_footer_bgcolor" class="form-control"   @if(isset($card_templateEdit)) value="{{$card_templateEdit->school_footer_bgcolor}}" @else  value="#ffffff" @endif autocomplete="off">
                    </div>
                    </div>

                    @include('admins.id_cards.features')
                    

                    <div class="modal-footer">
                    @if(isset($card_templateEdit))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}
                    @endif
                    
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    <b for="">ID Card List</b>
                    <table class="table table-striped table-bordered bulk_action " cellspacing="0" width="100%">
                        <thead>
                        <tr class="headings">
                           
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Card Title">Card Title</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Preview Sample Card you make">Card Preview</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Created Date">Created Date</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Make Operation ">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($card_template as $card)
                        <tr class="even pointer">
                            <td class="">@if($card->card_title == 'student_id_card') Student ID Card  @elseif($card->card_title == 'staff_id_card') Staff ID Card @elseif($card->card_title == 'admit_card') Admit Card @elseif($card->card_title == 'leaving_certificate') Leaving Certificate @endif</td>
                            <td class="" data-toggle="modal" data-target="#return_book" data-card_id="{{$card->id}}" data-student_name="{{$card->student_name}}">
                            preview</td>
                            <td class="">{!!date('d/m/Y', strtotime( $card->created_at)) !!}</td>
                            <td class="">
                            <a href="{!! route('student_idCard.edit', [$card->id]) !!}" class="fa fa-edit"></a>
                            <a href="{!! route('student_idCard.edit', [$card->id]) !!}" class="fa fa-times"></a>
                            </td>
                            </tr>
                            <div class="modal fade" id="return_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                                <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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



  @endsection
  
@section('scripts')

<script>
$(document).ready(function(){
  var card_title =  $('#card_title').val();

if(card_title == 'student_id_card'){
  $('#id_switcher_student').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_leaving_certificate').hide();
  $('#id_switcher_admit_card').hide();
  // alert(card_title)
}else if(card_title == 'staff_id_card'){

  $('#id_switcher_staff').show();
  $('#id_switcher_student').hide();
  $('#id_switcher_admit_card').hide();
  $('#id_switcher_leaving_certificate').hide();

}else if(card_title == 'admit_card'){

  $('#id_switcher_admit_card').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_student').hide();
  $('#id_switcher_leaving_certificate').hide();
}
else if(card_title == 'leaving_certificate'){

  $('#id_switcher_leaving_certificate').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_student').hide();
  $('#id_switcher_admit_card').hide();

}else{
    $('#id_switcher_student').hide();
    $('#id_switcher_staff').hide();
    $('#id_switcher_admit_card').hide();
    $('#id_switcher_leaving_certificate').hide();
  }
});

  

$('#card_title').on('change', function(){

  var card_title =  $('#card_title').val();

  if(card_title == 'student_id_card'){
    $('#id_switcher_student').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_leaving_certificate').hide();
    $('#id_switcher_admit_card').hide();
    // alert(card_title)
  }else if(card_title == 'staff_id_card'){

    $('#id_switcher_staff').show();
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();
    $('#id_switcher_leaving_certificate').hide();

  }else if(card_title == 'admit_card'){

    $('#id_switcher_admit_card').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_student').hide();
    $('#id_switcher_leaving_certificate').hide();
  }
  else if(card_title == 'leaving_certificate'){

    $('#id_switcher_leaving_certificate').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();

  }else{
  
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
    format: 'YYYY-MM-DD'
});


// {{--------------------------Level Side-------------------------}} 
$('#return_book').on('show.bs.modal', function(event){

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
$('#level-show').on('show.bs.modal', function(event){

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

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'on' : 'off';
        let levelId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('level/status/update') }}',
            data: {'status': status, 'level_id': levelId},
            success: function (data) {
                console.log(data.message);
                // success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
// }
            }
        });
    });
}) 

</script>

@endsection



