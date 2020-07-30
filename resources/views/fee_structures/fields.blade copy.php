<style>
.input-icon{
  position: absolute;
  left: 3px;
  top: calc(50% - 0.5em); /* Keep icon in center of input, regardless of the input height */
}
input{
  padding-left: 17px;
}
.input-wrapper{
  position: relative;
}</style>

     <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
     <div class="modal fade left" id="feestructure-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-lg  modal-right modal-success1" role="document">
          <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-subscript" style="font-weight:bold;" aria-hidden="true"> Add New Fee</i></h5>
            
            </div>
            <div class="panel">
            <div class="panel-body">
            <div class="modal-body">
      <!-- Course Name Field -->
      <div class="row">
     <!-- Semester Id Field -->
    
<div class="form-group col-sm-4" >
    <select name="semester_id" id="semester_id" class="form-control select_2_single">
        <option value="0" selected="true" disabled="true">Select Semester</option>
        @foreach ($semesters as $item)
    <option value="{{$item->semester_id}}">{{$item->semester_name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-4" >
    <select name="course_id" id="course_id" class="form-control select_2_single">
        <option value="0" selected="true" disabled="true">Select Course</option>
        @foreach ($courses as $item)
    <option value="{{$item->id}}">{{$item->course_name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-4" >
    <select name="level_id" id="level_id" class="form-control select_2_single">
        <option value="0" selected="true" disabled="true">Select Level</option>
    </select>
</div>

<!-- Admissionfee Field -->

<div class="form-group col-sm-6">
    <div class="input-wrapper">
    {!! Form::text('admissionFee', null, ['class' => 'form-control','placeholder'=>'Enter Admission Fee Amount', 'style' => 'text-align:right','onkeyup'=> "NumbersOnly(event , this);", 'onfocus'=>"this.value=''"]) !!}
    <i class="fa fa-money fa-lg input-icon"></i>
</div>
</div>

<!-- Monthlyfee Field -->
<div class="form-group col-sm-6">
    <div class="input-wrapper">
    {!! Form::text('semesterFee', null, ['class' => 'form-control','placeholder'=>'Enter semester Fee Amount', 'style' => 'text-align:right', 'onkeyup'=> "NumbersOnly(event , this);", 'onfocus'=>"this.value=''"]) !!}
    <i class="fa fa-money fa-lg input-icon"></i>
</div>
<div class="countInput" id='countInput'></div>
</div>

<!-- Coursefee Field -->
<!-- <div class="form-group col-sm-6">
    <div class="input-wrapper">
    {!! Form::text('courseFee', null, ['class' => 'form-control','placeholder'=>'Enter Course Fee Amount', 'style' => 'text-align:right']) !!}
    <i class="fa fa-money fa-lg input-icon"></i>
</div>
</div> -->

<!-- Securitydeporcite Field -->
<!-- <div class="form-group col-sm-6">
    <div class="input-wrapper">
    {!! Form::text('securityDeporcite', null, ['class' => 'form-control','placeholder'=>'Enter Security Desposite Amount', 'style' => 'text-align:right']) !!}
    <i class="fa fa-money fa-lg input-icon"></i>
</div>
</div> -->

<!-- Miscellaneous Charges Field -->
<!-- <div class="form-group col-sm-6">
    <div class="input-wrapper">
    {!! Form::text('miscellaneous_charges', null, ['class' => 'form-control','placeholder'=>'Enter Miscellaneous Charges', 'style' => 'text-align:right']) !!}
    <i class="fa fa-money fa-lg input-icon"></i>
</div>
</div> -->
</div>
</div>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      {!! Form::submit('Create Course', ['class' => 'btn btn-success']) !!}
    </div>
</div>
</div>
</div>
</div>

@section('scripts')
    <script>
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

    // Regular Expression For Numbers Only Inside the Input Fields

   function NumbersOnly(e , field) {
    var val = field.value;
    var re = /^([0-9-.]+[\.]?[0-9-.]?[0-9-.]?|[0-9-.]+)$/g;
    var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;

    if (re.test(val)) {
 
    } else {
        val = re1.exec(val);
        if (val) {
            field.value = val[0];
        } else {
            field.value =''    
       }

    }
}

    </script>
@endsection