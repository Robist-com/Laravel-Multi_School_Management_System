<table class="table table-bordered table-hover table-striped table-condesed" class="display" style="width:100%" id="student_id">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">TeacherID</th>
            <th style="text-align:center;">Name</th>
            <th style="text-align:center;">Sex</th>
            <th style="text-align:center;">Birth Date</th>
            <th style="text-align:center;">Program</th>
            <th style="text-align:center;">Class</th>
            <th style="text-align:center;">Level</th>
            <th style="text-align:center;">Shift</th>
            <th style="text-align:center;">Time</th>
            <th style="text-align:center;">Day</th>
            <!-- <th style="text-align:center;">Teacher</th> -->
            <th style="text-align:center;">Batch</th>
            <th style="text-align:center;">Group</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $key => $class)
            <tr>
                <td style="text-align:center;">{{ ++$key }}</td>
                <td style="text-align:center;">{{ sprintf("%05d", $class->teacher_id) }}</td>
                <td style="text-align:center;">{{ $class->teacher_name }}</td>
                <td style="text-align:center;">{{ $class->sex }}</td>
                <td style="text-align:center;">{{ $class->dob }}</td>
                <td style="text-align:center;">{{ $class->program }}</td>
                <td style="text-align:center;">{{ $class->classroom_code}}</td>
                <td style="text-align:center;">{{ $class->level }}</td>
                <td style="text-align:center;">{{ $class->shift }}</td>
                <td style="text-align:center;">{{ $class->time }}</td>
                <td style="text-align:center;">{{ $class->days }}</td>
                <!-- <td style="text-align:center;">{{ $class->teacher_name }}</td> -->
                <td style="text-align:center;">{{ $class->batch }}</td>
                <td style="text-align:center;">{{ $class->group }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#student_id').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>