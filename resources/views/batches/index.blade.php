


<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

                    @include('batches.table')

                    {!! Form::open(['route' => 'batches.store']) !!}

                    @include('batches.fields')

                    {!! Form::close() !!}
@else

        @include('flash::message')
        @include('adminlte-templates::common.errors')

                    @include('batches.table1')

                    {!! Form::open(['route' => 'batches.store']) !!}

                    @include('batches.fields')

                    {!! Form::close() !!}

@endif

@endsection



