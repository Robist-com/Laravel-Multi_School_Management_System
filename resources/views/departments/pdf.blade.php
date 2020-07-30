@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Department PDF </h3>

{{-- Table Shift Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
        <th>Faculty</th>
        <th>Department Name</th>
        <th>Code</th>
        <th>Description</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
            <tr class="border">
            <td class="col-md-6 pull">{!! $department->faculty_name !!}</td>
            <td class="col-md-6 pull">{!! $department->department_name !!}</td>
            <td class="col-md-2 pull">{!! $department->department_code !!}</td>
            <td class="col-md-6 pull">{!! $department->department_description !!}</td>
            <td class="col-md-2 pull">@if( $department->department_status == 1)
                    Active @else In Active @endif</td>
                <td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




