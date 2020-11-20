
<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
</div>
    <table class="table table-striped table-bordered js-exportable " >
    <!-- <table id="datatable-buttons1" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info" style="width: 690px;">  -->
        <thead>
            <tr>
            <th style="width:20%">Exam Name</th>
            <th style="width:10%">Exam Date</th>
            <th style="width:10%"> Session</th>
              <th style="width:20%">Class</th>
              <th style="width:20%">Class Group</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
                <tbody>
                @foreach($exams as $exam)

                <tr>
                <td>{{$exam->type}}</td>
                <td>{{$exam->e_date}}</td>
                <td>{{$exam->session}}</td>
                <td>{{$exam->class}}</td>
                <td>{{$exam->department}}</td>

                <td>
                    <a title='Edit' class='btn btn-info' href='{{url("/exam/edit")}}/{{$exam->id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>
                    &nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{url("/exam/delete")}}/{{$exam->id}}'> <i class="glyphicon glyphicon-trash icon-white"></i></a> </td>
                @endforeach
           
       

        </tbody>
    </table>
</div>


@section('js')
<script>

$( document ).ready(function() {

$('#e_date_id').datetimepicker({
    timepicker: false,
    format: 'Y-m-d'
})

$('#department1').on('change',function(e){
// alert(1)
var department_id = $(this).val();
var class_id = $('#class_Create_Question')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name
}))
}) 
})
});

});

</script>
@endsection