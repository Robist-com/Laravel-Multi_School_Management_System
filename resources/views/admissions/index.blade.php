<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

<div class="clearfix"></div>

@include('flash::message')
@include('adminlte-templates::common.errors')

<div class="x_panel">
          <div class="x_title">
            <h2>Offline Admission Table </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <a href="{{route('admissions.create')}}" class="btn btn-success btn-round"  data-toggle="modal1" data-target="#batch-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Admission</i></a>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

 @include('admissions.batches-tabs.home')

 </div>
 </div>

@else

@include('admissions.batches-tabs.home1')

@endif

@endsection
