@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> All Levels PDF </h3>

{{-- Table Course Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left1: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
        <th>Level</th>
        <th>Course</th>
        <th>Level Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($levels as $level)
            <tr class="border">
                <td class="col-md-3 pull">{!! $level->level !!}</td>
                <td class="col-md-6 pull">{!! $level->course['course_name'] !!}</td>
                <td class="col-md-6 pull">{!! $level->level_description !!}</td>
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
</div>




