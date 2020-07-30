@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Grades PDF </h3>

{{-- Table Semester Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
        <th>Semester Name</th>
        <th>Semester Code</th>
        <th>Semester Duration</th>
        <th>Semester Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($semesters as $semester)
            <tr class="border">
            <td class="col-md-3 pull">{!! $semester->semester_name !!} </td>
            <td class="col-md-2 pull">{!! $semester->semester_code !!} </td>
            <td class="col-md-2 pull">{!! $semester->semester_duration !!} </td>
            <td class="col-md-6 pull">{!! $semester->semester_description !!} </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




