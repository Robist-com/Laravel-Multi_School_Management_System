<strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                       <form action="{{route('poststudentbalanceReport')}}" method="POST">
                           @csrf

                           @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                        @else
                        <input type="hidden" name="school_id" id="school_id" class="form-control" value="{{auth()->user()->school->id}}">
                          <br>
                        @endif
                      
                        <div class="col-md-4">
                        <label for="">Student<b style="color:red">*</b></label>
                        <select name="roll_no_balance" id="roll_no_balance" class="form-control">
                        <option value="" selected="true">---Select Student---</option>
                        @foreach($students as $key => $student)
                        <option value="{{$student->username}}" @if($student->username === request('roll_no_balance')) selected @endif>{{$student->first_name}} {{$student->last_name }}</option>
                        @endforeach
                        </select>
                        </div>

                        <div class="col-md-4">
                        <label for="">Grade<b style="color:red">*</b></label>
                        <select name="grade_id" id="grade_id" class="form-control">
                        <option value="" selected="true">---Select Grade---</option>
                        @foreach($semesters as $semester)
                        <option value="{{$semester->id}}" @if(isset($semesters)){{$semester->id == request('grade_id') ? 'selected' : '' }} @endif>{{$semester->semester_name}}</option>
                        @endforeach
                        </select>
                        <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
                        </div>

                        <div class="col-md-4">
                        <label for="">Class<b style="color:red">*</b></label>
                        <select name="class_code" id="class_id" class="form-control">
                        <option value="" selected="true">---Select Class---</option>
                        @foreach($classes as $class)
                        <option value="{{$class->class_code}}" @if(isset($classes)){{$class->class_code == request('class_code') ? 'selected' : '' }} @endif>{{$class->class_name}}</option>
                        @endforeach
                        </select>
                        </div>

                        <div class=" pull-right " style="margin-top:25px" >
                        <button type="submit" class="btn btn-dark btn-round"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>