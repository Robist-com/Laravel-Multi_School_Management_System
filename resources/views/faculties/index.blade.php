
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('faculties.admindefault.table')
            <!-- </div> -->

            {!! Form::open(['route' => 'faculties.store']) !!}

            @include('faculties.admindefault.fields')

            {!! Form::close() !!}
 

@else

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('faculties.adminbsb.table')
            <!-- </div> -->

            {!! Form::open(['route' => 'faculties.store']) !!}

            @include('faculties.adminbsb.fields')

            {!! Form::close() !!}
 


@endif

@endsection



