@include('pdf_header')
{{-- Table Course Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>Class</th>
            <th>Code</th>
            <th>Department</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classes as $class)
            <tr class="border">
                <td class="col-md-3 pull">{!! $class->class_name !!}</td>
                <td class="col-md-3 pull">{!! $class->class_code !!}</td>
                <td class="col-md-3 pull">{!! $class->department_name !!}</td>
                <td class="col-md-3 pull"> @if($class->status == 1) Active @else In-Active @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
</div>




