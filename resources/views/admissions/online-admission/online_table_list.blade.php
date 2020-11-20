
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ONLINE ADMISSIONS TABLE</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                      <tr class="headings">
                        <!-- <th width="50px"><input type="checkbox" id="master" style="display:none"></th> -->
                        <th style="width:50px;">Roll No.</th>
                        <th>Department</th>
                        <th>Class</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!-- <th>Date of Birth</th> -->
                        <th>Reg Date</th>
                        <th>Phone</th>
                        <th class="column-title no-link last"><span class="nobr">Action</span>
                      <th class="bulk-actions" colspan="8">
                          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                      </tr>
                    </thead>

                    <tbody id="items">
                    @foreach ($allStudentList as $key => $student)
                    <!-- <tr id="tr_{{$student->id}}" class="contact"> -->
                    <tr class="even pointer">
                      <!-- <td><input type="checkbox" class="sub_chk" data-id="{{$student->id}}"></td> -->
                      <td>{{$student->username}}</td>
                      <td>{{$student->department_name}}</td>
                      <td>{{$student->class_name}}</td>
                      <td>{{$student->first_name ." ". $student->last_name}}</td>
                      <td align="center">
                    <div id="ck-button-present">
                  
                    <label>
                    <input style="cursor:pointer;" class="atten" type="radio"id="acceptance" name="acceptance[{{$student->student_id}}]" @if ($student->acceptance == 'pending') checked @endif value="pending" />
                    <span style="font-size:12px">pending</span>
                    </label>
                    </div>
                    </td>
                    
                    <td align="center">
                    <div id="ck-button-absent">
                    <label>
                    <input class="atten" type="radio"id="acceptance" name="acceptance[{{$student->student_id}}]" @if ($student->acceptance == 'reject') checked @endif value="reject" />
                    <span>reject</span>
                    </label>
                    </div>
                    </td>
                    
                    <td align="center">
                    <div id="ck-button-late">
                    <label>
                    <input class="atten" type="radio"id="acceptance" name="acceptance[{{$student->student_id}}]" @if ($student->acceptance == 'accept') checked @endif value="accept" />
                    <span>accept</span>
                    </label>
                    </div>
                    </td>
                    
                      <td>{{date('Y-m-d', strtotime($student->dateregistered))}}</td>
                      <td>{{$student->phone}}</td>
                      <td >
                        {!! Form::open(['route' => ['admissions.destroy', $student->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                      
                        <!-- <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn btn-success  btn-xs" title="Pay Fee"><i class="fa fa-usd"></i></a> -->
                        <!-- <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn btn-warning  btn-xs" title="Promote Student"><i class="far fa-paper-plane"></i></a> -->
                      
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        <a href="{{route('admissions.edit', [$student->student_id])}}"  class="btn btn-primary btn-xs " title="Edit"> <span class="fa fa-edit"></span></button></a>
                        </div>
                        {!! Form::close() !!}
                      </td>
                      
                    </tr>
                    @endforeach
                </tbody>
                      
                    </table>
                  </div>
                </div>
              </div>
        </div>
