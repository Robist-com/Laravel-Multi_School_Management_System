<div class="page-title">
    <div class="title_left">
        <h2>MANAGE SUBJECTS</h2>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
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
                @if(isset($course))
                <h2>Update Subject</h2>
                @else
                <h2>Create Subject</h2>
                @endif
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <a href="{{route('courses.index')}}"><button type="submit" class="btn btn-round btn-success"><i
                                class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($course))
                {!! Form::model($course, ['route' => ['courses.update', $course->subject_id], 'method' => 'patch',
                'class' => 'form-horizontal form-label-left']) !!}
                @else
                {!! Form::open(['route' => 'courses.store', 'class' => 'form-horizontal form-label-left']) !!}
                @endif

                @if(auth()->user()->group == "Admin")
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                                @if(isset($course)){{$course->school_id == $school->id ? 'selected' : ''}} @endif>
                                {{$school->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                @endif

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="course_name" id="course_name" class="form-control"
                            placeholder="Enter Subject Name" @if(isset($course)) value="{{$course->course_name}}"
                            @endif>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="course_code" readonly id="course_code" class="form-control"
                            placeholder="Enter Subject Code" @if(isset($course)) value="{{$course->course_code}}"
                            @endif>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="department" class="form-control select_2_single" id="department_id">
                            <option value="">Select Class Group </option>
                            @foreach ($department as $department)
                            <option value="{{ $department->department_id}}"
                                @if(isset($course)){{$department->department_id == $course->department ? 'selected' : ''}}
                                @endif>{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="class[]" class="form-control select_2_single" multiple data-hide-disabled="true"
                            data-size="5" id="subject_class">
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}" @if(isset($course))
                                {{$class->class_code == $course->class ? 'selected' : ''}} @endif>{!! $class->class_name
                                .'-- '. $class->class_code !!}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="gradeSystem" class="form-control select_2_single" id="grade_system">
                            <option value="">Grade System</option>
                            @if($gpa)
                            @foreach($gpa as $gp)
                            <option value="{{$gp->for}}"
                                @if(isset($course)){{$gp->for == $course->gradeSystem ? 'selected' : ''}} @endif>
                                @if($gp->for=="1") 100 Marks @elseif($gp->for=="2") 75 Marks @elseif($gp->for=="3") 50
                                Marks @elseif($gp->for=="4") 30 Marks @elseif($gp->for=="5") 25 Marks
                                @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8")
                                10 Marks @endif </option>

                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea name="describtion" id="describtion" class="form-control" cols="30" rows="2"
                            placeholder="Enter Subject Description"> @if(isset($course)) {{$course->describtion}} @endif</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(isset($course))
                        {!! Form::hidden('status', '0') !!}
                        {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                        @else
                        {!! Form::hidden('status', '0') !!}
                        {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    @if(isset($course))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-8 col-xs-8">
        <div class="x_panel">
            <div class="x_title">
                <h2> Subjects List </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <a class="btn btn-success btn-round" data-toggle="modal" data-target="#courses-add-modal"><i
                            class="fa fa-plus-circle" aria-hidden="true"> Add New Subject</i></a>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">Subject</th>
                                <th class="column-title">Code</th>
                                <th class="column-title">Class</th>
                                <th class="column-title">Class Group</th>
                                <th class="column-title">Status</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($courses as $course)
                            <tr class="even pointer">

                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td data-toggle="tooltip" data-placement="right" title=""
                                    data-original-title="{!! $course->description !!}">{!! $course->course_name !!}</td>
                                <td class="badge badge-success" style="text-align: center;">{!! $course->course_code !!}
                                </td>
                                <td>{!! $course->class !!}</td>
                                <td>{!! $course->department_name !!}</td>
                                <td>
                                    @if($course->status == '1')
                                    <label for="" style="color:#26B99A"><i
                                            class="fa fa-check-circle fa-lg"></i></i></label>
                                    @else
                                    <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['courses.destroy', $course->subject_id], 'method' =>
                                    'delete']) !!}
                                    <div class='btn-group'>
                                        <!-- <a href="#" data-toggle="modal"  data-target="#level-add" class='btn btn-success btn-xs' title="Add Level"><i class="glyphicon glyphicon-plus"></i></a> -->
                                        <a href="{!! route('courses.show', [$course->subject_id]) !!}"
                                            class='btn btn-default btn-xs' title="Print"><i
                                                class="glyphicon glyphicon-print"></i></a>
                                        <a href="{!! route('courses.show', [$course->subject_id]) !!}"
                                            class='btn btn-warning btn-xs' title="View"><i
                                                class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="{!! route('courses.edit', [$course->subject_id]) !!}"
                                            class='btn btn-info btn-xs' title="Edit"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' =>
                                        'submit', 'title'=> 'Delete', 'class' => 'btn btn-danger btn-xs', 'onclick' =>
                                        "return confirm('Are you sure?')"]) !!}
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


 @section('scripts')

<script>
//   $(document).ready(function(){
//     alert(1)
//   })
$('#department_id').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#subject_class')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name +'-'+ c.class_code
}))
}) 
})
});

$(document).ready(function(){

$('#course_name').on('keyup', function(){

var randomString = function(length) {

var text = "";

// var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
var possible = "ABCDEFGHIJKLMNOP56789QRSTUVWXYZ01234";

for(var i = 0; i < length; i++) {

  text += possible.charAt(Math.floor(Math.random() * possible.length));

}

return text;
}

// random string length
var random = randomString(3);
var class_name = $("#course_name").val();
  
if (class_name !== '') {
  var elem = document.getElementById("course_code").value = random +'-'+ class_name;
}else{
  var elem = document.getElementById("course_code").value = '';
}
  // alert(random)
// insert random string to the field

})

// $('#course_code').attr('disabled', true);

}) 

</script>
    
@endsection