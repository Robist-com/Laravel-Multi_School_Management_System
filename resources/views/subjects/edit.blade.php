@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1 class="pull-left">Subject List</h1>
        <h1 class="pull-right">
           <a type="button" data-toggle="modal" data-target="#modal-role" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" >Add Role</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
      @if($message = Session::get('success'))
      <div class="alert-success">
        <p>{{$message}}</p>
      </div>
      @endif
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                    @if (isset($subject))
                <form role="form" action="{{url('/subject/update')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="id" value="{{$subject->id }}">
                   <div class="row">
                     <div class="col-md-12">
                       <div class="col-md-4">
                         <div class="form-group">
                                 <input type="text" class="form-control" required name="code" value="{{$subject->code}}" placeholder="Subject Code">
                             </div>
                         </div>
                       <div class="col-md-4">
                         <div class="form-group">
                                 <input type="text" class="form-control" required name="name" value="{{$subject->name}}" placeholder="Subject Name">
                             </div>
                         </div>
                       <div class="col-md-4" style="display:none">
                         <div class="form-group">
                                 {{ Form::select('type',['Core'=>'Core','Comprehensive'=>'Comprehensive','Electives'=>'Electives'],$subject->type,['class'=>'form-control'])}}
                         </div>
                     </div>

                    </div>
                   </div>

                   <div class="row">
                     <div class="col-md-12">
                         <div class="col-md-2" style="display:none">
                             <div class="form-group">
                                 <label class="control-label" for="stdgroup">Subject Group <b>*</b></label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                     {{ Form::select('subgroup',['N/A'=>'N/A','Bangla'=>'Bangla','English'=>'English'],$subject->subgroup,['class'=>'form-control select_2_single'])}}
                                 </div>
                             </div>
                         </div>
                   <div class="col-md-3">
                     <div class="form-group">
                               {{ Form::select('stdgroup',['N/A'=>'N/A','Science'=>'Science','Arts'=>'Arts','Commerce'=>'Commerce'],$subject->stdgroup,['class'=>'form-control select_2_single'])}}
                           </div>
                   </div>
                     <div class="col-md-4">
                           <div class="form-group">
                              {{ Form::select('class',$classes,$subject->class,['class'=>'form-control select_2_single'])}}
                            </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                           <select name="gradeSystem" class="form-control select_2_single">
                            {{-- @if($subject->gradeSystem=="1")
                             <option value="1" selected>100 Marks </option>
                             <option value="2">50 Marks </option>
                           @else
                             <option value="1">100 Marks </option>
                             <option value="2" selected>50 Marks </option>
                           @endif --}}

                            @if($gpa)
                             @foreach($gpa as $gp)
                              <option  value="{{$gp->for}}" @if($subject->gradeSystem==$gp->for) selected @endif> @if($gp->for=="1") 100 Marks @elseif($gp->for=="3") 75 Marks  @elseif($gp->for=="2") 50 Marks  @elseif($gp->for=="4") 30 Marks  @elseif($gp->for=="5") 25 Marks  @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8") 10 Marks @endif </option>
                              <!--<option value="2">50 Marks </option>-->
                            @endforeach
                            @endif

                           </select>
                       </div>
                   </div>
                 </div>
               </div>
<div style="display:none">
               <div class="row">
                 <div class="col-md-12">
                     <h3 class="text-info">Exam Details</h3>
                     <hr>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-12">
                     <div class="col-md-3"></div>
               <div class="col-md-3">
                 <label>Full Marks</label>
               </div>
                 <div class="col-md-1"></div>
               <div class="col-md-3">
               <label>Pass Marks</label>
               </div>
                 <div class="col-md-2"></div>
               </div>
              </div>
                <div class="row">
                <div class="col-md-12">
 <div class="col-md-2"></div>
              <div class="col-md-4">
                       <div class="form-group">
                     <label for="totalfull" class="col-md-3 control-label">Total: </label>
                       <div class="col-md-3">
                           <input type="text" class="form-control" value="{{$subject->totalfull}}" required="true" name="totalfull"  placeholder="0">
                           </div>
                           </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
              <label for="totalpass" class="col-md-3 control-label">Total: </label>
                <div class="col-md-3">
                    <input type="text" class="form-control" value="{{$subject->totalpass}}" name="totalpass"  placeholder="0">
                    </div>
                    </div>
              </div>
 <div class="col-md-2"></div>
              </div>
             </div>
             <div class="row">
               <div class="col-md-12">
 <div class="col-md-2"></div>
             <div class="col-md-4">
                      <div class="form-group">
                    <label for="wfull" class="col-md-3 control-label">Written: &nbsp;</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" value="{{$subject->wfull}}" name="wfull" required="true"  placeholder="0">
                          </div>
                          </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
             <label for="wpass" class="col-md-3 control-label">Written: &nbsp;</label>
               <div class="col-md-3">
                   <input type="text" class="form-control" value="{{$subject->wpass}}" name="wpass"  placeholder="0">
                   </div>
                   </div>
             </div>
 <div class="col-md-2"></div>
             </div>
            </div>
            <div class="row">
              <div class="col-md-12">
 <div class="col-md-2"></div>
            <div class="col-md-4">
                     <div class="form-group">
                   <label for="mfull" class="col-md-3 control-label">MCQ: </label>
                     <div class="col-md-3">
                         <input type="text" class="form-control" value="{{$subject->mfull}}" name="mfull" required="true" placeholder="0">
                         </div>
                         </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
            <label for="mpass" class="col-md-3 control-label">MCQ: </label>
              <div class="col-md-3">
                  <input type="text" class="form-control"  value="{{$subject->mpass}}" name="mpass"  placeholder="0">
                  </div>
                  </div>
            </div>
 <div class="col-md-2"></div>
            </div>
           </div>
           <div class="row">
             <div class="col-md-12">
 <div class="col-md-2"></div>
           <div class="col-md-4">
                    <div class="form-group">
                  <label for="sfull" class="col-md-3 control-label">SBA: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="sfull" value="{{$subject->sfull}}" required="true" placeholder="0">
                        </div>
                        </div>
           </div>
           <div class="col-md-4">
             <div class="form-group">
           <label for="spass" class="col-md-3 control-label">SBA: </label>
             <div class="col-md-3">
                 <input type="text" class="form-control" name="spass" value="{{$subject->spass}}"  placeholder="0">
                 </div>
                 </div>
           </div>
 <div class="col-md-2"></div>
           </div>
          </div>
          <div class="row">
            <div class="col-md-12">
          <div class="col-md-2"></div>
          <div class="col-md-4">
                   <div class="form-group">
                 <label for="pfull" class="col-md-3 control-label">Practical:&nbsp; </label>
                   <div class="col-md-3">
                       <input type="text" class="form-control" name="pfull" value="{{$subject->pfull}}" required="true"  placeholder="0">
                       </div>
                       </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
          <label for="ppass" class="col-md-3 control-label">Practical:&nbsp;</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="ppass" value="{{$subject->ppass}}"  placeholder="0">
                </div>
                </div>
          </div>
          </div>
          <div class="col-md-2"></div>
          </div>
          </div>

               <div class="row">
               <div class="col-md-12">

                   <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-check"></i> Update</button>

                 </div>
               </div>
                 </form>
                 </div>
        </div>
        <div class="text-center">

      
        </div>
    </div>

                @else
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>There is no such Subject!<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                         @endif

@stop
