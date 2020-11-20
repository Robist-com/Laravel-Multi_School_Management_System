
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('days.table')

        {!! Form::open(['route' => 'days.store']) !!}

        @include('days.fields')

        {!! Form::close() !!}
@else

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('days.table1')

        {!! Form::open(['route' => 'days.store']) !!}

        @include('days.fields')

        {!! Form::close() !!}

@endif

@endsection







