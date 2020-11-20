<div class="page-title">
              <div class="title_left">
                <h2>Manage Grade</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @if(isset($semes))
                   <h2>Update Grade</h2>
                   @else
                   <h2>Create Grade</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('semesters.index')}}"><button  class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   @if(isset($semes))

                   {!! Form::model($semes, ['route' => ['semesters.update', $semes->id], 'method' => 'patch' , 'autocomplete' => 'off']) !!}
                   
                   @else   

                  {!! Form::open(['route' => 'semesters.store' , 'autocomplete' => 'off']) !!}

                 @endif

                 @include('semesters.fields')

                    {!! Form::close() !!}

                </div>
            </div>
            </div>

                  <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @if(isset($semes))
                   <h2>Update Grade</h2>
                   @else
                   <h2>Create Grade</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('semesters.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

    <table class="table table-striped jambo_table bulk_action" id="semesters-table">
    <thead>
        <tr class="headings">
            <th>
                <input type="checkbox" id="check-all" class="flat">
            </th>
        <th>Grade</th>
        <th>Code</th>
        <th> Duration</th>
        <th>Status</th>
        <th colspan="6" style="text-align: center;">Action</th>
        <th class="bulk-actions" colspan="6">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
        </th>
            </tr>
        </thead>
        <tbody id="accordion">

        @foreach($semesters as $key => $semester)

        <tr class="even pointer">
                          
            <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
            </td>
            <td data-toggle="tooltip" data-placement="left" title="{!! $semester->semester_description !!}">{!! $semester->semester_name !!}</td>
            <td>{!! $semester->semester_code !!}</td>
            <td>{!! $semester->semester_duration !!}</td>
            <td>
                  @if($semester->status == 'on')
                        <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                    @else
                    <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                    @endif
                
            </td>
                <td>
                    {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                    data-target="#semesterDetail-{{$key}}" data-parent="#accordion" title="View"><span class="fa fa-eye"></span></button>
                    <a data-toggle="modal" data-target="#semester_fields-modal" title="Add semester subject" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
                    <!-- --------------------------------------------------------------------------------- -->
                    <a data-toggle="modal" data-target="#semester_view_modal" 
                       data-semester_name="{!! $semester->semester_name !!}"
                      data-semester_id="{!! $semester->id !!}"  
                      data-semester_code="{!! $semester->semester_code !!}"
                     data-semester_duration="{!! $semester->semester_duration !!}" 
                      data-semester_description="{!! $semester->semester_description !!}" 
                     data-created_at="{!! $semester->created_at !!}"
                      data-updated_at="{!! $semester->updated_at !!}" 
                     class='btn btn-warning btn-xs'> 
                     <i class="glyphicon glyphicon-eye-open"></i></a>

                        <!-- <!-- ------ -->
                        <!-- SO NOW LET'S TRY IT OUT AND SEE.... -->
                        <a href="{!! route('semesters.edit', [$semester->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <tr>
            <td colspan="9" class="hiddenrow">
            </td>
        </tr>
        @endforeach
        
        </tbody>
    </table>
    </div>
</div>
</div>
</div>
</div>


@section('scripts')

<script>
  $(document).ready(function(){
// alert(1)
    
$('#semester_name').on('keyup', function() {

var randomString = function(length) {

    var text = "";

    // var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    for (var i = 0; i < length; i++) {

        text += possible.charAt(Math.floor(Math.random() * possible.length));

    }

    return text;
}

// random string length
          var random = randomString(5);
            var semester_name = $("#semester_name").val();

            if (semester_name !== '') {
                var elem = document.getElementById("semester_code").value = random + '-' + semester_name;
            } else {
                var elem = document.getElementById("semester_code").value = '';
            }
})
     
  })
</script>

@endsection
