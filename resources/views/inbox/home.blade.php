{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css?ver=0.6">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=0.6" rel="stylesheet">
        <link href="vendor/Trumbowyg/dist/ui/trumbowyg.min.css?ver=0.6" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="vendor/Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.css?ver=0.6"> --}}

        @extends('layouts.app')

@section('content')

        <style>
            body{
                background: #ccc;

            }

            form{
                background: #fff;
                padding: 20px;
            }

            h1{
                margin-top: 0;
                font-size: 25px;
            }
           table>td>li>a{
text-decoration: none;
            }


        </style>
    {{-- </head> --}}
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
        <div class="box-body">
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="panel col-md-6">
                        <div class="panle-body">
                            <table class="table table-bordered">
                             <th> <li class="active"><a href="#" style="text-decoration:none">
                                <input type="checkbox" name="check[]" id="checkAll">
                                Check All</a>
                                </li></th>   
                                <tbody id="alluser">
                                    @foreach ($classstudents as $student)

                                    <tr>
                                        <td id="singleEmail{{$student->id}}">
                                            <li class="active"><a href="#" style="text-decoration:none">
                                                {{-- <input type="text" id="student" value="{{$student->id}}" > --}}
                                                <input type="checkbox" id="studentID{{$student->id}}" value="{{$student->email}}" >
                                                {{$student->first_name}} {{$student->last_name}} </a>
                                            </li>
                                        </td>
                                         <td >
                                              {{-- <input type="text" name="check[]" value="{{$student->email}}"> --}}
                                            <li class="active"><a href="#" style="text-decoration:none">
                                                {{$student->email}}</a>
                                            </li>
                                        </td>
                                        {{-- <td>
                                            <li class="active"><a href="#" style="text-decoration:none">
                                                {{$student->first_name}} {{$student->last_name}} </a>
                                            </li>
                                        </td> --}}
                                    </tr>
                                            @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panle col-md-6">
                    <form action="{{route('bulkMessage')}}" method="post" enctype="multipart/form-data">
                        {{-- <h1>Student Email</h1>
                        <a href="#" onclick="$('#server-info').show();">Edit server info</a>
                        <div id="server-info" style="display: none;">

                            <input type="text" id="fromname" placeholder="From Name" value="">
                            <input type="text" id="fromemail" placeholder="From Email" value="">
                            <hr>
                        </div> --}}
                        @csrf
                        <p id="multi-responce"></p>
                        <div class="form-horizontal" role="form">
                            <div class="form-group">
                                {{-- <input type="text" id="student_id" name="student_id"> --}}
                                <textarea class="form-control" id="emails" name="emails[]" placeholder="Email list" autofocus required></textarea>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject[]" placeholder="Subject" required>
                            </div>

                            <div class="form-group">
                                <textarea id="message" name="message[]" class="form-control" placeholder="Your Message" rows="5" required></textarea>
                            </div>
                            {{-- onclick="multi_email();" --}}
                            <button type="submit"  class="btn btn-primary btn-lg col-lg-12" id="send">Send Now </button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        </div>
        </div>
    </div>
@endsection
        @section('scripts')

<script>

$(document).ready(function() {
    // alert(1);
$('#checkAll').on('click', function(){
$('input:checkbox').not(this).prop('checked', this.checked);

// alert('all checked');
});


});

@foreach($classstudents as $student)
$(function() {
 $('#singleEmail{{$student->id}}').click(updateTextArea);
	updateTextArea();
});
@endforeach

function updateTextArea() {

var allVals = [];
$('#singleEmail{{$student->id}} td :checked').each(function() {

    allVals.push($(this).val());

});
$('#emails').val(allVals);
$('#student_id').val(allVals);
}

// function studentID() {

// var allVals = [];
// $('#singleEmail{{$student->id}} td :checked').each(function() {

//     allVals.push($(this).val());

// });
// $('#student_id').val(allVals);
// }



$(function() {
 $('#checkAll').click(updateTextArea);
	updateTextArea();
	studentID();
});


function updateTextArea() {

var allVals = [];
$('#alluser tr td :checked').each(function() {

    allVals.push($(this).val());

});
$('#emails').val(allVals);
}



function multi_email() {

  
$('#multi-responce').html("Sending to <span id='curent-email'></span>");

var emails = $('#emails').val();
var subject = $('#subject').val();
var message = $('#message').val();

// var sname = $('#sname').val();
// var spass = $('#spass').val();
// var fromemail = $('#fromemail').val();
// var fromname = $('#fromname').val();


var path_uri = "sengrid.php";


var email = emails.split(',');



$.ajax({
    type: "POST",
    url: path_uri,
    data: {
        sname: sname,
        spass: spass,
        fromemail: fromemail,
        fromname: fromname,
        emails: email_loop(email),
        subject: subject,
        message: message
    },
    success: function(data) {
        if (data == "success") {
            $('#multi-responce').html("Successfully sent");

        } else {
            $('#multi-responce').html(data);
        }
    }
});
}

var i = 0;
function email_loop(emails) {
$("#curent-email").html(email);
if (++i < emails.length) {
    setTimeout(multi_email, 2000);
}

return email;
}

        </script>
 @endsection