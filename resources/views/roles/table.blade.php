<!-- @include('table_style') -->
<div class="table-responsive">
    <div  id="wait"></div>
       
                <table class="table table-striped jambo_table bulk_action" id="role-table">
                        <thead>
                        <tr class="headings">
                            <th class="text-center ">
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                <th class="text-center ">Name</th>
                <th class="column-title no-link last text-center"><span class="nobr">Action</span></th>
                <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
        <tr class="even pointer">
            <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
            </td>
                <td>{!! $role->name !!}</td>
                <td>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-roles-single', [$role->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('roles.show', [$role->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
