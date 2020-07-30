@include('pdf_header')
{{-- Table batch Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>Batch</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($batches as $batch)
            <tr class="border">
                <td class="col-md-3 pull">{!! $batch->batch !!} </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




