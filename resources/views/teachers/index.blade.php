@extends('layouts.new-layouts.app')

@section('content')
 
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

    <div class="page-title">
              <div class="title_left">
                <h3>OFFLINE <small> ADMISSION</small></h3>
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

        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Student</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a data-toggle="modal" data-target="#teacher-add-modal" class="btn btn-success btn-round pull-right" ><i class="fa fa-plus-circle"> Add New Teacher</i></a>
                      <a href="{{route('teachers.create')}}" data-toggle="modal1" data-target="#teacher-add-modal1" class="btn btn-success btn-round pull-right" ><i class="fa fa-plus-circle"> Create New Teacher</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div class="clearfix"></div>

                    @include('teachers.table')
                    @include('teachers.excel')
                    
                    {{-- {!! Form::open(['route' => 'teachers.store']) !!} --}}
                <form action="{{route('teachers.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                     @include('teachers.fields')

            </form>
            </div>
        </div>
        </div>
        <!-- </div>
        </div> -->
       
@endsection
