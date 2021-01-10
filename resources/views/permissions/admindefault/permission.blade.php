@extends('layouts.new-layouts.app')

@section('content')


<!-- 
  -----------
  Visit Patternwall.net for free background patterns! 
  -----------
-->


<style>
  @import "compass/css3";
/* FontAwesome - The best icon font ever :) https://fortawesome.github.io/Font-Awesome/ Thanks to Dave Gandy and all involved in FontAwesome !!! */
 [class^="icon"], [class*=" icon"] {
	 font-family: FontAwesome;
	 font-weight: normal;
	 font-style: normal;
	 text-decoration: inherit;
	 -webkit-font-smoothing: antialiased;
}
 .iconUser:before {
	 content: "\f007";
	 margin-right: 6px;
}
 .iconAdd {
	 color: gray;
	 cursor: pointer;
	 float: right;
	 font-size: 28px;
	 margin-top: 6px;
}
 .iconAdd:before {
	 content: "\f067";
}
 .iconAdd:hover {
	 color: #9a9a9a;
}
 .iconRemove {
	 cursor: pointer;
	 color: gray;
}
 .iconRemove:before {
	 content: "\f00d";
}
 .patternwall {
	 position: absolute;
	 bottom: 20px;
	 right: 20px;
}

 .clear {
	 clear: both;
}
 .permissionWrapper {
	 width: 600px;
	 margin: 50px auto;
}
 .listFilterLabel {
	 color: gray;
}
 .listFilterInput {
	 margin: 0 0 20px 10px;
	 height: 28px;
	 line-height: 28px;
	 color: gray;
	 padding: 0 10px;
	 background-color: #2e2e2e;
	 border: solid 1px #343434;
}
 .listFilterInput:focus {
	 outline: none;
}
 .permissionsTable {
	 width: 100%;
	 color: #5a5a5a;
}
 .permissionsTable tr {
	 background-color: #ffffff;
}
 .permissionsTable th, .permissionsTable td {
	 height: 42px;
	 font-size: 14px;
	 font-weight: normal;
	 padding: 0 5px;
}
 .permissionsTable th:first-child, .permissionsTable td:first-child {
	 text-align: left;
	 padding: 4px 10px;
}
 .permissionsTable th:last-child, .permissionsTable td:last-child {
	 width: 25px !important;
}
 .permissionsTable th:not(:first-child), .permissionsTable td:not(:first-child) {
	 width: 60px;
}
 .permissionsTable thead th {
	 border-bottom: solid 3px #2e2e2e;
}
 .permissionsTable tbody tr td:first-child {
	 /* font-style: italic; */
}
 .permissionsTable tbody tr:hover {
   background-color: #2A3F54;
   color: #fff
}
 .permissionsTable tbody tr.focused {
   background-color: #2A3F54;
   color: #fff
}
 .permissionsTable tbody .userName {
	 display: inline-block;
	 width: 90%;
}
 .permissionTag {
	 -webkit-user-select: none;
	 -moz-user-select: none;
	 user-select: none;
	 cursor: pointer;
	 text-align: center;
	 font-size: 12px;
}
 .permissionTag[data-perm=view].multi {
	 background-color: #c1c1c1;
}
 .permissionTag[data-perm=view].active {
	 color: white;
	 background-color: #8dca35;
}
 .permissionTag[data-perm=edit].multi {
	 background-color: #c1c1c1;
}
 .permissionTag[data-perm=edit].active {
	 color: white;
	 background-color: #ffab00;
}
 .permissionTag[data-perm=delete].multi {
	 background-color: #c1c1c1;
}
 .permissionTag[data-perm=delete].active {
	 color: white;
	 background-color: #ffab00;
}
 .permissionTag[data-perm=owner].multi {
	 background-color: #c1c1c1;
}
 .permissionTag[data-perm=owner].active {
	 color: white;
	 background-color: #ff702a;
}
 .permissionTag[data-perm=admin].multi {
	 background-color: #c1c1c1;
}
 .permissionTag[data-perm=admin].active {
	 color: white;
	 background-color: #ff702a;
}
 
</style>

<style>
  @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:600&display=swap');
 * {
	 box-sizing: border-box;
}
 *::before, *::after {
	 box-sizing: border-box;
}
 body {
	 font-family: 'Source Sans Pro', sans-serif;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 margin: 0;
	 min-height: 100vh;
}
 input[type="checkbox"] {
	 position: relative;
	 width: 1.5em;
	 height: 1.5em;
	 color: #363839;
	 border: 1px solid #bdc1c6;
	 border-radius: 4px;
	 appearance: none;
	 outline: 0;
	 cursor: pointer;
	 transition: background 175ms cubic-bezier(0.1, 0.1, 0.25, 1);
}
 input[type="checkbox"]::before {
	 position: absolute;
	 content: '';
	 display: block;
	 top: 2px;
	 left: 7px;
	 width: 8px;
	 height: 14px;
	 border-style: solid;
	 border-color: #fff;
	 border-width: 0 2px 2px 0;
	 transform: rotate(45deg);
	 opacity: 0;
}
 input[type="checkbox"]:checked {
	 color: #fff;
	 border-color: #06842c;
	 background: #06842c;
}
 input[type="checkbox"]:checked::before {
	 opacity: 1;
}
 input[type="checkbox"]:checked ~ label::before {
	 clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
}
 label {
	 position: relative;
	 cursor: pointer;
	 font-size: 1.5em;
	 font-weight: 600;
	 padding: 0 0.25em 0;
	 user-select: none;
}
 label::before {
	 position: absolute;
	 content: attr(data-content);
	 color: #9c9e9f;
	 clip-path: polygon(0 0, 0 0, 0% 100%, 0 100%);
	 text-decoration: line-through;
	 text-decoration-thickness: 3px;
	 text-decoration-color: #363839;
	 transition: clip-path 200ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
 
</style>

<style>
#datatable-buttons thead,
#datatable-buttons th {text-align: center;}
.toggle{text-align: center;}
</style>

<?php 

$permission_fields = array(
          'Student View',
          'Student Add',
          'Student Update',
          'Student Delete',
          'Student Info',
          'Student Student Portal Access',
          'Student Student Bulk Add',
          'Family',
          'Add Student Attendance',
          'View Student Attendance',
          'View Student Monthly Reports',
          'Add Marks',
          'View Marks',
          'Delete Marks',
          'Generate Result',
          'Search Result',
          'promote Student',
          /*'Add Fess',
          'View Fess',
          'Update Fess',
          'Delete Fess',
          'View Fess Report',*/
          'View Result Reports',
          'View Attendance Reports',
          'View Sms/voice log Reports',
          //'View Student Monthly Reports',
          'Class View',
          'Class Add',
          'Class update',
          'Class delete',
          'Section View',
          'Section add',
          'Section update',
          'Section Delete',
          'Section Time Table',
          'Teacher View',
          'Teacher Add',
          'Teacher Bulk Add',
          'Teacher update',
          'Teacher delete',
          'Teacher timetable add',
          'Teacher timetable view',
          'Teacher Portal Access',
          'Send Sms/Voice',
          'Setting GPA Rule view',
          'GPA Rule add',
          'GPA Rule update',
          'GPA Rule delete',
          'GPA Rule View',
          'holidays add',
          'holidays view',
          'holidays delete',
          'Class off view',
          'Class off add',
          'Class off delete',
          'Institute information add',
          'Grade system (auto,manual)',
          'Subject View',
          'Subject Add',
          'Subject update',
          'Subject delete',
          'Exam View',
          'Exam Add',
          'Exam update',
          'Exam delete',
          'Gradesheet View',
          'Gradesheet Print',
          'Send Notification',
          'Paper View',
          'Paper Add',
          'Paper update',
          'Paper delete',
           //School Crud
          'School Add',
          'School update',
          'School View',
          'School delete',

           //Grade Crud
           'Grade Add',
           'Grade update',
           'Grade View',
           'Grade delete',

           //Level Crud
           'Level Add',
           'Level update',
           'Level View',
           'Level delete',

           //Day Crud
           'Day Add',
           'Day update',
           'Day View',
           'Day delete',

           //Shift Crud
           'Shift Add',
           'Shift update',
           'Shift View',
           'Shift delete',

           //Classroom Crud
           'Classroom Add',
           'Classroom update',
           'Classroom View',
           'Classroom delete',
           
          /*'Accounting',*/
        );

?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Admin</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">School</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Teacher</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Student</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
    {{-- ADMIN PERMISSIONS --}}
    <div id="permissionWrapper" class="permissionWrapper1">
      <h4>Admin Permissions</h4>
<div class="clear"></div><br>
@include('permissions.admindefault.admin_permission')
  </div>
  </div>

  {{-- OWNER PERMISSION --}}
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <h4>School Permissions</h4>
    <div class="clear"></div><br>
    @include('permissions.admindefault.school_permission')

  </div>
  {{-- TEACHER PERMISSION --}}
  <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="contact-tab">
   <h4>Teacher Permissions</h4>
    <div class="clear"></div><br>
    @include('permissions.admindefault.teacher_permission')
  </div>
  {{-- STUDENT PERMISSION --}}
  <div class="tab-pane fade" id="student" role="tabpanel" aria-labelledby="contact-tab">
   <h4>Student Permissions</h4>
    <div class="clear"></div><br>
    @include('permissions.admindefault.student_permission')
  </div>
</div>





<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">

      </div>
    </div>
  </div>
</div>






@stop
@section('scripts')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>

   window.onload = function() {
    var admincheckbox = document.getElementsByClassName("check");
    admincheckbox.addEventListener('click', function() {
      if(admincheckbox.checked){
        alert('Yes');
      } else {
        alert('No');
      }
    });
  }
  // var me   = 'no';
$( document ).ready(function() {

//         $("input[type=checkbox]").click(function() {
//           if (!$(this).prop("checked")) {
//               $(".check").prop("checked", false);
//               $(".check").val("no");
//           }else{
//             $(".check").prop("checked", true);
//             $(".check").val("yes");
//           }
// });
  
 
    // $('.check').prop("checked") ? 'yes' : 'no' ;

      //   if($('.check').is(":checked")){
      //   $(".check").prop("checked", true);
      //   $(".check").val("yes");

      // }else{
      //   $(".check").prop("checked", false);
      //   $(".check").val("no");
        
      // }


  $('#permissione').DataTable();

  $("#checkAll").change(function () {
//   alert(34);
  //alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element").change(function () {
    _tot = $(".cb-element").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll").prop('checked',false);
    }
});

$("#checkAll1").change(function () {
  //alert(34);
  //alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element1").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element1").change(function () {
    _tot = $(".cb-element1").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element1:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll1").prop('checked',false);
    }
});

$("#checkAll2").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element2").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element2").change(function () {
    _tot = $(".cb-element2").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element2:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll2").prop('checked',false);
    }
});
$("#checkAll3").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element3").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element3").change(function () {
    _tot = $(".cb-element3").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element3:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll3").prop('checked',false);
    }
});


$("#checkAll4").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element4").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element4").change(function () {
    _tot = $(".cb-element4").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element4:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll4").prop('checked',false);
    }
});

   //$('#timepicker1').timepicker();
    // $('#timepicker').timepicker({
    //     timeFormat: 'HH:mm:ss',
    // });

    //         $('#timepicker1').timepicker();
    
});

$("#adminchckwww").click(function(e) {
    // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
    if($(this).is(":checked")) // "this" refers to the element that fired the event
    {
        alert('home is checked');
        /*$(':checkbox').each(function () {
          //$(this).removeAttr('checked');
          $('input[type="radio"]').prop('checked', false);

        })*/
        $('input:checkbox[name=admin]').each(function () { $(this).prop('checked', true); });
          
    }else{
      alert('home is unchecked');
      $('.admins').prop('checked', $(e.target).prop('checked'));

     // $("input:checkbox[name=admin]").prop('checked', $(this).prop("checked",false));
       //$('input:checkbox').removeAttr('checked');
      //$('input:checkbox[name=admin]').each(function () { alert($(this)); $(this).prop('checked', false); });
    }
});




// set the root states
var initPermissionRootState = function(item){
  var body = $("#permissionsBody");
  var rowCount    = body.find("tr").length;
  var perm        = item.attr("data-perm");
  var selectCount = body.find("[data-perm=" + perm + "].active").length;

  if(rowCount == selectCount){
    $("#" + perm).removeClass("multi").addClass("active");
  }else if(selectCount > 0){
    $("#" + perm).removeClass("active").addClass("multi");
  }else{
    $("#" + perm).removeClass("active").removeClass("multi");
  }
}
$("#permissionWrapper").on("click", "#addUser", function(){
  var template = '<tr class="addState">' +
                   '<td><span class="iconUser"></span><span contenteditable="false" class="userName"></span></td>' + 
                   '<td><div class="permissionTag active" data-perm="view">View</div></td>' +
                   '<td><div class="permissionTag" data-perm="edit">Edit</div></td>' +
                   '<td><div class="permissionTag" data-perm="delete">Delete</div></td>' +
                   '<td><div class="permissionTag" data-perm="owner">Owner</div></td>' +
                   '<td><div class="permissionTag" data-perm="admin">Admin</div></td>' +
                   '<td><a href="#" class="iconRemove deleteUser" title="Remove this user"></a></td>' +
                 '</tr>';
  var user = $(template);
  $("#permissionsBody").prepend(user);

  setTimeout(function(){
    user.removeClass("addState");
  }, 50);

  initPermissionRootState(user.find("[data-perm=view]"));
  initPermissionRootState(user.find("[data-perm=edit]"));
  initPermissionRootState(user.find("[data-perm=delete]"));
  initPermissionRootState(user.find("[data-perm=owner]"));
  initPermissionRootState(user.find("[data-perm=admin]"));
                                    
  user.find(".userName").trigger("focus");
  return false;
});
$("#permissionsBody").on("focusin", ".userName", function(){
  $(this).parent().parent().addClass("focused");
}).on("focusout", ".userName", function(){
  $(this).parent().parent().removeClass("focused");
}).on("click", ".deleteUser", function(){
  var parent = $(this).parent().parent();
  parent.addClass("removeState");
  setTimeout(function(){
    parent.remove();
  }, 400);
});


// trigger root permission state
$("#checkAll").on("click", function(){
  var me   = $(this);

  if(me.hasClass("active")){
    me.removeClass("active");
    $(".check").prop("checked", false);
    $(".check").val("no");

  }else{
    me.addClass("active");
    $(".check").prop("checked", true);
    $(".check").val("yes");
    
  }

  initPermissionRootState(me);
});



// bind root permission state click and init
$("#permissionsHead").on("click", ".permissionTag", function(){
  var me   = $(this);
  var perm = me.attr("data-perm");
  var body = $("#permissionsBody");

  if(me.hasClass("active")){
    me.removeClass("active");
    body.find("[data-perm=" + perm + "].active:visible").trigger("click");
  }else{
    me.removeClass("multi");
    body.find("[data-perm=" + perm + "]:not(.active):visible").trigger("click");
  }

}).find(".permissionTag").each(function(i, e){
  initPermissionRootState($(e));
})

// init filter inputs --------------------------------------------------------------------
$("#permissionWrapper").on("keyup", ".listFilterInput", function(){
  var me    = $(this);
  var val   = $.trim(me.val());
  var items = $("#" + me.attr("id").replace("input", "list")).find("tr");
  
  if(val.length > 0){
    var item = null;
    
    $.each(items, function(i, e){
      item = $(e);
      if(!item.hasClass("doNotFilter")){
        (item.text().toUpperCase().indexOf(val.toUpperCase()) >= 0) ? item.show() 
        : item.hide();
      }
    });
  }else{
    items.show();
  }
});


</script>
@stop

