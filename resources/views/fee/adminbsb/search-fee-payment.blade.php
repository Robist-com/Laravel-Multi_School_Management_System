<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>COLLECT FEES</h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"><i class="material-icons">attachment</i> File</li>
        </ol>
    </div>

    <div class="card">
        <div class="header">
            <h2>Fee Collections Table</h2>
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
            <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <label for="">Roll <b class="error">*</b></label>
                <div class="input-group">
                    <div class="form-line">
                        <input value="41116093000111" type="text" class="form-control" name="roll_no" id="roll_no"
                            placeholder="Search for...">
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-default" name="filter" id="filter" type="button">Go!</button>
                    </span>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <label for="">Grade <b class="error">*</b></label>
                <div class="form-group">
                    <select name="semester_id" id="semester_id_fee" class="form-control bootstrap-select">
                        <option value="" selected="true">Select Grade</option>
                        @foreach($semester as $semester)
                        <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="col-md-4 col-sm-4 col-xs-12">
                <label for="">Class <b class="error">*</b></label>
                <div class="form-group">
                    <select name="class_code" id="class_code" class="form-control bootstrap-select">
                        <option value="" selected="true">Select Class</option>
                        @foreach($classes as $classes)
                        <option value="{{$classes->class_code}}">{{$classes->class_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class=" col-md-12 col-sm-12 col-lg-12">
                <div class=" col-md-1 pull-right">
                    <button type="button" name="refresh" id="refresh"
                        class="btn bg-teal btn-sm btn-round">Refresh</button>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12" id="fee_type_select" style="display:none">
                    <label for="">Fee type <b class="error">*</b></label>
                    <div class="form-group">
                        <select name="fee_type" id="fee_type_id" class="form-control bootstrap-select">
                            <option value="" selected="true">Select Class</option>
                            @foreach($fee_structure as $fee_structure)
                            <option value="{{$fee_structure->id}}">{{$fee_structure->fee_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <form action="{{ count($readStudentFee) != 0? route('exstraPay')  : route('savePayment')}}" method="POST"
                id="frmPayment">
                @include('fee.adminbsb.fee-payment')

            </form>

            @include('fee.adminbsb.all_fees')

        </div>
    </div>
</div>
<!-- </div>
</div>
</div>
</div> -->


@section('js')

@include('fee.script.calculate')
@include('fee.script.payment')

<script>
$(document).ready(function() {


    var deleteLinks = document.querySelectorAll('#delete_link');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                document.getElementById("delete_form").submit(); //form id
            }
        });
    }

    //  Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });



    $('#show-total').hide();
    $('#show-multi_total').hide();
    $('#fee_report').hide();
    $('#collect_fee').hide();
    $('#multi_collect_fee').hide();
    $('#main_body').hide();
    // $('#panel_fee').hide();
    $('#fee_type_select').hide();
    var date = new Date();

    //   $('.input-daterange').datepicker({
    //   todayBtn: 'linked',
    //   format: 'yyyy-mm-dd',
    //   autoclose: true
    //  });


    function fetch_feeType(fee_type = '') {
        $.ajax({
            url: "{{ route('getFeeTypes') }}",
            method: "POST",
            data: {
                fee_type: fee_type,
                _token: _token
            },
            //  dataType:"json",
            beforeSend: function() {
                $('#loader').css("visibility", "visible");
            },
            success: function(response) {

                $('#total_records').text(response.length);
                $('#show-fee-type').html(response);
                $('#show-total').show();
                $('#fee_report').show();
                var semesterFee = $('#semesterFee').val();
                $('#totalFee').val(parseInt(semesterFee))

            },
            complete: function() {
                $('#loader').css("visibility", "hidden");
            }
        })
    }


    $('#fee_type_id').on('change', function() {
        var fee_type = $(this).val();
        var semesterFee = $('#semesterFee').val();
        $('#totalFee').val(semesterFee);
        // var admissionFee = $('#admissionFee').val();

        if (fee_type != '') {
            fetch_feeType(fee_type)
            $('#roll_id').show();
            $('#show-student-paid').show();
            // $('#main_body').show();
            $('#panel_fee').show();
            $('#panel_fee').css("visibility", "visible");
            $('#payment_submitButton').css("visibility", "visible");

            // $('#totalFee').val(semesterFee);

            // $('#main_body').show();
        } else {
            alert('Please Select fee type')
            $('#panel_fee').hide()
            $('#payment_submitButton').css("visibility", "hidden");
        }
    });



    // var x = document.getElementById("tabela").rows[2].cells[3].firstChild.value;
    // alert(1)
    // alert(x)



    $('#roll_no').on('change', function() {
        var roll_no = $(this).val();
        if (roll_no != '') {
            fetch_data_roll_no(roll_no = '')
        } else {
            alert('Please Select fee type')
        }
    });



    $('#btn-go').click(function() {
        var paid_amount = $('#Paid').val();

        if (paid_amount == '') {
            alert("Paid amount is required!");
        }
    })

    var _token = $('input[name="_token"]').val();


    function fetch_data_roll_no(roll_no = '') {
        $.ajax({
            url: "{{ route('FeeCollectionPayment') }}",
            method: "POST",
            data: {
                roll_no: roll_no,
                _token: _token
            },
            //  dataType:"json",
            beforeSend: function() {
                $('#loader').css("visibility", "visible");
            },
            success: function(response) {
                // var output = '';
                console.log(response);
                $('#total_records').text(response.length);
                $('#show-student-paid').html(response);
                // $('class_name').html(data.class_name);
                $('#show-total').show();
                $('#fee_report').show();
                $('#collect_fee').show();
                $('#multi_collect_fee').hide();
                $('#allfees-table').hide();
                $('#show-student-paid').show();
                $('#main_body').show();
                $('#panel_fee').hide();
                $('#fee_type_select').show();

                // $('.show-student-paid').html(data) 
            },
            complete: function() {
                $('#loader').css("visibility", "hidden");
            }
        })
    }

    function fetch_data(class_code = '', semester_id = '') {
        $.ajax({
            url: "{{ route('FeeCollectionPayment') }}",
            method: "POST",
            data: {
                class_code: class_code,
                semester_id: semester_id,
                _token: _token
            },
            //  dataType:"json",
            beforeSend: function() {
                $('#loader').css("visibility", "visible");
                $('#loader').show();
            },
            success: function(response) {

                $('#multi_total_records').text(response.length);
                $('#show-student-paid').html(response);
                // $('class_name').html(data.class_name);
                $('#show-multi_total').show();
                $('#fee_report').show();
                $('#multi_collect_fee').show();
                $('#collect_fee').hide();
                $('#show-student-paid').show();
                $('#allfees-table').hide();
                $('#main_body').show();
                $('#fee_type_select').show();

            },
            complete: function() {
                $('#loader').hide();
            }
        })
    }

    // $('#loader').hide();

    $('#filter').click(function() {
        var class_code = $('#class_code').val();
        var semester_id = $('#semester_id_fee').val();
        var roll_no = $('#roll_no').val();

        if (roll_no != '') {
            fetch_data_roll_no(roll_no)
            $('#roll_id').hide();
            $('#semesterFee').val();
            $('#show-student-paid').show();
            $('#main_body').show();
            $('#panel_fee').hide();
        } else {
            alert('Roll No Field is required');
            $('#show-total').hide();
            $('#fee_report').hide();
        }
    });

    $('#refresh').click(function() {
        $('#semester_id_fee').val('');
        $('#class_code').val('');
        $('#roll_no').val('');
        // fetch_data();
        // fetch_data_roll_no();fee_type_select
        $('#show-total').hide();
        $('#show-multi_total').hide();
        $('#fee_report').hide();
        $('#collect_fee').hide();
        $('#multi_collect_fee').hide();
        $('#allfees-table').show();
        $('#fee_type_select').hide();
        $('#show-student-paid').hide();
        $('#main_body').hide();
    });

    $('#class_code').on('change', function() {

        var class_code = $('#class_code').val();
        var semester_id = $('#semester_id_fee').val();
        var roll_no = $('#roll_no').val();

        if (class_code != '' && semester_id != '') {
            fetch_data(class_code, semester_id);
            $('#roll_id').show();
            $('#show-student-paid').show();
            $('#main_body').show();
            $('#panel_fee').hide();

        }
        var cla = $(this).val();
        $('#class_name').text(cla);
        $('#roll_no').val('');
    });

    $('#semester_id_fee').on('change', function() {
        var sem = $(this).val();
        $('#semester_name').text(sem);
        $('#roll_no').val('');
    })

    $('#roll_no').on('keyup', function() {
        $('#class_code').val('');
        $('#semester_id_fee').val('');

    })


});
</script>
@endsection