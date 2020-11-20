<div class="responsive">
<table class="table table-striped jambo_table bulk_action" id="allfees-table">
<thead>
    <tr class="headings">
        <th>
            <input type="checkbox" id="check-all" class="flat">
        </th>
        <th>Photo</th>
        <th>Roll No.</th>
        <th>Grade</th>
        <th>Fee Type</th>
        <th>Fee Amount</th>
        <th>Paid Amount</th>
        <th>Balance</th>
        <th class="column-title no-link last"><span class="nobr">Action</span></th>
        <th class="bulk-actions" colspan="8">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
        </th>
            </tr>
        </thead>
        <tbody>
        @foreach($all_fees as $fees)
        <tr class="even pointer">
            <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
            </td>
            <td><img src="{{asset('student_images/'.$fees->image)}}" alt=""
            class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{ $fees->username }}</td>
            <td>{{ $fees->semester_name }}</td>
            <td>{{ $fees->fee_type }}</td>
            <!-- <td>{{ $fees->fee_structure_id }}</td> -->
            <td>{{ number_format($fees->semesterFee,2) }}</td>
            <td>{{ number_format($fees->paid_amount,2) }}</td>
            @if($fees->balance > 0.00)
            <td><label for="" class="btn btn-danger btn-xs">{{ $fees->balance}}</label></td>
            @else
            <td><label for="" class="btn btn-info btn-xs">Completed</label></td>
            @endif
                <td>
                    {!! Form::open(['route' => ['deleteStudentFee', $fees->student_fee_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ url('all/student/transactions', [$fees->student_id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this? This will delete the related table details!')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>