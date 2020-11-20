<style>
.line{
    /* border: none;
    height: 3px; */
    /* Set the hr color */
    /* color: #03C49E; old IE */
    /* background-color: #024181;
    padding-bottom:2px;
    margin-top:2px; */
 /* Modern Browsers */
}
</style>

<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action" text-center" id="feeStructures-table">
        <thead>
            <tr>
        <th>Grade</th>
        <th>Fee Type</th>
        <th>Faculty</th>
        <th>Department</th>
        <!-- <th>Admission Fee</th> -->
        <th > Fee Amount</th>
        <th > Total</th>
        @if(auth()->user()->group == "Admin") 
        <th > School Name</th>
        @endif
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($feeStructures as $feeStructure)
            <tr>
                <td>{{ $feeStructure->semester_name }}</td>
                <td>{{ $feeStructure->fee_type }}
                <td>{{ $feeStructure->faculty_name }}
                    <td>{{ $feeStructure->department_name }}
                </td>
            <!-- <td> <b>$</b> {{ $feeStructure->admissionFee }}</td> -->
            <td class="text-right"><b>$</b> {{ number_format($feeStructure->semesterFee ,2)}}</td>
            <td class="text-right"><b>$</b> {{ number_format($feeStructure->total_amount ,2)}}</td>
                @if(auth()->user()->group == "Admin") 
                <td>{{ auth()->user()->school->name }}</td>
                @endif
                <td>
                    {!! Form::open(['route' => ['feeStructures.destroy', $feeStructure->fee_structure_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('feeStructures.show', [$feeStructure->fee_structure_id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('feeStructures.edit', [$feeStructure->fee_structure_id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</div>

