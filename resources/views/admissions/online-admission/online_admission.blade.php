
      <div class="page-title">
              <div class="title_left">
                <h3>ONLINE ADMINSSIONS</h3>
              </div>

              <div class="title_right">
               
                </div>
            </div>

            <div class="x_panel">
                  <div class="x_title"> 
                    <!-- <h2>ONLINE ADMINSSIONS</h2> -->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
              <div class="x_content"> 
        <div class="clearfix"></div>

        @include('flash::message')

        @include('admissions.online-admission.online_table_list')
        </div>
  

        @section('scripts')

        @include('fee.script.calculate') 

        @include('fee.script.payment')

    <script>
    $(document).ready(function(){
      $('#gride').hide();
      var _token = $('input[name="_token"]').val();

      function Sort_gender(sort_by_gender = '')
    {
    $.ajax({
      url:"{{ url('sort/students') }}",
      method:"GET",
      data:{sort_by_gender:sort_by_gender, _token:_token},
    //    dataType:"json",
      success:function(response)
      {
      
      $('#show-student-list').html(response);
      //  $('#show-student-gallary').html(response);
      $('#show-total').show();
      $('#fee_report').show();
      $('#print-student-transaction').hide();
      // $('.show-student-paid').html(data) 
      }
    })
    }


    $('#display').on('change', function(){
      var table = $(this).val();

      if(table == 'table'){
      $('#gride').hide();
      $('#table').show();

      }else if(table == 'gride')
      {
        $('#gride').show();
      $('#table').hide();
      }
    })


    function fetch_data_roll_no(roll_no = '')
        {
          $.ajax({
          url:"{{ url('sort/students') }}",
          method:"GET",
          data:{roll_no:roll_no,  _token:_token},
          //  dataType:"json",
          success:function(response)
          {
            
            $('#show-student-list').html(response);
            $('class_name').html(response.class_name);
            $('#show-total').show();
            $('#print-student-transaction').show();
            $('#fee_report').show();
          }
          })
        }

    //Filter by Class Code 
        $('#sort_by_gender').on('change',function()
        {

              var sort_by_gender = $('#sort_by_gender').val();

              if(sort_by_gender != '')
              {
                Sort_gender(sort_by_gender);
              $('#roll_id').show();
              $('#print-student-transaction').hide();

              }
              else
              {
                Sort_gender();
              }
        });

        $('#filter').click(function(){
            var roll_no = $('#roll_no').val();

              if(roll_no != '')
              {
                fetch_data_roll_no(roll_no)
                $('#roll_id').hide();
                $('#print-student-transaction').show();

              }
              else
              {
              alert('Enter Student Roll Number to search please!');
              $('#show-total').hide();
              $('#fee_report').hide();
              }
            });


            $('#refresh').click(function(){
              $('#roll_no').val('');
              fetch_data_roll_no();
              Sort_gender();
              $('#show-total').hide();
              $('#fee_report').hide();
              
              $('#sort_by_gender option').prop('selected', function () { 
                if (this.defaultSelected) { 
                            this.selected = true; 
                            return false; 
                    } 
              }); 
            });

          // GET SEMESTER DEGREEE
          $('#semester_id').on('change',function(e){
          getStudentsByclass()
          var semester_id = $(this).val();
          var degree = $('#degree_id')
          $(degree).empty();
          $.get("{{ route('dynamicDegrees') }}",{semester_id:semester_id},function(data){  

          console.log(data);
          $.each(data,function(i,l){
          $(degree).append($('<option/>',{
          value : l.degree_id,
          text  : l.degree_name
        }))
      }) 
    })
  });

// GET SEMESTER DEGREEE
$('#faculty_id').on('change',function(e){
getStudentsByclass()
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

// GET SEMESTER DEGREEE
// $('#faculty_id').on('change',function(e){
function getStudentsByclass(){
var faculty_id = $('#faculty_id').val();
var department_id = $('#department_id').val()
var class_id = $('#class_id').val()
var semester_id = $('#semester_id').val()
var degree_id = $('#degree_id').val()
var student_id = $('#student_id')
$(student_id).empty();
$.get("{{ route('dynamicStudentsByClass') }}",
{faculty_id:faculty_id,'department_id':faculty_id,'class_id':class_id,
'semester_id':semester_id,'degree_id':degree_id},function(data){  

console.log(data);
$.each(data,function(i,l){
$(student_id).append($('<option/>',{
value : l.id,
text  : l.first_name + " " + l.last_name
// text  : 
}))
}) 
})
}
});

$("#acceptance").each(function(){
    var color = $("option:selected", this).attr("class");
    $("#acceptance").attr("class", color);
});


$(document).ready(function () {

  var $checkboxes = $('#table td input[type="checkbox"]');
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
    var rowCount = $('#table tbody tr').length;
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
    $("#table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

})

// Function for Search data 
$(document).ready(function(){
  $("#student_id_single").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});






</script>
@endsection 


