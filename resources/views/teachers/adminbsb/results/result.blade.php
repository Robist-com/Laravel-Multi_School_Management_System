<?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-users"> RESULTS</i> </h2>
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
            <div class="x_panel">
                  <div class="x_title">
                  <div class="btn-group">
                    <button type="button" class="btn bg-teal btn-round">SELECT CLASS</button>
                    <button type="button" class="btn bg-teal btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" title="Click {{$grade->class_name}} to view result card" data-placement="right" class="dropdown-item" href="{{url('teacher/gradesheet', $grade->class_code)}}">
                    <label for=""  class="active"> {{$grade->semester_name}} </label> | {{$grade->class_name}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                     
                  </div>

                  <div class="x_content">
                <div  id="wait"></div>
                    <!-- Split button -->
              
                    <h3 > @foreach ($class_assign as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b> | {{$result->class_name}} @endforeach</h3>
                
                @if(count($isGenerated) > 0)
                @include('teachers.results.table')
                @endif

                </div>
            </div>
            <div class="text-center">
            @include('flash::message')
        @include('adminlte-templates::common.errors')
            </div>
        </div>
        </div>


