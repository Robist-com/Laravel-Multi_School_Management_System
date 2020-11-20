<style>
.line {
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

<div class="page-title">
    <div class="title_left">
        <h2>FEE STRUCTURE</h2>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="row">

    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @if(isset($feeStructure))
                <h2 style="font-weight:bold">Update FeeStructure</h2>
                @else
                <h2 style="font-weight:bold">Create FeeStructure</h2>
                @endif
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <a href="{{route('feeStructures.index')}}"><button type="submit"
                            class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add
                            </i></button></a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($feeStructure))
                {!! Form::model($feeStructure, ['route' => ['feeStructures.update', $feeStructure->id], 'method' =>
                'patch' , 'autocomplete' => 'off']) !!}
                @else
                {!! Form::open(['route' => 'feeStructures.store' , 'autocomplete' => 'off']) !!}
                @endif
                @include('fee_structures.admindefault.fields')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 style="font-weight:bold"><i class="fa fa-money"></i> FEE STRUCTURE</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <a href="{{route('levels.index')}}"><button type="submit" class="btn btn-round btn-success"><i
                            class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action" text-center" id="feeStructures-table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Fee Type</th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <!-- <th>Admission Fee</th> -->
                            <th> Fee Amount</th>
                            <th> Total</th>
                            @if(auth()->user()->group == "Admin")
                            <th> School Name</th>
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
                                {!! Form::open(['route' => ['feeStructures.destroy', $feeStructure->fee_structure_id],
                                'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{{ route('feeStructures.show', [$feeStructure->fee_structure_id]) }}"
                                        class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{{ route('feeStructures.edit', [$feeStructure->fee_structure_id]) }}"
                                        class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"])
                                    !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="">

        </div>
    </div>
</div>
</div>
</div>
</div>