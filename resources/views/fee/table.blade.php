<div class="table-responsive">
<h1 style="font-weight:bold;"><i class="fa fa-money" aria-hidden="true"></i>FEES</h1>
<div class="panel"></div>
<div class="panel-body" style="border:0px solid">
    <div class="col-md-3">
    <label for="">Roll No:</label>
        <div class="form-group">
        <input type="text" name="" id="" class="form-control">
        </div>
    </div>

    <div class="col-md-3">
    <label for="">Semester</label>
        <div class="form-group">
        <select name="" id="" class="form-control select_2_single">
            <option value="">Select Semester</option>
        </select>
        </div>
    </div>

    <div class="col-md-3">
    <label for="">Class</label>
        <div class="form-group">
        <select name="" id="" class="form-control select_2_single">
            <option value="">Select Class</option>
        </select>
        </div>
    </div>
    <div class="col-md-3">
    <label for=""></label>
        <div class="form-group">
        <button class="btn btn-warning btn-xs" style="height:30px">Find</button>
        </div>
    </div>
</div>
</div>
<br>
<div class="panel panel-default">
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red">STUDENT'S FEES</h4>
</div>
    <table  class="table table-striped table-bordered table-hover" id="fees-table">
        <thead>
            <tr>
                <th>Course Id</th>
        <th>Level Id</th>
        <th>Semester Id</th>
        <th>Fee Structure Id</th>
        <th>Amount</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($fees as $fees)
            <tr>
                <td>{{ $fees->course_id }}</td>
            <td>{{ $fees->level_id }}</td>
            <td>{{ $fees->semester_id }}</td>
            <td>{{ $fees->fee_structure_id }}</td>
            <td>{{ $fees->amount }}</td>
                <td>
                    {!! Form::open(['route' => ['fees.destroy', $fees->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('fees.show', [$fees->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('fees.edit', [$fees->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
<!-- </div> -->
