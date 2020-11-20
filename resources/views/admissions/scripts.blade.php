<script type="text/javascript">
     function deletePost(id)

     {
         const swalWithBootstrapButtons = swal.mixin({
             confirmButtonClass: 'btn btn-success',
             cancelButtonClass: 'btn btn-danger',
             buttonsStyling: false,
         })

         swalWithBootstrapButtons({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             type: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'No, cancel!',
             reverseButtons: true
         }).then((result) => {
             if (result.value) {
                 event.preventDefault();
                 document.getElementById('delete-form-'+id).submit();
             } else if (
                 // Read more about handling dismissals
                 result.dismiss === swal.DismissReason.cancel
             ) {
                 swalWithBootstrapButtons(
                     'Cancelled',
                     'Your file is safe :)',
                     'error'
                 )
             }
         })
     }

$(document).ready(function(){
$("#gender_radio a, #like_radio a").on('click', function(){
var selected = $(this).data('title');
var toggle = $(this).data('toggle');
$('#'+toggle).prop('value', selected);
$('a[data-toggle="'+toggle+'"]').not('[data-title="'+selected+'"]').removeClass('active').addClass('noActive');
$('a[data-toggle="'+toggle+'"][data-title="'+selected+'"]').removeClass('noActive').addClass('active');
})
});

$(document).ready(function(){
$("#gender_radio_status a, #like_radio a").on('click', function(){
var selected = $(this).data('title');
var toggle = $(this).data('toggle');
$('#'+toggle).prop('value', selected);
$('a[data-toggle="'+toggle+'"]').not('[data-title="'+selected+'"]').removeClass('active').addClass('noActiveStatus');
$('a[data-toggle="'+toggle+'"][data-title="'+selected+'"]').removeClass('noActiveStatus').addClass('active');
})
});
 </script>

 <script>

    $(document).ready(function(){
          $("#current_password").keyup(function(){
            // we are using the keyup function to check our data if it's valid or not okay.
            var current_password = $("#current_password").val();
          
            // if(new_password == confirm_password){

            // }else{
            //     alert('not match')
            // }
            $.ajax({
              type: 'get',
              url: '/varify-password',
              data: {current_password:current_password},
              success: function(response){
                // here we will write condition oaky.
                if(response == "false"){
                  $("#messageError").html("<font color='red'> <b>Password Incorrect</b> </font>");
                }else if(response == "true"){
                  $("#messageError").html("<font color='green'><b>Correct Password</b></font>");
                }
              }
            });

          });
          $("#confirm_password").keyup(function(){
          var new_password = $("#new_password").val();
          var confirm_password = $("#confirm_password").val();

          if(new_password == confirm_password){
                $("#messageErrorPassword").html("<font color='green'> <b>Password Match</b> </font>");
                    $("#changePass").show();
            }else {
                  $("#messageErrorPassword").html("<font color='red'><b>Password not Match</b></font>");
                  $("#changePass").hide();
            }
        });
        $("#changePass").hide();
    });


$('#previewDocument').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var document_id = button.data('document_id')

var modal = $(this)

modal.find('.modal-title').text('DELETE STUDENT INFORMATION');
modal.find('.modal-body #document_id').val(document_id);
});
 </script>


<script>
  $(document).ready( function () {
  $('#example').DataTable();
//   alert(1)
 });
           //---------------------Browse image----------------
           $('#browse_file').on('click',function(){
                            $('#file-input').click();                 
                        })
                        $('#file-input').on('change', function(e){
                            showFile(this, '#showImage');
                        })
                        $('#file-input').on('change', function(e){
                            showFile(this, '#showImage1');
                        })

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
                        $('#dob').datetimepicker({
                        useCurrent: false,
                        format: 'YYYY-MM-DD',
							// weekStart : 1,
							// maxViewMode : 1,
							// language : "it"
                        // startDate: '-3d'
                    });

                    $('#start_date').datetimepicker({
                        useCurrent: false,
                        format: 'YYYY-MM-DD',
							// weekStart : 1,
							// maxViewMode : 1,
							// language : "it"
                        // startDate: '-3d'
                    });

                    $('#end_date').datetimepicker({
                        useCurrent: false,
                        format: 'YYYY-MM-DD',
							// weekStart : 1,
							// maxViewMode : 1,
							// language : "it"
                        // startDate: '-3d'
                    });

                    $('#jdate').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                    $('#startDate').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                    $('#endDate').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                    $('#date').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                    $('#overtime_date').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                    $('#bonus_date').datetimepicker({
                        useCurrent: true,
                        format: 'YYYY-MM-DD',
                        // startDate: '-3d'
                    });

                 
                 $('#rates').keyup(function(){
                     var days_worked = $('#days').val();
                     var rate_per_day = $(this).val();
                     var total_gross_salary = days_worked * rate_per_day;
                     $('#salary').val(total_gross_salary);
                 })


                $('#tax').keyup(function(){
                    var tax = $(this).val();
                    var salary = $('#salary').val();
                    var tax_amount = salary * tax/100;
                    var total_netpay = salary - tax_amount;
                    $('#net_pay').val(total_netpay);
                })
            

            {{--datatable--}}
            
                $(document).ready(function() {
                    $('#advance-payment').DataTable();
                });
           

            {{--Start-For printing the screen--}}
           
                function pdf() {
                    window.print();
                }
   
                $('#startDate').datetimepicker(
        
        );
    
        $('#endDate').datetimepicker(
            
            );

                            calculate();
                            function calculate(){
                                var total_salary = parseInt($('#employee_salary').text()) || 0;
                                var per_day_amount=total_salary/30;

                                // var advance_payment=$('#advance').text();
                                var advance_payment = parseInt($('#advance').text()) || 0;
                                var advance_per_day_amount=advance_payment/30;

                                var overtime_payment = parseInt($('#overtime').text()) || 0;
                                var overtime_per_day_amount = overtime_payment /30;

                                var bonus_payment = parseInt($('#bonus').text()) || 0;
                                var bonus_per_day_amount=bonus_payment /30;
                                
                                var leave_day=$('#leave_count').text();
                                var leave_amount = parseInt(per_day_amount) * parseInt(leave_day);

                                var tax_percentage=1;
                                var tax_amount= (parseInt(total_salary) + parseInt(advance_payment) + parseInt(overtime_payment) + parseInt(bonus_payment) * parseInt(tax_percentage)) / 100 ;
                               
                                var total = parseInt(total_salary) + parseInt(overtime_payment) + parseInt(advance_payment) + parseInt(bonus_payment);
                                
                                var grand_total = total-leave_amount-tax_amount;
                                
                                
                                $('#tax').text(' % ' + tax_amount);
                                $('#total').text(total);
                                $('#grand-total').text(grand_total);
                                $('.currency-usd').css("font-weight","Bold");
                                $('#tax').css("font-weight","Bold");
                                $('#grand-total').css("background","#1abb9c");
                                $('#grand-total').css("color","#ffff");

                                $('#total').css("background","#5a1b2a");
                                $('#total').css("color","#ffff");
                                // console.log(grand_total);
                               
                            }

                            $('.currency-usd').each(function() { 
                            var monetary_value = $(this).text(); 
                            var i = new Intl.NumberFormat('en-US', { 
                                style: 'currency', 
                                currency: 'USD' 
                            }).format(monetary_value); 
                            $(this).text(i); 
                        }); 

            {{--End-For printing the screen--}}
            $('#wizard').smartWizard({
                enableFinishButton: false
            });

            $(".js-example-theme-single").select2({
  theme: "classic"
});

$(".js-example-theme-multiple").select2({
  theme: "classic"
});

</script> 




<script>
    ChangeDesignation();
 function ChangeDesignation(){
    $('#change_designation').on('click',function(){
    var designationID =$('#designation_id').val();
    var designationType = $('#designation_type').val();

    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        dataType: "json",
        url: '{{ url('user/designation/update') }}',
        data: {'designation_id': designationID, 'designation_type': designationType},
        success: function (data) {
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            // location.reload();
        }
    });               
                        })
// alert(grand_total);
}

ChangeEmploymentDetail();
 function ChangeEmploymentDetail(){
    $('#update_employment').on('click',function(){
    var employmentID =$('#employment_id').val();
    var employmentType = $('#employee_type').val();
    var office_email = $('#office_email').val();
    var emergency_number = $('#emergency_number').val();
    var passport = $('#passport').val();
    var roll_no = $('#roll_no').val();

    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
        dataType: "json",
        url: '{{ url('user/employment_detail/update') }}',
        data: {'employment_id': employmentID,
        'employment_type': employmentType, 
        'office_email': office_email,
        'emergency_number': emergency_number,
        'roll_no': roll_no,
        'passport': passport},

        success: function (data) {
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            // location.reload();
        }
    });               
                        })
// alert(grand_total);
}

ChangeEmploymentSkill();
 function ChangeEmploymentSkill(){
    $('#update_employment_skill').on('click',function(){
    var employmentID =$('#skill_id').val();
    var skillName1 = $('#skill_1').val();
    var skillName2 = $('#skill_2').val();
    var skillName3 = $('#skill_3').val();
    // var roll_no = $('#roll_no').val();
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
        dataType: "json",
        url: '{{ url('user/employment_skill/update') }}',
        data: {'skill_id': employmentID,
        'skill_1': skillName1,
        'skill_2': skillName2,
        'skill_3': skillName3},

        success: function (data) {
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            // location.reload();
        }
    });               
 })

}


ChangeEmploymentSalary();
 function ChangeEmploymentSalary(){
    $('#change_salary').on('click',function(){
    var employmentID =$('#salary_id').val();
    var salary_amount = $('#salary_amount').val();
    var salary_type = $('#salary_type').val();
    var allowance_amount = $('#allowance_amount').val();
    var bank_name = $('#bank_name').val();
    var account_number = $('#account_number').val();
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
        dataType: "json",
        url: '{{ url('user/employment_salary/update') }}',
        data: {'salary_id': employmentID,
        'salary_amount': salary_amount,
        'salary_type': salary_type,
        'allowance_amount': allowance_amount,
        'bank_name': bank_name,
        'account_number': account_number},

        success: function (data) {
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            // location.reload();
        }
    });               
 })

}

ChangeEmploymentDocument();
 function ChangeEmploymentDocument(){
    $('#update_employment_document').on('click',function(){
    var employmentID =$('#document_id').val();
    var skillName = $('#skill_name').val();
    // var roll_no = $('#roll_no').val();
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
        dataType: "json",
        url: '{{ url('user/employment_document/update') }}',
        data: {'skill_id': employmentID,
        'skill_name': skillName},

        success: function (data) {
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            // location.reload();
        }
    });               
 })

}
