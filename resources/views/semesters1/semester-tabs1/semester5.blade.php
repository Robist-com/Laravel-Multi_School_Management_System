

    <table style="border-collapse:collapse;" class="table table-striped table-bordered table-hover" id="semesters-table">
        <thead>
            <tr>
                <th>Semester Name</th>
        <th>Semester Code</th>
        <th>Semester Duration</th>
        <th>Semester Description</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody id="accordion">

        @foreach($SemesterSubjects as $key => $semester)
        @if ($semester->semester_id == 5)
            <tr>
            <td>{!! $semester->semester_name !!}</td>
            <td>{!! $semester->semester_code !!}</td>
            <td>{!! $semester->semester_duration !!}</td>
            <td>{!! $semester->semester_description !!}</td>
            <td>
            <input type="checkbox" data-id="{{ $semester->semester_id }}" name="status" 
                class="js-switch" {{ $semester->status == 1 ? 'checked' : '' }}>
                </td>
                <td>
                    {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                    data-target="#semesterDetail-{{$key}}" data-parent="#accordion" title="View"><span class="fa fa-eye"></span></button>
                    <a data-toggle="modal" data-target="#semester_fields-modal" title="Add semester subject" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
                    <!-- --------------------------------------------------------------------------------- -->
                    <a data-toggle="modal" data-target="#semester_view_modal" 
                       data-semester_name="{!! $semester->semester_name !!}"
                      data-semester_id="{!! $semester->id !!}"  
                      data-semester_code="{!! $semester->semester_code !!}"
                     data-semester_duration="{!! $semester->semester_duration !!}" 
                      data-semester_description="{!! $semester->semester_description !!}" 
                     data-created_at="{!! $semester->created_at !!}"
                      data-updated_at="{!! $semester->updated_at !!}" 
                     class='btn btn-warning btn-xs'> 
                     <i class="glyphicon glyphicon-eye-open"></i></a>

                        <!-- <!-- ------ -->
                        <!-- SO NOW LET'S TRY IT OUT AND SEE.... -->
                        <a href="{!! route('semesters.edit', [$semester->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <tr>
            <td colspan="9" class="hiddenrow">
                @include('semesters.semesterSubjectList')
            </td>
        </tr>
        @endif
        @endforeach
        
        </tbody>
    </table>


