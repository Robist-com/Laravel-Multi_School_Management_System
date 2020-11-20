<style>
.input-icon {
    position: absolute;
    left: 3px;
    top: calc(60% - 0.5em);
}

input {
    padding-left: 17px;
}

.input-wrapper {
    position: relative;
}

.line {
    font-weight: bold;
    color: blue;
}
</style>


<!-- Name Field -->


        <div class="form-group">
        <select name="semester_id" id="semester_id" class="form-control bootstrap-select">
            <option value="">Select Grade</option>
            @foreach($semesters as $key => $semester)
                <option value="{{$semester->id}}" @if(isset($feeStructure)) {{ $semester->id == $feeStructure->semester_id ? 'selected' : '' }} @endif>{{$semester->semester_name}}</option>
            @endforeach
        </select>
        </div>

            <!-- Name Field -->
        <div class="form-group">
        <select name="degree_id" id="degree_id" class="form-control bootstrap-select">
        @if(isset($feeStructure))
        @if(isset($levels))
        @foreach($levels as $key => $levels)
            <option value="{{$levels->id}}" @if(isset($feeStructure)) {{ $feeStructure->semester_id == $levels->grade_id ? 'selected' : '' }} @endif>{{$levels->level}}</option>
        @endforeach
        @endif
        @endif
        </select>
        </div>

<!-- Name Field -->
    <div class="form-group">
        <select name="faculty_id" id="faculty_id" class="form-control bootstrap-select">
            <option value="">Select Faculty</option>
            @foreach($faculties as $key => $faculty)
            <option value="{{$faculty->faculty_id}}" @if(isset($feeStructure))
                {{ $faculty->faculty_id == $feeStructure->faculty_id ? 'selected' : '' }} @endif>
                {{$faculty->faculty_name}}</option>
            @endforeach
        </select>
    </div>

<!-- Name Field -->
    <div class="form-group">
        <select name="department_id" id="department_id" class="form-control bootstrap-select">
            @if(isset($feeStructure))
            @if(isset($departments))
            @foreach($departments as $key => $departments)
            <option value="{{$departments->department_id}}"
                {{ $feeStructure->faculty_id == $departments->faculty_id ? 'selected' : '' }}>
                {{$departments->department_name}}</option>
            @endforeach
            @endif
            @endif
        </select>
    </div>

    <div class="form-group">
    <div class="form-line">
        {!! Form::text('fee_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Fee Type']) !!}
    </div>
    </div>

<!-- Name Field -->
    <div class="form-group">
    <div class="form-line">
        <div class="input-wrapper">
            {!! Form::number('semesterFee', null, ['class' => 'form-control', 'style'=>'text-align:right', 'placeholder'
            => 'Enter Semester Fee',
            'onkeyup'=> 'NumbersOnly(event, this);', 'onfucus'=>"this.value=''"]) !!}
            <i class="fa fa-money fa-lg input-icon"></i>
        </div>
        </div>

    <div class="modal-footer">
        {!! Form::submit('Generate Fee Structure', ['class' => 'btn bg-teal btn-round']) !!}
    </div>
</div>


@section('js')

<script>
$('#semester_id').on('change', function(e) {

    var grade_id = $(this).val();
    var degree = $('#degree_id')
    $(degree).empty();
    $.get("{{ route('dynamicDegrees') }}", {
        grade_id: grade_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, l) {
            $(degree).append($('<option/>', {
                value: l.id,
                text: l.level
            }))
        })
    })
});

// GET SEMESTER DEGREEE
$('#faculty_id').on('change', function(e) {

    var faculty_id = $(this).val();
    var department_id = $('#department_id')
    $(department_id).empty();
    $.get("{{ route('dynamicDepartments') }}", {
        faculty_id: faculty_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, l) {
            $(department_id).append($('<option/>', {
                value: l.department_id,
                text: l.department_name
            }))
        })
    })
});


// REGULAR EXPRESSION 


function NumbersOnly(e, field) {

    var val = field.value;
    var num = /^([0-9-.]+[\.]?[0-9-.]?[0-9-.]?|[0-9-.]+)$/g;
    var number = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;

    // now we will check if the input value is number or charcater okay
    if (num.test(val)) {

    } else {
        val = number.exec(val);

        if (val) {
            field.value = val[0];
        } else {
            field.value = ''
        }
        //  if the value is character then the input field will be empty okay

        // else the input field will contain numbers okay

    }
}


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

</script>

@endsection