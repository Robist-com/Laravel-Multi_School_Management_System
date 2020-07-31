@include('table_style')
<style>
 input:read-only 
 { 
   background-color:green; 
   /* color:white;  */
   /* text-align:center;  */
   border: none; 
   border-color: transparent;
  
 } 

 input:-moz-read-only { 
                background-color:Green; 
                border:1px solid black; 
                border-radius:4px; 
                padding:4px; 
                color:white; 
                text-align:center; 
 }
</style>

<div class="table-responsive">
<div class="panel">
<h1 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE LEVELS</h1>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="levels-table">
        <thead>
            <tr>
                <th>Grade</th>
                <th>Level</th>
        <th>Course</th>
        <th>Level Description</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($levels as $level)
            <tr>
            <td class="col-md-2">{!! $level->grade['semester_name'] !!}</td>
            <td class="col-md-2">{!! $level->level !!}</td>
                 
            <td>{!! $level->course['course_name'] !!}</td>
            <td class="col-md-5">{!! $level->level_description !!}</td>
            <td >
                <input type="checkbox" data-id="{{ $level->id }}" name="status" 
                class="js-switch" {{ $level->status == 'on' ? 'checked' : '' }}>
                </td>
                <td colspan="3">
                    {!! Form::open(['route' => ['levels.destroy', $level->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                    
                    <a data-level_id="{{$level->id}}" data-level="{{$level->level}}" 
                        data-level_description="{{$level->level_description}}" data-course_id="{{$level->course['course_name']}}"
                        data-created_at="{{$level->created_at}}" data-updated_at="{{$level->updated_at}}"
                         data-toggle="modal" data-target="#level-show" class='btn btn-default btn-xs'>
                         <i class="glyphicon glyphicon-eye-open"></i></a>
                       
                        <!-- <a href="{!! route('levels.show', [$level->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                       
                        <a data-level_id="{{$level->id}}" data-level="{{$level->level}}" 
                        data-level_description="{{$level->level_description}}" data-course_id="{{$level->course['course_name']}}"
                          href="{!! route('levels.edit', [$level->id]) !!}" class='btn btn-default btn-xs'>
                         <i class="glyphicon glyphicon-edit"></i></a>
                       
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="level-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
            </div>
            <form action="{{route('levels.store')}}" method="POST" id="frm-level-create">
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body">

<!-- Level Field -->
<div class="form-group">
    <!-- {!! Form::label('level', 'Level:') !!} -->
    {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level Here']) !!}
</div>
<input type="hidden" id="level_id" name="level_id">
<!-- Course Id Field -->
<div class="form-group">
    <!-- {!! Form::label('course_id', 'Course:') !!} -->
    <!-- {!! Form::number('course_id', null, ['class' => 'form-control']) !!} -->
    <select name="course_id" id="course_id" class="form-control">
    <option value="">Select Course</option>
    @foreach($courses as $key => $cour)
    <option value="{{$cour->id}}">{{$cour->course_name}}</option>
    @endforeach
    </select>
</div>
<!-- Level Description Field -->
<div class="form-group">
<textarea type="text" class="form-control" name="level_description" id="level_description"></textarea>
    <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!} -->
</div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
 {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!}
</div>
</form>
 </div>
</div>
</div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
            </div>
            <form action="{{route('levels.update','$level->id')}}" method="post"> 
            @csrf
            @method('PUT')
            <!-- <form action="{{route('levels.store')}}" method="POST" id="frm-level-create"> -->
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body" style="background:#EEEEEE" >

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level Here','readonly']) !!}
</div>
<input type="hidden" id="level_id" name="level_id">
<!-- Course Id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course Name:') !!}
    <input type="text" name="course_id" id="course_id" class="form-control"  readonly>
</div>
<!-- Level Description Field -->
<div class="form-group">
<label for="level_description">Level Description:</label>
<input type="text" class="form-control" name="level_description" id="level_description" readonly>
    <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!} -->
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <input type="text" class="form-control" name="created_at" id="created_at" readonly>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <input type="text" class="form-control" name="updated_at" id="updated_at" readonly>
</div>
<!-- Submit Field -->
</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
 <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
</div>
</form>
 </div>
</div>
</div>
@section('scripts')

<script>
// {{--------------------------Level Side-------------------------}} 
$('#level-edit').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var level = button.data('level')
var course_id = button.data('course_id')
var level_description = button.data('level_description')
var level_id = button.data('level_id')

var modal = $(this)

modal.find('.modal-title').text('EDIT LEVEL INFORMATION');
modal.find('.modal-body #level').val(level);
modal.find('.modal-body #course_id').val(course_id);
modal.find('.modal-body #level_description').val(level_description);
modal.find('.modal-body #level_id').val(level_id);
});

// {{--------------------------Level view Side-------------------------}} 
$('#level-show').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var level = button.data('level')
var course_id = button.data('course_id')
var level_description = button.data('level_description')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var level_id = button.data('level_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
modal.find('.modal-body #level').val(level);
modal.find('.modal-body #course_id').val(course_id);
modal.find('.modal-body #level_description').val(level_description);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #level_id').val(level_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'on' : 'off';
        let levelId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('level/status/update') }}',
            data: {'status': status, 'level_id': levelId},
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
}) 

</script>

@endsection