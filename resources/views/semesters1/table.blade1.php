@include('table_style')


<div id="myDiv" class="container">
			<!-- <h2>SEMESTER DETAIL</h2> -->

			<div id="myDiv">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">SEMESTER 1</a></li>
					<li><a data-toggle="tab" href="#menu1">SEMESTER 2</a></li>
					<li><a data-toggle="tab" href="#menu2">SEMESTER 3</a></li>
                    <li><a data-toggle="tab" href="#menu3">SEMESTER 4</a></li>
                    <li ><a data-toggle="tab" href="#menu4">SEMESTER 5</a></li>
                    <li ><a data-toggle="tab" href="#menu5">SEMESTER 6</a></li>
                    <li ><a data-toggle="tab" href="#menu6">SEMESTER 7</a></li>
                    <li ><a data-toggle="tab" href="#menu7">SEMESTER 8</a></li>
				</ul>

                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#filter">Monday</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#filter1">Tuesday</a></li>
                <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#filter2">Wednesday</a></li>
                <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#filter3">Thursday</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#filter4">Friday</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#filter5">Sturday</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#filter6">Sunday</a></li>
                </ul>
                <br>
					<div id="filter" class="tab-pane fade">

                    </div>
				<div class="tab-content">

				<div id="home" class="tab-pane fade in active">
			    <h3 style="font-weight:bold; color:red">SEMESTER 1</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester1')
				</div>
				<div id="menu1" class="tab-pane fade">
				<h3 style="font-weight:bold; color:red">SEMESTER 2</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester2')
				</div>
				<div id="menu2" class="tab-pane fade">
				<h3 style="font-weight:bold; color:red">SEMESTER 3</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester3')
	            </div>
	            <div id="menu3" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">SEMESTER 4</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester4')
				</div>
                <div id="menu4" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">SEMESTER 5</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester5')
				</div>
                <div id="menu5" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">SEMESTER 6</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester6')
				</div>
                <div id="menu6" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">SEMESTER 7</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester7')
				</div>
                <div id="menu7" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">SEMESTER 8</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester8')
		        </div>
		</div>
	</div>
	</div>
	</div>
  @include('semesters.show_fields')
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