@extends('layouts.app')
<!-- @section('title','Student Report') -->
@section('content')

<style>
    caption{
        height: 50px;
        font-size: 20px;
        font-weight: bold;
        color: #00A0DF;
    }
</style>
{{--------------------------}}

<div class="row">
    <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Teacher List</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                <li><i class="icon_document_alt"></i>Report /</li>
                <li><i class="fa fa-file-text-o"></i>Teacher List</li>
            </ol>
    </div>
</div>

{{--------------------------}}

<div class="panel panel-default">
        <div class="panel-heading">
            <b><i class="fa fa-info"></i>Teacher Multi Report</b>
            <a href="#" class="pull-right" id="show-class-info"><i class="fa fa-plus"></i></a>
        </div>
        <p style="text-align:center; font-size: 20px; font-weight:bold">TEACHER REPORT LIST </p>
        <div class="panel-body" style="padding-bottom:4px;">
                <div class="show-student-info">
                
                </div>
        </div>
</div>
<!-- ================================================================================== -->

<style>
.modal-lg {
    max-width: 80% !important;
}
</style>
<div class="modal fade" id="choose-academic" tabindex="-1" role="dialog">
<div class="modal-dialog " style="width:90%">
            
<section class="panel panel-default">
                <header class="panel-heading">
                   Choose Academic
                </header>
                <form action="#" class="form-horizontal" id="frm-view-class" method="POST">
                @csrf
                        <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
                            <div class="form-group">


                            {{----------------ClassRoom-------------------}}  

                            <div class="col-sm-3">
                                <label for="class">ClassRoom</label>
                                <div class="input-group">
                                    <select class="form-control" name="classroom_id" id="classroom_id">
                                                @foreach($classroom as $key => $c)
                                                    <option value="{{$c->classroom_id}}">{{$c->classroom_name}} / <span>{{$c->classroom_code}}</span></option>
                                                @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus" id="add-more-classroom"></span>
                                    </div>
                                </div>
                            </div>
                             {{----------------Academic-------------------}}  

                            <div class="col-sm-3">
                                <label for="academic-year">Academic Year</label>
                                <div class="input-group">
                                    <select class="form-control" name="academic_id" id="academic_id">
                                                @foreach($academics as $key => $y)
                                                    <option value="{{$y->academic_id}}">{{$y->academic}}</option>
                                                @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus" id="add-more-academic"></span>
                                    </div>
                                </div>
                            </div>

                             {{-----------------Program------------------}}  

                                <div class="col-sm-3">
                                    <label for="program">Course</label>
                                    <div class="input-group">
                                        <select class="form-control" name="program_id" id="program_id">
                                                <option value="">Select</option>
                                                @foreach($programs as $key => $p)
                                                    <option value="{{$p->program_id}}">{{$p->program}}</option>
                                                @endforeach
                                        </select>
                                        <div class="input-group-addon">
                                            <span class="fa fa-plus" id="add-more-program"></span>
                                        </div>
                                    </div>
                                </div> 

                                 {{-----------------Level------------------}}  

                                    <div class="col-sm-3">
                                        <label for="level">Level</label>
                                        <div class="input-group">
                                            <select class="form-control" name="level_id" id="level_id">                                
                                            
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-level"></span>
                                            </div>
                                        </div>
                                    </div>

                                {{-----------------------------------}}  

                                    <div class="col-sm-3">
                                        <label for="shift">Shift</label>
                                        <div class="input-group">
                                            <select class="form-control" name="shift_id" id="shift_id">
                                                    @foreach($shift as $key => $shf)
                                                        <option value="{{$shf->shift_id}}">{{$shf->shift}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-shift"></span>
                                            </div>
                                        </div>
                                    </div>

                                {{-----------------------------------}}  

                                    <div class="col-sm-3">
                                        <label for="time">Time</label>
                                        <div class="input-group">
                                            <select class="form-control" name="time_id" id="time_id">
                                                @foreach($time as $t)
                                                    <option value="{{$t->time_id}}">{{$t->time}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-time"></span>
                                            </div>
                                        </div>
                                    </div>  

                                    {{-----------------------------------}}  

                                    <div class="col-sm-3">
                                        <label for="day">Day</label>
                                        <div class="input-group">
                                            <select class="form-control" name="day_id" id="day_id">
                                                @foreach($days as $day)
                                                    <option value="{{$day->day_id}}">{{$day->days}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-day"></span>
                                            </div>
                                        </div>
                                    </div>  

                                {{-----------------------------------}}  

                                    <div class="col-sm-3">
                                        <label for="batch">Batch</label>
                                        <div class="input-group">
                                            <select class="form-control" name="batch_id" id="batch_id">
                                                 @foreach($batch as $b)
                                                    <option value="{{$b->batch_id}}">{{$b->batch}}</option>
                                                 @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-batch"></span>
                                            </div>
                                        </div>
                                    </div> 

                                    {{-----------------------------------}}  

                                    <div class="col-sm-3">
                                        <label for="teacher">Teacher</label>
                                        <div class="input-group">
                                            <select class="form-control" name="teacher_id" id="teacher_id">
                                                @foreach($teachers as $t)
                                                    <option value="{{$t->teacher_id}}">{{$t->first_name}} <span> {{$t->last_name}}</span></option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-teacher"></span>
                                            </div>
                                        </div>
                                    </div> 
                                {{----------------------------}}
                                    </div>
                                    </div>
                </form>

                <!-- {{--------------------------------------------------}} -->
                <form action="#" method="get" id="frm-multi-class">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Class information
                        <button type="button" id="btn-go" class="btn btn-info btn-xs pull-right"
                         style="margin-top:5px;">Go</button>
                    </div>
                    <div class="panel-body" id="add-class-info" style="overflow-y:auto; height:250px;">
                    
                    </div>
                </div>
                </form>
                <!-- {{---------------------------------------------------}} -->
    </section>

    </div>
</div>



<!-- =========================================================================== -->
@endsection

@section('scripts')
        <script type="text/javascript">
  
        //---------------------Academic Id On change----------------
            $('#academic_id').on('change',function(e){
                showClassInfo();
            })
        //--------------------- Level Id On change----------------
            $('#level_id').on('change',function(e){
                showClassInfo();
            })
             //--------------------- Level Id On change----------------
             $('#shift_id').on('change',function(e){
                showClassInfo();
            })
             //--------------------- Level Id On change----------------
             $('#time_id').on('change',function(e){
                showClassInfo();
            })
            //--------------------- Day Id On change----------------
            $('#day_id').on('change',function(e){
                showClassInfo();
            })
             //--------------------- Level Id On change----------------
             $('#batch_id').on('change',function(e){
                showClassInfo();
            })
             //--------------------- Level Id On change----------------
             $('#group_id').on('change',function(e){
                showClassInfo();
            })
       //--------------------- Level Id On change----------------
        $('#frm-view-class #program_id').on('change',function(e){
            var program_id = $(this).val();
            var level = $('#level_id')
            $(level).empty();
            $.get("{{url('showLevel')}}", {program_id:program_id},function(data){
                $.each(data,function(i,l){
                    $(level).append($("<option/>",{
                        value : l.level_id,
                        text : l.level
                    }))
                })
                showClassInfo();
            })
        })
        $('#show-class-info').on('click',function(e){
            e.preventDefault();
            showClassInfo();
            $('#choose-academic').modal('show');
        })
            function showClassInfo()
            {
                var data =$('#frm-view-class').serialize();
                $.get("{{ url('showClassInformation')}}",data,function(data){
                    $('#add-class-info').empty().append(data);
                    $('td#hidden').addClass('hidden');
                    $('th#hidden').addClass('hidden');
                    // MargeCommonRows($('#table-class-info'));
                })
            }

        $(document).on('click','#btn-go',function(e){
            e.preventDefault();
            data = $('#frm-multi-class').serialize();
            $.get("{{ route('showTeacherMultiClassList') }}",data,function(data){
                // console.log(data);
                  $('.show-student-info').empty().append(data);
            })
        })
        //----------------- Check all --------------------
        $(document).on('click','#checkall',function(){
            $(':checkbox.chk').prop('checked',this.checked);
        })
</script>
@endsection