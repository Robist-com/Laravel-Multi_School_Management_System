  <!------------------------------ Modal start from here okay-------------------------------- -->
 <div class="modal fade-center" id="generatequestion-show" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel"
aria-hidden="true" style="margin-left: 20%;">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Generate Exam Question Papers</h4>
            </div>
             <div class="modal-body">
             <div class="panel-body">
             <div class="form-group">
             <form action="{{url('/question/create')}}" method="POST" class="form">
                @csrf
                <div class="col-md-12">
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                
                <label>Exam Name <b style="color:red">*</b></label>
                <select name="q_name" id="exam_id" class="form-control select_2_single"  >
                    <option value="">---Select Exam---</option>
                    @foreach (App\Exam::where('school_id', auth()->user()->school_id)->get() as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->type }}</option>
                    @endforeach
                </select>

                 <!-- <input name="q_name" type="text" class="form-control" value="{{old('q_name')}}"  autofocus placeholder="Enter Exam Name"> -->
                 
                 </div>

                 <div class="form-group col-md-4 col-sm-4 col-xs-12">
                 
                <label>Class<b style="color:red">*</b></label>
                <select name="class_id" id="class_id" class="form-control select_2_single"  >
                    <option value="">---Select Class---</option>
                    @foreach ($classes as $classe)
                    <option value="{{ $classe->class_code }}" @if(old('class_id')==$classe->class_code) selected @endif>{{ $classe->class_name }}</option>
                    @endforeach
                </select>
                
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
            
            <label>Course<b style="color:red">*</b></label>
            <select id="course_id_question" name="course_id"  class="form-control select_2_single"  >
                <option value="">--Select Course--</option>
            </select>
            
            </div>
        <!-- </div> -->

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
            
            <label>Level<b style="color:red">*</b></label>
                <select name="level" class="form-control select_2_single">
                    <option value="">---Select a Level---</option>
                    <option value="simple" @if(old('level')=='simple') selected @endif>Quiz</option>
                    <option value="normal" @if(old('level')=='normal') selected @endif>Pre Test</option>
                    <option value="hard" @if(old('level')=='hard') selected @endif>Class Work</option>
                </select>
            
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
            
            <label>Exam Year<b style="color:red">*</b></label>
                <input type="text"   id="session_question" name="session" class="form-control datepicker2" value="{{old('session',date('Y'))}}" placeholder="Enter session Year">
            
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
            
            <label>Exam Term<b style="color:red">*</b></label>
                <input type="text" name="chapter" class="form-control" value="{{old('chapter')}}" placeholder="Enter Exam Term">
            
            </div>

            <div class="col-12" id="question">
            <div class="col-md-9 col-sm-9 col-xs-12">
            
            <label>Question<b style="color:red">*</b></label>
                    <textarea class="form-control"name="question[0]" id="question[0]" cols="30" rows="5" placeholder="write question here..." ></textarea>
            
            </div>


            <div class="form-group col-md-3 col-sm-3 col-xs-12">
            
            <label for="">Select Question Type<b style="color:red">*</b></label>
            <!-- <label>Select Question Type </label> -->
            <select name="qt[0]" id="qt-0" class="form-control select_2_single qt" required>
                <option value="">---Select a question type---</option>
                <option value="1">Theory Question</option>
                <option value="2">Multiple Choice</option>
                <option value="3">Basic Question</option>
                <option value="3">Yes / No Question</option>
            </select>
            
            </div>
            <div class="form-group form-inline col-md-3 col-sm-3 col-xs-12">
            <label for="" class="pr-2">Points:</label><input type="number" class="form-control" min="1" value="1" name="points[]" style="max-width: 100px">
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-12">
            <button type="button" class="btn btn-success btn-block btn-sm ml-1 addQuestion" onclick="addQuestion()">Add Question</button>
            </div>

            <div class="col-md-6" id="i-0" style="padding-top: 10px; display: none">
            
             <label>Correct answer<b style="color:red">*</b></label>
                    <textarea name="i[0]" type="text" class="form-control">write correct answer</textarea>
            
            </div>

            <div class="multiple-choice" id="mc-0" style="display: none">
            <label>At least one Choices<b style="color:red">*</b></label>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                        <div class="row">
            
                    
                    <div class="col-sm-3"><label>Choice 1</label><input name="mc[0][0]" type="text" class="form-control"></div>
                    <div class="col-sm-3"><label>Choice 2</label><input name="mc[0][1]" type="text" class="form-control"></div>
                    <div class="col-sm-3"><label>Choice 3</label><input name="mc[0][2]" type="text" class="form-control"></div>
                    <div class="col-sm-3"><label>Choice 4</label><input name="mc[0][3]" type="text" class="form-control"></div>
                    <div class="col-sm-3"><label>Choice 5</label><input name="mc[0][4]" type="text" class="form-control"></div>
            
            </div>
            <div class="row" style="padding-top: 10px;">
            <div class="col-md-8 col-sm-8 col-xs-12">
            
            <label>Correct choice<b style="color:red">*</b></label>
            <select name="c-mc[0]" id="c-mc[0]" class="form-control select_2_multiple">
                                    <option value="" selected disabled>Choose Correct Choice </option>
                                    <option value="1">Correct Choice 1</option>
                                    <option value="2">Correct Choice 2</option>
                                    <option value="3">Correct Choice 3</option>
                                    <option value="4">Correct Choice 4</option>
                                    <option value="5">Correct Choice 5</option>
             </select>
             
             </div>
            </div>

            </div>
        </div>

                <div class="col-md-3 col-sm-3 col-xs-12" id="tf-0" style="padding-top: 10px;  display: none">
                
                    <label>Correct answer<b style="color:red">*</b></label>
                    <input type="text" class="form-control" name="tf[0]" id="">
                
                </div>
            </div>
            </div>
            </div>
        </div>
            <div class="modal-footer ">
             <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><i class="fa fa-close"></i> close</button>
            <button type="submit" class="btn btn-dark btn-round "><i class="glyphicon glyphicon-save"></i> Create Questions </button>
        </div>
        </form>
     </div>
    </div>
</div>


@section('scripts')

<script>


</script>
@stop

