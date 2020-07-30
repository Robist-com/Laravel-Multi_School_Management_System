<!-- Course Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Id:') !!}
    {!! Form::number('course_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Level Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('level_id', 'Level Id:') !!}
    {!! Form::number('level_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Shift Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('shift_id', 'Shift Id:') !!}
    {!! Form::number('shift_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Classroom Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    {!! Form::number('classroom_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Batch Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('batch_id', 'Batch Id:') !!}
    {!! Form::number('batch_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Day Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('day_id', 'Day Id:') !!}
    {!! Form::number('day_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Time Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('time_id', 'Time Id:') !!}
    {!! Form::number('time_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<!-- <div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('classSchedulings.index') !!}" class="btn btn-default">Cancel</a>
</div> -->

              

                <!-- {{--------------------------------------------------}} -->
                <!-- <div class="panel panel-default">
                    <div class="panel-heading">Class information</div>
                    <div class="panel-body" id="add-class-info">
                    
                    </div>
                </div> -->
                <!-- {{---------------------------------------------------}} -->
           

                <div class="modal fade" id="classschedule-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
            </div>
            <!-- <form action="" class="form-horizontal" id="frm-create-class" method="POST"> -->
                <!-- @csrf -->
                <input type="hidden" name="active" id="active" value="1"> 
                <input type="hidden" name="class_id" id="class_id">

                        <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
                            <div class="form-group">

                             {{----------------Classes-------------------}}  

                            <div class="col-sm-3">
                                <label for="class">Classes</label>
                                <div class="input-group col-md-3">
                                    <select class="form-control" name="class_id" id="class_id">
                                                <option value="#">Select</option>
                                                @foreach($classes as $key => $cl)
                                                    <option value="{{$cl->class_id}}">{{$cl->class_name}} / <span>{{$cl->class_code}}</span></option>
                                                @endforeach
                                    </select>
                                   
                                </div>
                            </div>

                            {{----------------ClassRoom-------------------}}  

                                <div class="col-sm-3">
                                    <label for="class">ClassRoom</label>
                                    <div class="input-group">
                                        <select class="form-control" name="classroom_id" id="classroom_id">
                                                    <option value="#">Select</option>
                                                    @foreach($classroom as $key => $c)
                                                        <option value="{{$c->classroom_id}}">{{$c->classroom_name}} / <span>{{$c->classroom_code}}</span></option>
                                                    @endforeach
                                        </select>
                                    
                                    </div>
                                </div>

                            {{----------------Academic-------------------}}  

                            <div class="col-sm-3">
                                <label for="academic-year">Academic Year</label>
                                <div class="input-group">
                                    <select class="form-control" name="academic_id" id="academic_id">
                                    <option value="#">Select</option>
                                     @foreach($academic as $key => $acd)
                                         <option value="{{$acd->academic_id}}">{{$acd->academic_year}}</span></option>
                                     @endforeach
                                    </select>
                                   
                                </div>
                            </div>

                             {{-----------------Course------------------}}  

                                <div class="col-sm-3">
                                    <label for="program">Course</label>
                                    <div class="input-group">
                                        <select class="form-control" name="course_id" id="course_id">
                                                <option value="">Select</option>
                                                @foreach($course as $key => $cour)
                                                    <option value="{{$cour->id}}">{{$cour->course_name}} __ {{$cour->course_code}}</span></option>
                                                @endforeach
                                        </select>
                                        
                                    </div>
                                </div> 

                                 {{-----------------Level------------------}}  

                                    <div class="col-sm-3">
                                        <label for="level">Level</label>
                                        <div class="input-group">
                                            <select class="form-control " name="level_id" id="level_id">                                
                                           <option value=""></option>
                                            </select>
                                           
                                        </div>
                                    </div>

                                {{-----------------Shift------------------}}  

                                    <div class="col-sm-3">
                                        <label for="shift">Shift</label>
                                        <div class="input-group">
                                            <select class="form-control" name="shift_id" id="shift_id">
                                            <option value="#">Select</option>  
                                                @foreach($shift as $key => $sh)
                                                    <option value="{{$sh->shift_id}}">{{$sh->shift}}</option>
                                                @endforeach 
                                            </select>
                                           
                                        </div>
                                    </div>

                                {{-----------------Times------------------}}  

                                    <div class="col-sm-3">
                                        <label for="time">Time</label>
                                        <div class="input-group">
                                            <select class="form-control" name="time_id" id="time_id">
                                            <option value="#">Select</option>
                                            @foreach($time as $key => $t)
                                                    <option value="{{$t->time_id}}">{{$t->time}}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>  
                                    {{-----------------Days------------------}}  

                                    <div class="col-sm-3">
                                        <label for="day">Day</label>
                                        <div class="input-group">
                                            <select class="form-control" name="day_id" id="day_id">
                                            <option value="#">Select</option>
                                                @foreach($day as $key => $d)
                                                    <option value="{{$d->day_id}}">{{$d->name}}</span></option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div> 

                                     {{-----------------Batch------------------}}  

                                    <div class="col-sm-3">
                                        <label for="batch">Batch</label>
                                        <div class="input-group">
                                            <select class="form-control" name="batch_id" id="batch_id">
                                            <option value="#">Select</option>
                                            @foreach($batch as $key => $b)
                                                    <option value="{{$b->batch_id}}">{{$b->batch}}</span></option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div> 

                               

                                 {{------------------Semester-----------------}}  

                                    <div class="col-sm-3">
                                        <label for="group">Semester</label>
                                        <div class="input-group">
                                            <select class="form-control" name="semester_id" id="semester_id">
                                            <option value="#">Select</option>
                                            @foreach($semester as $key => $semes)
                                                    <option value="{{$semes->semester_id}}">{{$semes->semester_name}} __ {{$semes->semester_code}}</span></option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div> 

                                 {{------------------Start Date-----------------}}  

                                    <div class="col-sm-3" class="datepicker">
                                        <label for="startDate">Start Date</label>
                                        <div class="input-group">
                                            <input type="text" name="start_time" id="start_date" class="form-control" required autocomplete="off">              
                                            <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div> 

                                {{----------------End Date-------------------}}  

                                    <div class="col-sm-3" class="datepicker">
                                        <label for="endDate">End Date</label>
                                        <div class="input-group">
                                        <input type="text" name="end_time" id="end_date" class="form-control" required autocomplete="off">                                                         
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div> 
                                    {{-------------------Teachers-------------------}}

                                    <div class="col-sm-3">
                                        <label for="teacher">TEachers</label>
                                        <div class="input-group">
                                            <select class="form-control" name="teacher_id" id="teacher_id">
                                            <option value="#">Select</option>
                                                @foreach($teacher as $key => $teach)
                                                    <option value="{{$teach->teacher_id}}">{{$teach->first_name}} <span> {{$teach->last_name}}</span></option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <span class="fa fa-plus" id="add-more-group"></span>
                                            </div>
                                        </div>
                                    </div> 
                                        <input type="hidden" name="status" id="status" value="1">
                                {{----------------------------}}
                                    </div>
                                    </div>
                                        <div class="modal-footer ">
                                        <button type="submit" class="btn btn-success btn-sm">Create Schedule</button>
                                        <button type="button" class="btn btn-success btn-sm btn-update-class"> Update Class</button>

                        </div>
                <!-- </form> -->
        </div>
    </div>
</div>
@section('scripts')
  <script type="text/javascript">
//{{---------------------Show Start Date-------------------}}  
   
       $('#start_date').datetimepicker({
                        format: 'YYYY-MMM-DD',
                        useCurrent: true
                    });
    //  {{----------------------------Show End Date---------------------}}  
             $('#end_date').datetimepicker({
            format:'YYYY-MMM-DD',
            useCurrent: true
        });

        $('#frm-create-class #course_id').on('change',function(e){
                    console.log(e);
                var course_id = e.target.value;
               
                    $('#level_id').empty();
             $.get('showLevel?course_id=' + course_id, function(data){  
                    
                    // console.log(data);
                    $.each(data,function(index,l){
                    $('#level_id').append('<option value"'+l.level_id+'">'+l.level+'</option>');
             }) ;
        //     //  showClassInfo();
         });
    });

        </script>
        @endsection