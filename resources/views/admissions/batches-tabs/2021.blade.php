<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th>
            <input type="checkbox" id="check-all" class="flat">
        </th>
        <th class="column-title">Image</th>
        <th class="column-title">Full Name</th>
        <th class="column-title">Student Group</th> 
        <th class="column-title">Class Group</th> 
        <th class="column-title">Batch</th> 
        <th class="column-title">Gender</th>
        <th class="column-title">Status</th>
        <th class="column-title no-link last"><span class="nobr">Action</span>
        <th class="bulk-actions" colspan="8">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
        </th>
      </tr>
  </thead>
  <tbody>
  @foreach($admissions as $key => $admission) 
  @if($admission->batch_id == 6)
  <tr class="even pointer">
        <td class="a-center ">
        <input type="checkbox" class="flat" name="table_records">
        </td>
      <td><img src="{{asset('student_images/'.$admission->image)}}" alt=""
          class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
      <td>{!! $admission->first_name !!} {!! $admission->last_name !!}</td>

      <div id="wait" style="display:none;width:69px;height:89px;border:none 
      solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
      <img src="{{asset('images/loading.gif')}}"
      width="64" height="64" /><br>Loading..</div>

      <td>{!! $admission->faculty_name !!}</td>
      <td>{!! $admission->department_name !!}</td>
      <td>{!! $admission->batch !!}</td>

      <td>
        <i class="badge badge" type="button">@if($admission->gender == 1) Male @else  Female @endif</i>  
      </td>
      <!-- <td>@if($admission->gender == 1) Male @else  Female @endif</td> -->
      <!-- <td>@if($admission->status == 1) Active @else Inactive @endif</td> -->
      <td style="text-align:center1">
                @if($admission->status == 1) Active @else  In Active @endif
      </td>
     
     
          <td>
              {!! Form::open(['route' => ['admissions.destroy', $admission->id], 'method' => 'delete']) !!}
              <div class='btn-group'>
              <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
              data-target="#demo{{$key}}" title="View"><span class="fa fa-eye"></span></button>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
              {!! Form::close() !!}
          </td>
      </tr>
      <tr>
      <td colspan="9" class="hiddenrow">
          @include('admissions.details')
      </td>
  </tr>
  @endif
  @endforeach
  </tbody>
</table>
</div>