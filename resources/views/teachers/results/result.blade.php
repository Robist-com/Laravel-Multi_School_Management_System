@extends('layouts.app')

{{-- @include('students.table-style') --}}
@section('content')

{{-- <div class="content"> --}}
    {{-- <div class="box box-primary">

    <div class="box-body">
     <div class="row">
         @include('students.transactions.semester-transaction')
       </div>
       </div>
     </div> --}}

     <div class="content">

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <!-- Split button -->
              <div class="btn-group">
                    <button type="button" class="btn btn-danger">SELECT CLASS</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('teacher/gradesheet', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                    <h3 style="font-weight:bold; color:red"> @foreach ($class_assign as $n => $result){{$result->semester_name}}@endforeach</h3>
                
                @if(count($isGenerated) > 0)
                @include('teachers.results.table')
                @endif
                {{-- @include('teachers.results.semester-result') --}}
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>


@endsection
