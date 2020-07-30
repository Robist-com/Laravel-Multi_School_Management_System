@extends('layouts.frontLayout.app')

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
                    @include('students.transactions.semester-transaction')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>


@endsection
