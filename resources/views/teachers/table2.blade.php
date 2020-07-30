<form action="/search" method="GET">
    <table class="table">
        <tr>
           <td style="text-align:center;">
            <div class="input-group col-md-4 pull-right" style="padding-left:1px; margin-bottom:5px;">
            <input type="search" name="search" id="search" value="{{request('search')}}" 
            class="form-control " placeholder="Search Teacher by Name or ID" >
            <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
            </span>
        </div>
    </td>
        </tr>
    </table>
</form>
<div class="table-responsive">

<div class="panel">
<div class="panel-body">
<div class="wait" id="wait"></div>
<!-- our loading feature will be here okay when when click or change any ajax function okay. -->
</div>
</div>

    <table class="table" id="teachers-table">
        <thead>
            <tr>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <!-- <th>Dob</th> -->
        <th>Phone</th>
        <!-- <th>Address</th> -->
        <!-- <th>Nationality</th> -->
        <!-- <th>Passport</th> -->
        <th>Status</th>
        <!-- <th>Dateregistered</th> -->
        <!-- <th>User Id</th> -->
        <th>Photo</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr>
                <td class="col-md-3">{!! $teacher->first_name !!} {!! $teacher->last_name !!}</td>
            <td class="col-md-1"> @if($teacher->gender == 0)
                    Male
                    @else
                    Female
                 @endif</td>
            <td class="col-md-2">{!! $teacher->email !!}</td>
            <!-- <td>{!! $teacher->dob !!}</td> -->
            <td class="col-md-2">{!! $teacher->phone !!}</td>

            <td class="col-md-1"> 
                <input type="checkbox" data-id="{{$teacher->teacher_id}}" name="status" class="js-switch" 
                  {{$teacher->status == 1 ? 'checked' : ''}}>
                </td>


            <!-- <td>{!! $teacher->dateregistered !!}</td>
            <td>{!! $teacher->user_id !!}</td> -->
            <td class="col-md-1"><img src="{{asset('teacher_images/' .$teacher->image)}}" alt="" 
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                <td colspan="3">
                    {!! Form::open(['route' => ['teachers.destroy', $teacher->teacher_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <button type="button" class="btn btn-danger "><i class="fa fa-tasks" style="color:white"></i></button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="munu" id="export-menu"  >
                        <a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('teachers.edit', [$teacher->teacher_id]) !!}"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </ul>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $teachers->links() }}
</div>

@section('scripts')

<script>
$(document).ready(function(){
  
$('.js-switch').change(function(){

let status = $(this).prop('checked') == true ? 1: 0;
let teacherId =  $(this).data('id');

$.ajax({
        type: "GET",
        dataType: "json",
        url: "{{ url ('teacher-status-update')}}",
        data: {'status': status, 'teacher_id': teacherId },
        success: function(data){
            console.log(data.message);
            // here we will write our toaster okay
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
})
})

})
</script>
@endsection