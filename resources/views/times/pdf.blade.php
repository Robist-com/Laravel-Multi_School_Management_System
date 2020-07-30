@include('pdf_header')
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Times PDF </h3>


<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>Time</th>
            <th>Shift</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($times as $time)
            <tr class="border">
                <td class="col-md-3 pull">{!! $time->time !!} </td>
                <td class="col-md-3 pull">{!! $time->shift !!} </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




