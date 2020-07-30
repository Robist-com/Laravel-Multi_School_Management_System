@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"><i class="fa fa-dashboard" aria-hidden="true"> Dashboard</i></h1>
        <h1 class="pull-right">
           <div class="pull-right" style="margin-top: -10px;margin-bottom: 5px" >
            @include('flash::message')
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

            <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-education"></i></span>
    
    <div class="info-box-content">
    <span class="info-box-text"><a style="color:black" href="{{route('admissions.index')}}"> Students</a></span>
    <span class="info-box-number">{{$studentsCount}}</span>
     </div>
         <!-- /.info-box-content -->
     </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"><a style="color:black" href="{{route('teachers.index')}}"> Teachers</a></span>
            <span class="info-box-number">{{$teachersCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-equalizer"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"><a style="color:black" href="{{route('semesters.index')}}"> Faculties</a></span>
            <span class="info-box-number">{{$facultyCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-fuchsia"><i class="glyphicon glyphicon-sound-dolby"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"><a style="color:black" href="{{route('semesters.index')}}"> Departments</a></span>
            <span class="info-box-number">{{$departmentCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gray"><i class="glyphicon glyphicon-random"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"><a style="color:black" href="{{route('semesters.index')}}"> Semester</a></span>
            <span class="info-box-number">{{$semesterCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Fees</span>
            <span class="info-box-number">{{$batchCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-lighten-1"><i class="glyphicon glyphicon-flash"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Fee Structure</span>
            <span class="info-box-number">{{$feeStructureCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-olive"><i class="glyphicon glyphicon-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Salary</span>
            <span class="info-box-number">{{$batchCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-lime"><i class="glyphicon glyphicon-refresh"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Transaction</span>
            <span class="info-box-number">{{$batchCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-compressed"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Batch</span>
            <span class="info-box-number">{{$batchCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-purple"><i class="glyphicon glyphicon-blackboard"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Classes</span>
            <span class="info-box-number">{{$classCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-signal"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Level</span>
            <span class="info-box-number">{{$levelCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-darken-4"><i class="glyphicon glyphicon-option-horizontal"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Days</span>
            <span class="info-box-number">{{$dayCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-retweet"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Shifts</span>
            <span class="info-box-number">{{$shiftCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-navy"><i class="glyphicon glyphicon-time"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Times</span>
            <span class="info-box-number">{{$timeCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for sm devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-black"><i class="glyphicon glyphicon-home"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Class Rooms</span>
            <span class="info-box-number">{{$classroomCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-teal"><i class="glyphicon glyphicon-calendar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Class Scheduled</span>
            <span class="info-box-number">{{$classschedulCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks"></i></span>

          <div class="info-box-content">
            <span class="info-box-text"> Class Assigned</span>
            <span class="info-box-number">{{$classasignCount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>


   <!-- Main content -->
   <!-- <section class="content"> -->
    <!-- Info boxes -->
    
@endsection