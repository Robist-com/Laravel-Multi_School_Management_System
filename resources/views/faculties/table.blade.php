@include('table_style')
<style>
.badge-active{
    background:green;
    color:#fff;
    font-family: 'Times New Roman', Times, serif;
    font-display: bold;
    font-size: large;
}

.badge-inactive{
    background:red;
    color:#fff;
    font-family: 'Times New Roman', Times, serif;
    font-display: bold;
    font-size: large;
}

</style>
<div class="table-responsive">
<div class="panel">
<h3 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE STUDENT GROUP</h3>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="faculties-table">
        <thead>
            <tr>
                <th>Group Name</th>
        <th>Group Code</th>
        <th rowspan="2" style="text-align:center">Group Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($faculties as $faculty)
            <tr>
                <td>{!! $faculty->faculty_name !!}</td>

                <div id="wait" style="display:none;width:69px;height:89px;border:none 
            solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
            <img src="{{asset('images/loading.gif')}}"
            width="64" height="64" /><br>Loading..</div>
            
                <td>{!! $faculty->faculty_code !!}</td>

                <td style="text-align:center">
                <input type="checkbox" data-id="{{ $faculty->faculty_id }}" name="status" 
                class="js-switch" {{ $faculty->faculty_status == 1 ? 'checked' : '' }}>
                </td>

                <td colspan="3">
                    {!! Form::open(['route' => ['faculties.destroy', $faculty->faculty_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-faculty-single', [$faculty->faculty_id]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('faculties.show', [$faculty->faculty_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('faculties.edit', [$faculty->faculty_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@section('scripts')

<script>
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let facultyId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('faculties.update.status') }}',
            data: {'status': status, 'faculty_id': facultyId},
            success: function (data) {
                console.log(data.message);
                // success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
// }
            }
        });
    });
});
</script>
@endsection