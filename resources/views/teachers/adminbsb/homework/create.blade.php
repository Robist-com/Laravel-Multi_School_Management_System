
 <?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-users"> HOMEWORKS</i> </h2>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
    </div>
    <br><br>
    <div class="card">
        <div class="body">

        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Homework  </h2>
                <div class="col-md-12 row">
                <div class="btn-group pull-right">
                <!-- <a href="{{url()->previous()}}" class="btn btn-danger btn-round"> Cancel</a> -->
                    <button type="button" class="btn bg-teal btn-round">SELECT CLASS</button>
                    <button type="button" class="btn bg-teal btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                   
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('send-class-homework', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                    </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                    <div class="row">
                    </div>
                    <h3 > @if(isset($class_assign)) @foreach ($class_assign as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b>  <b>{{$result->course_name}}</b> @endforeach  @endif</h3>
                     <a href="{{url('homework-list')}}" data-toggle="tooltip" data-placement="right" title="View homework list"><button class="btn bg-teal btn-round">Homework List</button></a>
                
                </div>
            </div>
            <div class="">

            @if(isset($class_assign))
                @include('teachers.adminbsb.homework.table')
            @endif 

            </div>
        </div>
        </div>
        </div>
        </div>

