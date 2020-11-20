
<style>
    .teacher-image{
        height:160px;
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
        width:50px;
        height: 50px;
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

</style>
{{-- the code start here --}}
  <div class="row">
        <div class="col-lg-12">

            <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
    <div class="modal fade left" id="teacher-add-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " style="width:90%"  role="document">
        <div class="modal-content">
          <div class="modal-header-store">
          <button type="button" class="close " style="color:white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text"></i>
                <i>Teacher Form </i></h3>
          </div>
          {{-- modal body start here --}}
          <div class="modal-body">
        {{---------------------------}}

      
                <div class="panel-heading">
                <b><i class="fa fa-book"></i> Teacher Details</b>
                <b class="pull-right"></b>
                </div>
                <div class="panel-body" styte="padding-bottom:4px;">
<hr class="line">
                <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" required>
                    <input type="hidden" name="dateregistered" id="dateregistered"
                    value="{{date('Y-m-d')}}">
                    <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9">



                            <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="roll_no" id="roll_no" class="form-control"
                                value="{{$rand_username_password}}" readonly>
                            </div>
                            </div>
                            {{-- <div> --}}
                                <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="dateregistered" id="dateregistered" class="form-control"
                                    value="{{date('Y-m-d')}}" readonly>
                                </div>
                                </div>

                                <br><br><br>
                    {{---------------First Name------------------}}

                    <div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" name="first_name" id="first_name" class="form-control
                     text-capitalize"placeholder="Enter First Name Here">
                    </div>
                    </div>

                    {{---------------Last Name------------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="last_name" id="last_name" class="form-control
                        text-capitalize"placeholder="Enter Last Name Here">
                        </div>
                        </div>

                    {{--------------Gender------------------}}

                        <div class="col-md-4">
                            <div class="form-group">
                            <fieldset>
                            <legend for="gender">Gender</legend>
                            <table style="width:100%;margin-top: 14px;">
                            <tr style="border-bottom: 1px solid #ccc;">
                            <td>
                            <label>
                                <input type="radio" name="gender" id="gender" value="0" checked >
                                Male
                            </label>
                            </td>
                            <td>
                            <label>
                                <input type="radio" name="gender" id="gender" value="1" >
                                Female
                            </label>
                            </td>
                            </tr>
                            </table>
                            </fieldset>
                            </div>
                        </div>
                        </div>

                        {{------------DOB-----------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar teacherdob"></i>
                        </div>
                        <input type="text" name="dob" id="dob" class="form-control  text-capitalize"
                         placeholder="YYY-MM-DD" >
                        </div>
                        </div>
                        </div>

                        {{--------------------Passport-----------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                         placeholder="Enter Passport Number Here">
                        </div>
                        </div>

                    {{----------------------Status------------------}}

                        <div class="col-md-4">
                            <div class="form-group">
                            <fieldset>
                            <legend>Marital Status</legend>
                            <table style="width:100%;margin-top: -14px;">
                            <tr style="border-bottom: 1px solid #ccc;">
                            <td>
                            <label>
                                <input type="radio" name="marital_status" id="marital_status" value="0" required checked>
                                {{-- this willbe the default checked radio button okay --}}
                                Single
                            </label>
                            </td>
                            <td>
                            <label>
                                <input type="radio" name="marital_status" id="marital_status" value="1" required>
                                Married
                            </label>
                            </td>
                            </tr>
                            </table>
                            </fieldset>
                            </div>
                        </div>

                    {{--------------------------Nationality-----------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="nationality" id="nationality" class="form-control
                         text-capitalize" placeholder="Enter Nationality Here">
                        </div>
                        </div>

                    {{-------------------------Phone-----------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="phone" id="phone" class="form-control
                         text-capitalize" placeholder="Enter Phone Number Here">
                         <input type="hidden" name="status" id="status" class="form-control
                         text-capitalize" value="0">
                        </div>
                        </div>

                    {{------------------------Email-----------------}}

                        <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control
                         text-capitalize" placeholder="Enter Email Address Here" >
                        </div>
                        </div>

                    {{------------------------Email-----------------}}

                    <div class="col-md-4">
                       <div class="form-group">
                       <select name="faculty_id" id="faculty_id" class="form-control select_2_single">
                       <option value="" selected disabled>Select Student Group</option>
                       @foreach ($faculties as $faculty)
                       <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                       @endforeach
                       </select>
                         </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                        <select name="department_id" id="department_id" class="form-control select_2_single">
                        <option value="" selected disabled>Select Class Group</option>
                        </select>
                          </div>
                       </div>

                {{-- this field will be a hidden field okay so that our image can be fine --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="" id="" style="display:none"></select>
                            </div>
                        </div>
                    </div>
                {{-- ends here okay --}}
                        {{-- WE WILL ADD ANOTHER DIV FOR OUR SEMESTER FIELD
                            OKAY BUT I WILL NOT USE THAT FIELD HENCE WE ARE
                            HAVING THAT INSIDE OUR CLASS ASSIGNING SO WE WILL
                            REMOVE IT FROM HERE OKAY. --}}


                    {{-------------------------image-----------------}}

                        <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group form-group-login">
                        <table style="margin:0 auto;">
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
                                <td style="text-align:center;">
                                <input type="button" name="browse_file" id="browse_file"
                                class=" btn  text-capitalize btn-choose" value="Choose">
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        {{-- <br> --}}

                    {{-------------------------Address-----------------}}

                            <div class="panel-heading" style="margin-top: -20px;">
                            <b><i class="fa fa-map-marker"></i> Address</b>
                            </div>
                            <div class="panle-body" styte="padding-bottom:10px;margin-top: 0;">
                            <hr class="line">
                    {{---------------------Address------------------------------}}
                            <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                            <textarea placeholder="Enter Address Here" name="address" id="address"
                             cols="40" rows="2" class="form-control  text-capitalize"></textarea>
                            </div>
                            </div>
                            </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     {!! Form::submit('Register Teacher', ['class' => 'btn btn-success']) !!}
          </div>
        </div>
      </div>
      </div>
</div>
</div>
</div>
</div>

{{-- end of the modal okay --}}

{{-- let me show one again you can stop the video and write the code okay --}}

@section('scripts')

        <script type="text/javascript">


        
// $(document).ready(function () {
    
//         $('#master').on('click', function(e) {
//         var rowCount = '<label class="btn btn-primary " >Total Row Selected is : ' +$('#teachers-table tbody tr').length + ' </label>';
//          if($(this).is(':checked',true))  
//          {
//             $(".sub_chk").prop('checked', true); 

//             $("table").has(".contact").css('background-color','Plum');
//             $("table").has(".contact").css('color','White');
//             $('.delete-modal').hide();

//             $("#divoutput").html(rowCount);
            

//          } else {  
//             $(".sub_chk").prop('checked',false);  
//             $("table").has(".contact").css('background-color','');
//             $("table").has(".contact").css('color','');
//             $('.delete-modal').show();
//             $("#divoutput").html('');
//          }  
//         });


//         $('.delete_all').on('click', function(e) {

//             var allVals = [];  
//             $(".sub_chk:checked").each(function() {  
//                 allVals.push($(this).attr('data-id'));
//             });  


//             if(allVals.length <=0)  
//             {  
//                 alert("Please select row.");  
//             }  else {  


//                 var check = confirm("Are you sure you want to delete this rows?");  
//                 if(check == true){  


//                     var join_selected_values = allVals.join(","); 


//                     $.ajax({
//                         url: $(this).data('url'),
//                         type: 'DELETE',
//                         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                         data: 'promote_ids='+join_selected_values,
//                         success: function (data) {
//                             if (data.success) {

//                             $(".sub_chk:checked").each(function() {  
//                                 $(this).parents("tr").remove();
//                             });
//                                 toastr.options.closeButton = true;
//                                 toastr.options.closeMethod = 'fadeOut';
//                                 toastr.options.closeDuration = 100;
//                                 toastr.options.positionClass = 'toast-top-full-width';
//                                 toastr.success(data.success);

//                                 $("#divoutput").html('');
//                                 $("#master").prop('checked',false);

//                             } else if (data.error) {
//                                 toastr.options.closeButton = true;
//                                 toastr.options.closeMethod = 'fadeOut';
//                                 toastr.options.closeDuration = 100;
//                                 toastr.options.positionClass = 'toast-top-full-width';
//                                 toastr.error(data.error);
//                             } else {
//                                 alert('Whoops Something went wrong!!');
//                             }
//                         },
//                         error: function (data) {
//                             alert(data.responseText);
//                         }
//                     });


//                   $.each(allVals, function( index, value ) {
//                       $('table tr').filter("[data-row-id='" + value + "']").remove();
//                   });
//                 }  
//             }  
//         });


//         $('[data-toggle=confirmation]').confirmation({
//             rootSelector: '[data-toggle=confirmation]',
//             onConfirm: function (event, element) {
//                 element.trigger('confirm');
//             }
//         });

//     });

$(document).ready(function () {

  var $checkboxes = $('#teachers-table td input[type="checkbox"]');
  var checked = false;
  $("input[type='checkbox']").change(function(e) {
 
    if($(this).prop("checked")){ 
      $(this).parent().parent().css('background-color','plum');
      $(this).parent().parent().css('color','white');
 
    var countCheckedCheckboxes = '<label class="btn btn-primary" >Total Row Selected is : '+$checkboxes.filter(':checked').length + ' </label>';
    $('#divoutput').html(countCheckedCheckboxes);

    if($checkboxes.change(function(){
      var countCheckedCheckboxes = '<label class="btn btn-primary" >Total Row Selected is : '+$checkboxes.filter(':checked').length + ' </label>';
      $('#divoutput').html(countCheckedCheckboxes);
    }));
   
    }else{
      $(this).parent().parent().css('background-color','');
      $(this).parent().parent().css('color','');

        $("#divoutput").html('');
    // }
    }
  });


  // Disabled button when table is empty
$(function(){
    var rowCount = $('#teachers-table tbody tr').length;
    // alert(rowCount)
    if(rowCount < 1){
        $('.delete_all').hide();
        $('#master').hide();
        $('#table-hide').hide();
        $('.card-header').hide();
        $('#search').hide();
        $('#numberOfRows').focus();
        $('#editAll').hide();

    } 
    else{
        $('.delete_all').show();
        $('#master').show();
        $('#table-hide').show();
        $('.card-header').show();
        $('#search').show();
        $('#editAll').show();


    }
});

$("#roll_no").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#teachers-table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

})

// Function for Search data 
$(document).ready(function(){
  $("#student_id_single").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#teachers-table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});







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

                        $('#dob').datetimepicker({
                                changeMonth:true,
                                changeYear:true,
                                dateFormat:'yy-mm-dd'
                        });
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

 $(document).ready(function(){

// function Status(){
    $('.js-switch').change(function () {
    let status = $(this).prop('checked') === true ? 1 : 0;
    let teacherId = $(this).data('id');
    // alert(studentId)
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ url('teacher/status/update') }}',
        data: {'status': status, 'teacher_id': teacherId},
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

// GET SEMESTER DEGREEE
$('#faculty_id').on('change',function(e){
        //   getStudentsByclass()
        var faculty_id = $(this).val();
        var department_id = $('#department_id')
            $(department_id).empty();
        $.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){

            console.log(data);
            $.each(data,function(i,l){
            $(department_id).append($('<option/>',{
                value : l.department_id,
                text  : l.department_name
            }));
        $('#department_id').show();

        })
    })
});
})






</script>
@endsection
