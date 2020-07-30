@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Faculty PDF </h3>

{{-- Table Shift Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
        <th>Faculty Name</th>
        <th>Faculty Code</th>
        <th>Faculty Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $faculty)
            <tr class="border">
            <td class="col-md-3 pull">{!! $faculty->faculty_name !!} </td>
            <td class="col-md-2 pull">{!! $faculty->faculty_code !!} </td>
            <td class="col-md-2 pull">@if($faculty->faculty_status == 1)  Active @else In-Active @endif </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




