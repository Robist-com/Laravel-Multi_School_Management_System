
<style>
    .teacher-image{
        height:90px;
        padding-left:1px;
        padding-right: 1px;

        background: #eee;
        width:140px;
        margin: 0 auto;
        border-radius: 50%;
        vertical-align: middle;
       
    }
    .image{
        vertical-align: middle;
        width:40px;
        height: 20px;
        border-radius: 50%;
    }
    .image > input[type="file"]{
        display: none;
    }

    .btn-choose{
        padding: 5px;
        text-align: center;
        border:1px solid !important;
        color: black;
        border-radius: 50%;
    }

    .btn-choose:hover{
    background-color: #605ca8;
    transform: translateX(0);
    transition: all .3s ease;
    color:white;
}

    fieldset{
        margin-top: 5px;
    }
    fieldset legend{
        display: block;
        width:100%;
        padding: 0;
        font-size: 15px;
        border: 0;
        line-height: inherit;
        color: #797979;
        border-bottom: 1px solid #e5e5e5;
    }

    .info{
        float: right;
    }
    legend >b{
        color:red;
        font-size:13px
    }

</style>
{{-- the code start here --}}
  <div class="row">
        <div class="col-lg-12">
    
            <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
    <div class="modal fade left" id="admission-add-modal" tabindex="-1" role="dialog" 
    aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " style="width:90%"  role="document">
        <div class="modal-content">
          <div class="modal-header-store">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text"></i> 
                <i>Admission Form </i></h3>
          </div>
          {{-- modal body start here --}}
          <div class="modal-body">
        {{---------------------------}}
            <div class="panel-heading">
                <h3><i class="fa fa-user" style="font-weight:bold"></i> STUDENT INFORMATION</h3>
                <b class="pull-right"></b>
                </div>
                <hr class="line">
                <div class="panel">
                 <div class="panel-body">

                 {{---------------Roll Number / Username------------------}}
    
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Roll No <b> required</b></legend>
            <input type="text" class="form-control" readonly name="username" id="username" value="{{ $rand_username_password}}">
            <input type="hidden" name="password" id="password" value="{{ $rand_username_password}}">
            </fieldset>
            </div>
        </div>

        {{---------------Registration Date------------------}}
    
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Registration Date <b> required</b></legend>
            <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" required>
                    <input type="text" class="form-control" name="dateregistered" id="dateregistered" 
                    readonly value="{{date('Y-m-d')}}">
            </fieldset>
            </div>
        </div>
                
                {{-------------------------image-----------------}}
    
            <div class="col-lg-3 col-md-3 col-sm-3 pull-right">
            <div class="form-group pull-right">
            <table style="margin:0 auto; height:2%; width:4%">
            <fieldset>
            <legend for="gender">Image <b class="optional"> optional</b></legend>
            <thead>
                <tr class="info">
                </tr>
                </thead>
                <tbody>
                <tr>
            <td class="image">
        {{-- Html::image is the same as asset okay they all calling from public folder okay --}}
                {!!Html::image('teacher_images/profile.jpg', 
                null, ['class'=>'teacher-image', 'id'=>'showImage'])!!}
                <input type="file" name="image" id="image"
                accept="image/x-png,image/png,image/jpg,image/jpeg">
            </td>
        </tr>
        <tr>
            <td style="text-align:center;background:;">
            <input type="button" name="browse_file" id="browse_file" 
            class="form-control  text-capitalize btn-choose" 
            class="btn btn-outline-danger" value="Choose">
            </td>
            </tr>
        </tbody>
        </table>
        </fieldset>
    </div>
    </div>
    </div>
{{-- </div> --}}
        
        {{---------------First Name------------------}}
    
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">First Name <b> required</b></legend>
            <input type="text" name="first_name" id="first_name" class="form-control 
            text-capitalize"placeholder="Enter First Name Here">
            </fieldset>
            </div>
        </div>

        {{---------------Last Name------------------}}
    
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Last Name <b> required</b></legend>
            <input type="text" name="last_name" id="last_name" class="form-control  
            text-capitalize"placeholder="Enter Last Name Here">
            </fieldset>
            </div>
            </div>
            {{--------------Gender------------------}}
    
            <div class="col-md-2">
                            <div class="form-group">
                            <fieldset>
                            <legend style="text-align:center">Gender <b> required</b></legend>
                            <table style="width:100%;margin-top: -14px;">
                            <tr style="border-bottom: 0px solid #ccc;">
                            <td>
                                <label class="container1">Male
                                <input type="radio" name="gender" id="gender" value="0" required checked>
                                <span class="checkmark-redio"></span>
                                </label>
                            </td>
                            <td>
                            <label class="container1">Female
                                <input type="radio" name="gender" id="gender" value="1" required>
                                <span class="checkmark-redio"></span>
                                </label>
                            </td>
                            </tr>
                            </table>
                            </fieldset>
                            </div>
                        </div>
                        {{----------------------Status------------------}}
    
                        <div class="col-md-2">
                            <div class="form-group" style="padding-left:55px;">
                            <fieldset>
                            <legend style="text-align:center">Status <b> required</b></legend>
                            <table style="width:100%;margin-top: -14px;">
                            <tr style="border-bottom: 0px solid #ccc;">
                            <td>
                                <label class="container1">Single
                                <input type="radio" name="status" id="status" value="0" required checked>
                                <span class="checkmark-redio"></span>
                                </label>
                            </td>
                            <td>
                            <label class="container1">Married
                                <input type="radio" name="status" id="status" value="1" required>
                                <span class="checkmark-redio"></span>
                                </label>
                            </td>
                            </tr>
                            </table>
                            </fieldset>
                            </div>
                        </div>
                </div>
        <!-- Phone Ext -->
        <div class="panel-body" style="margin-bottom:4%">
            {{------------DOB-----------------}}
    
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Date of Birth <b> required</b></legend>
            <input type="text" name="dob" id="dob" class="form-control  text-capitalize"
            placeholder="YYY-MM-DD" autocomplete="off">
            </fieldset>
            </div>
            </div>

            {{--------------------Nationality-----------------}}
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Nationality <b> required</b></legend>
            <input type="text" name="nationality" id="nationality" class="form-control 
                         text-capitalize" placeholder="Enter Nationality ">
            </fieldset>
            </div>
            </div>

            {{--------------------Phone-----------------}}
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Phone <b> required</b></legend>
            <input type="text" name="phone" id="phone" class="form-control 
                         text-capitalize" placeholder="Enter Phone Number Here">
            </fieldset>
            </div>
            </div>

            {{--------------------Email-----------------}}
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Email <b> required</b></legend>
            <input type="text" name="email" id="email" class="form-control 
                         text-capitalize" placeholder="Enter Email " >
            </fieldset>
            </div>
            </div>

                      {{--------------------Passport-----------------}}
                      <div class="col-md-3">
                        <div class="form-group">
                        <fieldset>
                        <legend for="gender">Passport <b> required</b></legend>
                        <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                                     placeholder="Enter Passport Number">
                        </fieldset>
                        </div>
                        </div>
                    
                    {{--------------------Pamanet Address-----------------}}
                    <div class="col-md-4">
                    <div class="form-group">
                    <fieldset>
                    <legend for="gender">Pamanet Address <b> required</b></legend>
                    <textarea placeholder="Enter Address " name="address" id="address"
                    cols="40" rows="1" class="form-control  text-capitalize"></textarea>
                    </fieldset>
                    </div>
                    </div>
        
                    
                    {{--------------------Current Address-----------------}}
                    <div class="col-md-5">
                    <div class="form-group">
                    <fieldset>
                    <legend for="gender">Current Address <b> required</b></legend>
                    <textarea placeholder="Enter Current Address " name="current_address" id="current_address"
                    cols="40" rows="1" class="form-control  text-capitalize"></textarea>
                    </fieldset>
                    </div>
                    </div>
                    <!-- </div> -->
                    </div>
        

            <div class="panel-heading">
                <b><i class="fa fa-book"></i>  Academic Infomation</b>
                <b class="pull-right"></b>
                </div>   
                <hr class="line"> 
                <div class="panel-body">
            {{--------------------Grade-----------------}}
            <div class="col-md-3">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Grade <b> required</b></legend>
            <div class="selectWarapper">
            <select name="semester_id" id="semester_id" class="form-control select_2_single" >
                <option value="0" selected="true" disabled="true">Choose Grade</option>
                 @foreach($Semester as $Semes)
                <option value="{{$Semes->id}}">{{$Semes->semester_name}} </option>
                @endforeach
            </select>
            </div>
            </fieldset>
            </div>
            </div>

              {{--------------------Degree-----------------}}
              <div class="col-md-3">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Level <b> required</b></legend>
                <div class="selectWarapper">
                <select name="degree_id" id="degree_id" class="form-control select_2_single" >
                <option value="0" selected="true" disabled="true">Choose Level</option>
               
                </select>
                </div>
                </fieldset>
                </div>
                </div>

                {{--------------------Faculty-----------------}}
                <div class="col-md-3">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Student Group <b> required</b></legend>
                <div class="selectWarapper">
                <select name="faculty_id" id="faculty_id" class="form-control select_2_single" >
                <option value="0" selected="true" disabled="true">Choose Student Group</option>
                @foreach($faculties as $faculty)
                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}} </option>
                @endforeach
                </select>
                </div>
                </fieldset>
                </div>
                </div>

                {{--------------------Department-----------------}}
                <div class="col-md-3">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Class Group <b> required</b></legend>
                <div class="selectWarapper">
                <select name="department_id" id="department_id" class="form-control select_2_single" >
                <option value="0" selected="true" disabled="true1">Choose Class Group</option>

                </select>
                </div>
                </fieldset>
                </div>
                </div>

            {{--------------------Batch-----------------}}
            <div class="col-md-3">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Class <b> required</b></legend>
                <div class="selectWarapper">
                <select name="class_id" id="class_id" class="form-control select_2_single" >
                <option value="" selected="true" disabled="true">Choose Class</option>
                {{-- @foreach($classes as $class)
                <option value="{{$class->class_code}} " >{{$class->class_name}} </option>
                @endforeach --}}
                </select>
                </div>
                </fieldset>
                </div>
                </div>
            {{-- </div> --}}

             {{--------------------Batch-----------------}}
             <div class="col-md-3">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Batch <b> required</b></legend>
                <div class="selectWarapper">
                <select name="batch_id" id="batch_id" class="form-control select_2_single" >
                <option value="0" selected="true" disabled="true">Choose Batch</option>
                @foreach($batches as $batch)
                @if($batch->is_current_batch == 1)
                <option value="{{$batch->id}}">{{$batch->batch}} </option>
                @endif
                @endforeach
                </select>
                </div>
                </fieldset>
                </div>
                </div>
            </div>

            <div class="panel-heading" style="margin-top: -20px;">
            <b><i class="fa fa-map-marker"></i> Guadians Details</b>
            </div>
            <hr class="line">
            <div class="panel-body">

            {{---------------Father Name------------------}}

            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Father Name <b> required</b></legend>
            <input type="text" name="father_name" id="father_name" class="form-control 
            text-capitalize" placeholder="Enter Father Name" >
            </fieldset>
            </div>
            </div>

            {{---------------Father Phone Number------------------}}

            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Father Phone Number <b> required</b></legend>
            <input type="text" name="father_phone" id="father_phone" class="form-control 
            text-capitalize" placeholder="+220 000 000 000">
            </fieldset>
            </div>
            </div>

            {{--------------- Mother Name------------------}}

            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender"> Mother Name <b> required</b></legend>
            <input type="text" name="mother_name" id="mother_name" class="form-control 
            text-capitalize" placeholder="Enter Mother Name" >
            </fieldset>
            </div>
            </div>
            </div>
        </div>   <!-- modal-body end here -->  

                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     {!! Form::submit('Register Student', ['class' => 'btn btn-success']) !!}
          </div><!-- moda-footer end here -->

        </div>
      </div>
      </div>
      </div>
</div>
<!-- </div>
</div>
</div> -->

{{-- end of the modal okay --}}

{{-- let me show one again you can stop the video and write the code okay --}}

@section('scripts')

        <script type="text/javascript">
        
        //------------------Date Of Birth Change-----------
                    $('#dob').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
        //---------------------Browse image----------------
                        $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })

// GET SEMESTER DEGREEE
// $('#semester_id').on('change',function(e){

// var degree_id = $(this).val();
// var degree = $('#degree_id')
//     $(degree).empty();
// $.get("{{ route('dynamicDegrees') }}",{degree_id:degree_id},function(data){  
    
//     console.log(data);
//     $.each(data,function(i,l){
//     $(degree).append($('<option/>',{
//         value : l.id,
//         text  : l.level
// }))
// }) 
// })
// });

    // GET SEMESTER DEGREEE
    $('#semester_id').on('change',function(e){
        var grade_id = $(this).val();
        var degree = $('#degree_id')
            $(degree).empty();
        $.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(degree).append($('<option/>',{
                value : l.id,
                text  : l.level
            }))
        }) 
    })
});



// GET SEMESTER DEGREEE
$('#faculty_id').on('change',function(e){

    var faculty_id = $(this).val();
    var department_id = $('#department_id')
        $(department_id).empty();
    $.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){  
        
    console.log(data);
    $.each(data,function(i,l){
    $(department_id).append($('<option/>',{
    value : l.department_id,
    text  : l.department_name
}))
}) 
})
});

$('#department_id').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#class_id')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name
}))
}) 
})
});

                        
// jQuery(function($){
// $(document).ajaxSend(function() {
//     $("#overlay").fadeIn(300);　
// });
    
// $('#button').click(function(){
//     alert(1)
//     $.ajax({
//         type: 'GET',
//         success: function(data){
//             console.log(data);
//         }
//     }).done(function() {
//         setTimeout(function(){
//             $("#overlay").fadeOut(300);
//         },500);
//     });
// });	
// });



// function loadAjax() {
//   $.ajax({
//     url: 'https://reqres.in/api/?delay=2',
//     beforeSend: function () {
//       $('#status').attr('disabled', true);
//       $('#ajax-container').html('');
//       addSpinner($('#ajax-container'));
//     },
//     complete: function (response) {
//       $('#status').attr('disabled', false);
//       removeSpinner($('#ajax-container'), function () {
//         $('#ajax-container').html('Content loaded.');
//       });
//     }
//   });
// }

                        // $('#dob').datepicker({
                        //         changeMonth:true,
                        //         changeYear:true,
                        //         dateFormat:'yy-mm-dd'
                        // });
                        //---------------------------------------
                        function showFile(fileInput,img,showName){
                            if (fileInput.files[0]){
                                var reader = new FileReader();
                                reader.onload = function(e){
                                    $(img).attr('src', e.target.result);
                                }
                                reader.readAsDataURL(fileInput.files[0]);
                            }
                            $(showName).text(fileInput.files[0].name)
                        };
                        //------------------------------------------------------
                        // {{----------------------------Update class Schedule Status---------------------}}  

$(document).ready(function(){

        // function Status(){
            $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let studentId = $(this).data('id');
            // alert(studentId)
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ url('student/status/update') }}',
                data: {'status': status, 'student_id': studentId},
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
// }
})
</script>
@endsection