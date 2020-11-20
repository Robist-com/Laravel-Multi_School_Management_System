@include('table_style')

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="active"><a href="#semester1" role="tab" data-toggle="tab">SEMESTER 1</a></li>
  <li><a href="#semester2" role="tab" data-toggle="tab">SEMESTER 2</a></li>
  <li><a href="#semester3" role="tab" data-toggle="tab">SEMESTER 3</a></li>
  <li><a href="#semester4" role="tab" data-toggle="tab">SEMESTER 4</a></li>
  <li><a href="#semester5" role="tab" data-toggle="tab">SEMESTER 5</a></li>
  <li><a href="#semester6" role="tab" data-toggle="tab">SEMESTER 6</a></li>
  <li><a href="#semester7" role="tab" data-toggle="tab">SEMESTER 7</a></li>
  <li><a href="#semester8" role="tab" data-toggle="tab">SEMESTER 8</a></li>
</ul>



<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade in active" id="semester1">
  	SEMESTER 1
      @include('semesters.semester-tabs1.semester1')
  </div>


<div class="tab-pane" id="semester2">
  	SEMESTER 2
      @include('semesters.semester-tabs1.semester2')
  </div>
  <div class="tab-pane" id="semester3">
  	SEMESTER 3
      @include('semesters.semester-tabs1.semester3')
  </div>

  <div class="tab-pane" id="semester4">
  	SEMESTER 4
      @include('semesters.semester-tabs1.semester4')
  </div>

  <div class="tab-pane" id="semester5">
  	SEMESTER 5
      @include('semesters.semester-tabs1.semester5')
  </div>

  <div class="tab-pane" id="semester6">
  	SEMESTER 6
      @include('semesters.semester-tabs1.semester6')
  </div>

  <div class="tab-pane" id="semester7">
  	SEMESTER 7
      @include('semesters.semester-tabs1.semester7')
  </div>

  <div class="tab-pane" id="semester8">
  	SEMESTER 8
      @include('semesters.semester-tabs1.semester8')
  </div>
  </div>
</div>
</div>
<!-- ------------------------------------------------HERE WILL BE OUR MODAL PART-------------------------- -->


<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>


<!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="semester_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="semester_id" id="semester_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- batch Field -->
            <div class="form-group">
                {!! Form::label('semester_id', 'Semester Id:') !!}
               <input type="text" name="semester_id" id="semester_id" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester name', 'Semester Name:') !!}
               <input type="text" name="semester_name" id="semester_name" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester code', 'Semester Code:') !!}
               <input type="text" name="semester_code" id="semester_code" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester duration', 'Semester Duration:') !!}
               <input type="text" name="semester_duration" id="semester_duration" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester description', 'Semester Description:') !!}
               <input type="text" name="semester_description" id="semester_description" readonly>
            </div>
            
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <input type="text" name="created_at" id="created_at" readonly>
            </div>

            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <input type="text" name="updated_at" id="updated_at" readonly>
            </div>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!} -->
      </div>
    </div>
  </div>
  </div>
  </div>


  @section('scripts')

    <script>
    // {{-----------Level view Side------------------}} 
$('#semester_view_modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var semester_name = button.data('semester_name')
var semester_code = button.data('semester_code')
var semester_duration = button.data('semester_duration')
var semester_description = button.data('semester_description')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var semester_id = button.data('semester_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW SEMESTER INFORMATION');
modal.find('.modal-body #semester_name').val(semester_name);
modal.find('.modal-body #semester_code').val(semester_code);
modal.find('.modal-body #semester_duration').val(semester_duration);
modal.find('.modal-body #semester_description').val(semester_description);
// modal.find('.modal-body #semester_year').val(semester_year); // HERE IS OUR ERROR OKAY
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #semester_id').val(semester_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let semesterId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('semesters/status/update') }}',
            data: {'status': status, 'semester_id': semesterId},
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

$('#course_id').on('change',function(e){
                var course_id = $(this).val();
                var level = $('#level_id')
                    $(level).empty();
             $.get("{{ route('dynamicLevels') }}",{course_id:course_id},function(data){  
                    
                    console.log(data);
                    $.each(data,function(i,l){
                    $(level).append($('<option/>',{
                        value : l.level_id,
                        text  : l.level
               }))
             }) 
         })
    })

     
    
    
    </script>




  @endsection