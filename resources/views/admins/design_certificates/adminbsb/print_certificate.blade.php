
<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>GENERATE SCHOOL CERTIFICATES</h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('expenses.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <h2>Generate School Certificates</h2>

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
                    <form action="{{route('design_certificates.print')}}" method="post" target="_blank">
                        @csrf
                        <div class="row">
                        <div class=" form-group">
                        <div class="col-md-6">
                        <label for="">Select Certificate Type <b style="color:red"> *</b></label>
                            <select name="card_title" id="type" class="form-control bootstrap-select">
                                <option value="">select</option>
                                @foreach($card_template as $card)
                                <option value="{{$card->certificate_to}}" @if($card->certificate_to === request('card_title'))selected @endif> {{$card->certificate_to}} </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- </div> -->
                        <div class=" form-group" id="certificate">
                        <div class="col-md-6">
                        <label for="">Select Group<b style="color:red" > *</b></label>
                            <select name="card_title" id="card_title" class="form-control bootstrap-select">
                                <option value="">select</option>
                                @foreach($card_template as $card)
                                <option value="{{$card->certificate_to}}" @if($card->certificate_to === request('card_title'))selected @endif> {{$card->certificate_to}} </option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                       <div class="" id="id_switcher_student">
                        <div class=" form-group" id="class_hide">
                        <div class="col-md-6">
                        <label for="">Select Class</label>
                            <select name="class_code" id="class_code" class="form-control bootstrap-select">
                                <option value="">select</option>
                                @foreach($classes as $class)
                                <option value="{{$class->class_code}}" @if($class->class_code === request('class_code'))selected @endif>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        
                        <div class=" form-group">
                        <div class="col-md-6">
                            <label for="">Select Student</label>
                            <select name="student_id" id="student_id" class="form-control bootstrap-select">
                                <option value="">select</option>
                                @foreach($students as $student)
                                <option value="{{$student->id}}" style="text-transform:capitalize">{{$student->first_name . ' ' . $student->first_name }} -- (Roll No : {{$student->username }})</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        </div>
                        <div class="" id="id_switcher_staff">
                        <div class=" form-group">
                            <label for="">Select Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="form-control bootstrap-select">
                                <option value="">select</option>
                                @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" style="text-transform:capitalize">{{$teacher->first_name . ' ' . $teacher->first_name }} -- (Roll No : {{$teacher->roll_no }})</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="pull-right">
                            <button type="submit" id="btn-generate"  class="btn bg-teal btn-round">Generate</button>
                            </div>
                        </form>
                        </div>
                        </div>
                        @if(isset($institute))
                        @include('admins.id_cards.print')
                        @endif
                        </div>
                        </div>
                        </div>


  
@section('js')

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
