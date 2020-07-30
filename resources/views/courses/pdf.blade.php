@include('pdf_header')
{{-- Table Course Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr class="border">
                <td class="col-md-3 pull">{!! $course->course_name !!}</td>
                <td class="col-md-3 pull">{!! $course->course_code !!}</td>
                <td class="col-md-3 pull">{!! $course->describtion !!}</td>
                <td class="col-md-3 pull"> @if($course->status == 1) Active @else In-Active @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
</div>




