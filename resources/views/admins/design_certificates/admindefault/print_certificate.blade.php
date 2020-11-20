
@extends('layouts.new-layouts.app')

@section('content')
<div class="page-title">
              <div class="title_left">
                  <h2>Generate School Certificates</h2>
              </div>
    <div class="col-md-12">
    <div class="x_panel">
                  <!-- <div class="x_title"> -->
                    <form action="{{route('design_certificates.print')}}" method="post" target="_blank">
                        @csrf
                        <div class=" form-group col-md-6">
                        <label for="">Select Certificate Type <b style="color:red"> *</b></label>
                            <select name="card_title" id="type" class="form-control">
                                <option value="">select</option>
                              
                                @foreach($card_template as $card)
                                <option value="{{$card->certificate_to}}" @if($card->certificate_to === request('card_title'))selected @endif> {{$card->certificate_to}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" form-group col-md-6" id="certificate">
                        <label for="">Select Group<b style="color:red" > *</b></label>
                            <select name="card_title" id="card_title" class="form-control">
                                <option value="">select</option>
                              
                                @foreach($card_template as $card)
                                <option value="{{$card->certificate_to}}" @if($card->certificate_to === request('card_title'))selected @endif> {{$card->certificate_to}} </option>
                                @endforeach
                            </select>
                        </div>
                       <div class="" id="id_switcher_student">
                        <div class=" form-group col-md-6" id="class_hide">
                        <label for="">Select Class</label>
                            <select name="class_code" id="class_code" class="form-control">
                                <option value="">select</option>
                                @foreach($classes as $class)
                                <option value="{{$class->class_code}}" @if($class->class_code === request('class_code'))selected @endif>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class=" form-group col-md-6">
                            <label for="">Select Student</label>
                            <select name="student_id" id="student_id" class="form-control">
                                <option value="">select</option>
                                @foreach($students as $student)
                                <option value="{{$student->id}}" style="text-transform:capitalize">{{$student->first_name . ' ' . $student->first_name }} -- (Roll No : {{$student->username }})</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="" id="id_switcher_staff">
                        <div class=" form-group col-md-6">
                            <label for="">Select Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <option value="">select</option>
                                @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" style="text-transform:capitalize">{{$teacher->first_name . ' ' . $teacher->first_name }} -- (Roll No : {{$teacher->roll_no }})</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="pull-right">
                            <button type="submit" id="btn-generate"  class="btn btn-dark btn-round">Generate</button>
                            </div>
                           
                       
                        </form>
                        </div>
                        @if(isset($institute))
                        @include('admins.id_cards.print')
                        @endif
                        </div>
                        </div>
                        </div>
                        
@endsection

  
@section('scripts')

<script>
$(document).ready(function(){

    
  var card_title =  $('#card_title').val();
  $('#certificate').hide();

  $('#btn-generate').hide();
if(card_title == 'student'){
  $('#id_switcher_student').show();
  $('#btn-generate').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_leaving_certificate').hide();
  $('#id_switcher_admit_card').hide();
  // alert(card_title)
}else if(card_title == 'staff'){

  $('#id_switcher_staff').show();
  $('#btn-generate').show();
  $('#id_switcher_student').hide();
  $('#id_switcher_admit_card').hide();
  $('#id_switcher_leaving_certificate').hide();

}else if(card_title == 'others'){

  $('#id_switcher_admit_card').show();
  $('#btn-generate').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_student').hide();
  $('#id_switcher_leaving_certificate').hide();
}
else if(card_title == '4'){

  $('#id_switcher_leaving_certificate').show();
  $('#btn-generate').show();
  $('#id_switcher_staff').hide();
  $('#id_switcher_student').hide();
  $('#id_switcher_admit_card').hide();

}else{
    $('#id_switcher_student').hide();
    $('#id_switcher_staff').hide();
    $('#id_switcher_admit_card').hide();
    $('#id_switcher_leaving_certificate').hide();
    $('#btn-generate').hide();
  }
});

$('#btn-generate').on('click', function(){
    var card_title =  $('#card_title').val();
    var class_name =  $('#class_code').val();
    var student_id =  $('#student_id').val();
    var student_id =  $('#student_id').val();

    if (card_title == '') {
        alert('Please select card type to procced!');
        return false;
    }

    // if (class_name == '' && student_id == '') {

    //     alert('Please select either student or class to procced!');
    //     return false;
    // }elseif(class_name != '' && student_id == '') {

    //     alert('Please select either student or class to procced!');
    //     return false;
});

$('#type').on('change', function(){
      // $('#certificate').val('');
      // $('#teacher_id').val('');
      $('#certificate').show();
  });


  $('#class_code').on('change', function(){
      $('#student_id').val('');
      $('#teacher_id').val('');
      $('#btn-generate').show();
  });

  $('#student_id').on('change', function(){
    $('#class_code').val('');
    $('#teacher_id').val('');
    $('#btn-generate').show();
  });

  $('#teacher_id').on('change', function(){
    $('#class_code').val('');
    $('#student_id').val('');
    $('#btn-generate').show();
  });



$('#card_title').on('change', function(){

  var card_title =  $('#card_title').val();

  if(card_title == 'student'){
    $('#id_switcher_student').show();
    $('#btn-generate').hide();
    $('#class_hide').show();
    $('#class_code').val('');
    $('#teacher_id').val('');
    $('#student_id').val('');
    $('#id_switcher_staff').hide();
    $('#id_switcher_leaving_certificate').hide();
    $('#id_switcher_admit_card').hide();
    // alert(card_title)
  }else if(card_title == 'staff'){

    $('#id_switcher_staff').show();
    $('#btn-generate').hide();
    $('#class_code').val('');
    $('#student_id').val('');
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();
    $('#id_switcher_leaving_certificate').hide();

  }else if(card_title == 'others'){

    $('#id_switcher_student').show();
    $('#btn-generate').hide();
    $('#id_switcher_staff').hide();
    $('#class_hide').hide();
    $('#class_code').val('');
    $('#teacher_id').val('');
    $('#student_id').val('');
    $('#id_switcher_leaving_certificate').hide();
  }
  else if(card_title == 'leaving_certificate'){

    $('#id_switcher_student').show();
    $('#btn-generate').hide();
    $('#class_hide').show();
    $('#class_code').val('');
    $('#teacher_id').val('');
    $('#student_id').val('');
    $('#id_switcher_staff').hide();
    $('#id_switcher_leaving_certificate').hide();
    $('#id_switcher_admit_card').hide();

  }else{
    $('#id_switcher_leaving_certificate').hide();
    $('#btn-generate').hide();
    $('#id_switcher_staff').hide();
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();

  }
  
})


</script>

@endsection
