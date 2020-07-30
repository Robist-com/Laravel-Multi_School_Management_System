@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Times PDF </h3>


<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>ClassRoom</th>
            <th>Code</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classrooms as $classroom)
            <tr class="border">
                <td class="col-md-3 pull">{!! $classroom->classroom_name !!} </td>
                <td class="col-md-3 pull">{!! $classroom->classroom_code !!} </td>
                <td class="col-md-3 pull">{!! $classroom->classroom_description !!} </td>
                <td class="col-md-3 pull">@if($classroom->classroom_status == 1) Active @else In-Active @endif </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




