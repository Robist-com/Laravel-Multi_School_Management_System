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
<h1 style="font-weight:bold"><i class="fa fa-money"></i> FEE STRUCTURE</h1>
<hr class="line">
<div class="panel-body">
<form action="" method="get">
    <div class="col-md-1 pull-right">
    <button type="submit" class="btn btn-warning btn-sm  " style="height:28px; text-align:center"><b style="text-align:center; padding-top:5px">Find</b> </button>
    </div>
    <div class="col-md-3 pull-right">
    <select name="" id="" class="form-control select_2_single">
        <option value=""></option>
    </select>
    </div>
    </form>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red">STRUCTURE</h4>
</div>
    <table class="table table-striped table-bordered table-hover text-center" id="feeStructures-table" >
        <thead>
            <tr>
        <th>Grade</th>
        <th>Fee Type</th>
        <th>Faculty</th>
        <th>Department</th>
        <!-- <th>Admission Fee</th> -->
        <th > Fee Amount</th>
        <th > Total</th>
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

</div>
