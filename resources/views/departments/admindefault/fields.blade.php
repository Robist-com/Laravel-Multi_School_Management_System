<style>
.border{
    border-radius:5px;
    height:30px;
}

#select_2_single{
    width:1px !important;
}
</style>

<div class="modal fade" id="department-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-level-up">Add New Class Group</span> </h4>
            </div>
            <form action="{{route('departments.store')}}" method="POST" id="frm-level-create">
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body">

                 <!-- Faculty Id Field -->
        <div class="form-group" >
            <select name="faculty_id" id="faculty_id" class="form-control select_2_single" id="select_2_single">
            <option value="0" selected="true" disabled="true" style="margin-right:20px">Choose Student Group</option>
            @foreach($faculties as $key => $faculty)
            <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
            @endforeach
            </select>
        </div>

        <!-- Department name Field -->
        <div class="form-group">
            {!! Form::text('department_name', null, ['class' => 'form-control border', 'placeholder' => 'Enter Class Group Name']) !!}
        </div>
        <!-- Department code Field -->
        <div class="form-group">
            {!! Form::text('department_code', null, ['class' => 'form-control border', 'placeholder' => 'Enter Class Group Code']) !!}
        </div>
       
        <!-- Department Description Field -->
        <div class="form-group">
            {!! Form::textarea('department_description', null, ['class' => 'form-control border', 'cols' => 40, 'rows' =>2, 'placeholder'=> ' Description']) !!}
        </div>

        <!-- Department Status Field -->
        <div class="form-group col-md-6 ">
            {!! Form::label('department_status', 'Status:') !!}
            <label class="checkbox-inline">
                {!! Form::hidden('department_status', 0) !!}
                {!! Form::checkbox('department_status', '1', null) !!} 1
            </label>
        </div>
        <!-- Submit Field -->
        </div>
        <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
        {!! Form::submit('Create Class Group', ['class' => 'btn btn-success']) !!}
        </div>
        </form>
        </div>
        </div>
        </div>

@section('scripts')

<script>
// {{--------------------------Level Side-------------------------}} 
$(document).ready(function(){
 
    $('#department_name').on('keyup', function(){

		var randomString = function(length) {
			
			var text = "";
		
			var possible = "DABCDEFGHIJKLMNOPQRSTUVWXYZ01234567891011121314151617181920";
			
			for(var i = 0; i < length; i++) {
			
				text += possible.charAt(Math.floor(Math.random() * possible.length));
			
			}
			
			return text;
        }
        
        var random = randomString(5);
        var prix = 'CG';
        var department_name = $("#department_name").val();
        
           if (department_name !== '') {
           var elem = document.getElementById("department_code").value = prix +'-'+ random +'-'+ department_name;
            }else{
            var elem = document.getElementById("department_code").value = '';
            }
        });

$('.js-switch').change(function () {
    let status = $(this).prop('checked') === true ? 1 : 0;
    let departmentId = $(this).data('id');
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ url('department/status/update') }}',
        data: {'status': status, 'department_id': departmentId},
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