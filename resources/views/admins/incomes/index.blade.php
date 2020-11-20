
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('admins.incomes.admindefault.index')
            <!-- </div> -->

@else

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        @include('admins.incomes.adminbsb.index')
            <!-- </div> -->


@endif

@endsection












