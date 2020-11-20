

<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<h3>FEE STRUCTURE</h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('feeStructures.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>

    
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($feeStructure))
                    <h2>Update feeStructure</h2>
                    @else
                    <h2>Create feeStructure</h2>
                    @endif

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                @if(isset($feeStructure))
                {!! Form::model($feeStructure, ['route' => ['feeStructures.update', $feeStructure->id], 'method' =>
                'patch' , 'autocomplete' => 'off']) !!}
                @else
                {!! Form::open(['route' => 'feeStructures.store' , 'autocomplete' => 'off']) !!}
                @endif

                
                @include('fee_structures.adminbsb.fields')

                {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">

                    <h2>Fee Stucture Table</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Grade</th>
                                    <th>Type</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Fee $</th>
                                    <th> Total</th>
                                    @if(auth()->user()->group == "Admin")
                                    <th> School Name</th>
                                    @endif
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Grade</th>
                                    <th>Type</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th> Fee $</th>
                                    <th> Total</th>
                                    @if(auth()->user()->group == "Admin")
                                    <th> School Name</th>
                                    @endif
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                </tr>
                            </tfoot>

                            <tbody>

                                @foreach($feeStructures as $feeStructure)
                                <tr>
                                    <td>{{ $feeStructure->semester_name }}</td>
                                    <td>{{ $feeStructure->fee_type }}
                                    <td>{{ $feeStructure->faculty_name }}
                                    <td>{{ $feeStructure->department_name }}
                                    </td>
                                    <!-- <td> <b>$</b> {{ $feeStructure->admissionFee }}</td> -->
                                    <td class="text-right"><b>$</b> {{ number_format($feeStructure->semesterFee ,2)}}
                                    </td>
                                    <td class="text-right"><b>$</b> {{ number_format($feeStructure->total_amount ,2)}}
                                    </td>
                                    @if(auth()->user()->group == "Admin")
                                    <td>{{ auth()->user()->school->name }}</td>
                                    @endif
                                    <!-- <td>
                                        @if($feeStructure->status == '1')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td> -->
                                    <td>

                                        {!! Form::open(['route' => ['feeStructures.destroy',
                                        $feeStructure->fee_structure_id], 'method' =>
                                        'delete']) !!}
                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a
                                                        href="{{ route('feeStructures.show', [$feeStructure->fee_structure_id]) }}"><i
                                                            class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{{ route('feeStructures.show', [$feeStructure->fee_structure_id]) }}"><i
                                                            class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{{ route('feeStructures.edit', [$feeStructure->fee_structure_id]) }}"><i
                                                            class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$feeStructure->fee_type}} ?"><i
                                                            class="material-icons">delete_forever</i> Delete</a>
                                                </li>

                                            </ul>
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
        </div>
    </div>
    </div>