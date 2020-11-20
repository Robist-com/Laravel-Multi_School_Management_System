@extends('layouts.new-layouts.app')

@section('content')
    <!-- <section class="content-header">
        
    <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
    <i class="fa fa-id-sun-o" aria-hidden="true">CLASSES IN CHARGE</i></h1>
    <a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section> -->
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

            <div class="page-title">
              <div class="title_left">
                @if(isset($all_studentDetail))
                <h3>Students In Class</h3>
                @else
                <h3>Class In Charge</h3>
                @endif
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

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      @if(isset($all_studentDetail))
                        <a href="{{url('classincharge')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-arrow" aria-hidden="true"> back </i></button></a>
                     @else
                     <a href="{{url('home')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-arrow" aria-hidden="true"> back </i></button></a>
                     @endif
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

            <div class="pull-right">
            <a href="{{url('pdf-download-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:red"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:green"></i> Excel </a>

            <a href="{{url('pdf-download-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:blue"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:default"></i> Print </a>
            </div>
         
            <div class="clearfix"></div>
            <div class="table-responsive">
            @if(isset($allStudentList))
            <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr>
            <th style="text-align:center">Class</th>
            <th style="text-align:center">Grade</th>
            <th style="text-align:center">Total Student</th>
            </tr>
            </thead>
        <tbody>
        @foreach($allStudentList as $teacher)
            <tr >
            <td>{!! $teacher->class_name !!}</td>
            <td>{!! $teacher->semester_name !!}</td>
            <td> <a href="{{url('class/students-details/'.$teacher->class_code)}}" data-toggle="tooltip" data-placement="right" title="view all student in class">{!! $teacher->total_student !!}</td></a>
            </tr>
        @endforeach
        </tbody>
    </table>

        @else
            <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr>
            <th style="text-align:center">Roll</th>
            <th style="text-align:center">Image</th>
            <th style="text-align:center">Student</th>
            <th style="text-align:center">Class</th>
            <th style="text-align:center">Grade</th>
            <th style="text-align:center">Email</th>
            <th style="text-align:center">Father Number</th>
            </tr>
            </thead>
        <tbody>
        @foreach($all_studentDetail as $teacher)
            <tr >
            <td>{!! $teacher->username!!}</td>
            <td><img src="{{asset('student_images/' . $teacher->image)}}" alt="" width="30px" srcset=""></td>
            <td>{!! $teacher->first_name .' '. $teacher->last_name !!}</td>
            <td>{!! $teacher->class_name !!}</td>
            <td>{!! $teacher->semester_name !!}</td>
            <td>{!! $teacher->email !!}</td>
            <td>{!! $teacher->father_phone !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
       @endif
       </div>
</div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

