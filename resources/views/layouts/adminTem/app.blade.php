<!DOCTYPE html>
<html>

@php
use App\Http\Controllers\Controller;
use App\Roll;
use App\Marks;
use App\HomeWork;
use App\Institute;
use App\StudentUploadHomeWork;
use App\MeritList;
use App\School;

$url = request()->segment(2);

if(Institute::where('school_id') != ''){
$institute = Institute::where('school_id', auth()->user()->school_id)->get();
}
else{
$systemLogo = Institute::where('school_id', null)->first();
}

$school = School::where('id', auth()->user()->school_id)->get();



$students = Roll::onlineStudent();
$homeworkCount = 0;
if(isset($homeworkCount)){
$homeworkCount = StudentUploadHomeWork::where('teacher_id', Auth::user()->teacher_id)->count();
}
$submited_students = StudentUploadHomeWork::join('admissions', 'admissions.id', '=',
'student_upload_homeworks.student_id')
->join('courses', 'courses.id', '=', 'student_upload_homeworks.subject_id')
->join('classes', 'classes.class_code', '=', 'student_upload_homeworks.class_code')
->where('teacher_id', Auth::user()->teacher_id)
->get();


$resultCount = MeritList::where('roll_no', Session::get('studentSession'))->count();
$markCount = Marks::where('roll_no', Session::get('studentSession'))->count();


use App\Permission;

use App\Http\Controllers\instituteController;
$get_grad = new instituteController;
$system_grade = $get_grad->index1();
$get_permission = new Permission;
$permissions = $get_permission->get_permission_by_role();
$permision =array();
foreach($permissions as $permission){
$permision[] = $permission->permission_name;
}


use App\Models\ClassSchedule;
$teacher_id = Auth::user()->teacher_id;
$teacherclass = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
->join('courses', 'courses.id', '=', 'class_schedule.course_id')
->select('semesters.id as semester_id','semesters.*','courses.*',
'classes.id as class_id','classes.*')
->where(['teacher_id' => $teacher_id])
->first();

$settings = '';

@endphp

<?php
$template = App\Institute::where('school_id', auth()->user()->school_id)->first();
?>

<style>
    .error{
        color:red;
    }

    table th {
        text-align:center;
    }

    table td {
        text-align:center;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link
        href="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
        rel="stylesheet">

        <!-- Dropzone Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/dropzone/dropzone.css')}}" rel="stylesheet">


    <!-- Morris Chart Css-->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('AdminBSBMaterialDesign/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('AdminBSBMaterialDesign/css/themes/all-themes.css')}}" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/light-gallery/css/lightgallery.css')}}" rel="stylesheet">

    <!-- Additional Style Sheets -->

    <!-- Bootstrap Material Datetime Picker Css -->
    <link
        href="{{asset('AdminBSBMaterialDesign/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"
        rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}"
        rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="{{asset('AdminBSBMaterialDesign/plugins/waitme/waitMe.css" rel="stylesheet')}}" />

    <!-- Bootstrap Select Css -->
    <!-- <link href="{{asset('AdminBSBMaterialDesign/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" /> -->

    <!-- Ends here  -->

</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->

    @include('layouts.adminTem.navbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('layouts.adminTem.left_sidebar')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->

        @include('layouts.adminTem.right_sidebar')
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/bootstrap/js/bootstrap.js')}}"></script>

  <!-- Dropzone Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/dropzone/dropzone.js')}}"></script>
    <!-- Select Plugin Js -->
    <!-- <script src="{{asset('AdminBSBMaterialDesign/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script
        src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}">
    </script>
    <script
        src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}">
    </script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}">
    </script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}">
    </script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}">
    </script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}">
    </script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

 <!-- Light Gallery Plugin Js -->
    <script src="{{asset('AdminBSBMaterialDesign/plugins/light-gallery/js/lightgallery-all.js')}}"></script>

     <!-- Ckeditor -->
     <script src="{{asset('AdminBSBMaterialDesign/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('AdminBSBMaterialDesign/plugins/tinymce/tinymce.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('AdminBSBMaterialDesign/js/admin.js')}}"></script>
    <script src="{{asset('AdminBSBMaterialDesign/js/pages/tables/jquery-datatable.js')}}"></script>
    <!-- <script src="{{asset('AdminBSBMaterialDesign/js/pages/forms/form-validation.js')}}"></script> -->


    <!-- Demo Js -->
    <script src="{{asset('AdminBSBMaterialDesign/js/demo.js')}}"></script>

     


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
        integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" />

    <!-- <script src="{{asset('AdminBSBMaterialDesign/js/pages/index.js')}}"></script> -->


    @yield('js')


    <script>
    $(document).ready(function() {
        $(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});
    })

    $(function () {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();
})

// Logout Script
var deleteLinks = document.querySelectorAll('#logout_btn');

// alert(deleteLinks)

for (var i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener('click', function(event) {
        event.preventDefault();
        
        var choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            document.getElementById("logout-form").submit(); //form id
        }
    });
}

// Ends here

$(function () {
    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function (value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    initRealTimeChart();
    initDonutChart();
    initSparkline();
});

var realtime = 'on';
function initRealTimeChart() {
    //Real time ==========================================================================================
    var plot = $.plot('#real_time_chart', [getRandomData()], {
        series: {
            shadowSize: 0,
            color: 'rgb(0, 188, 212)'
        },
        grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        lines: {
            fill: true
        },
        yaxis: {
            min: 0,
            max: 100
        },
        xaxis: {
            min: 0,
            max: 100
        }
    });

    function updateRealTime() {
        plot.setData([getRandomData()]);
        plot.draw();

        var timeout;
        if (realtime === 'on') {
            timeout = setTimeout(updateRealTime, 320);
        } else {
            clearTimeout(timeout);
        }
    }

    updateRealTime();

    $('#realtime').on('change', function () {
        realtime = this.checked ? 'on' : 'off';
        updateRealTime();
    });
    //====================================================================================================
}

function initSparkline() {
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });
}

function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
            label: 'Chrome',
            value: 37
        }, {
            label: 'Firefox',
            value: 30
        }, {
            label: 'Safari',
            value: 18
        }, {
            label: 'Opera',
            value: 12
        },
        {
            label: 'Other',
            value: 3
        }],
        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
        formatter: function (y) {
            return y + '%'
        }
    });
}

var data = [], totalPoints = 110;
function getRandomData() {
    if (data.length > 0) data = data.slice(1);

    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
        if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

        data.push(y);
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]]);
    }

    return res;
}

$('#play-video').on('click', function(ev) {
   
$("#video")[0].src += "?autoplay=1";
ev.preventDefault();

});

$('#theme_switcher').on('change', function(){
            // $('#theme_switcher').prop('checked');
           
            let template = $(this).prop('checked') === true ? 1 : 0;
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();

            // alert(_token)
            $.ajax({
            type: "post",
            // dataType: "json",
            url: '{{ route('update-template')}}',
            data: {
                'template': template,
                'school_id': school_id,
                '_token': _token
            },
            success: function(data) {
                console.log(data.message);

                window.location.reload(true);
            }
        });
        })

    </script>

</body>

</html>