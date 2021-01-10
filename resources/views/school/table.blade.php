
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('school.admindefault.table')
            <!-- </div> -->

@else

        @include('school.adminbsb.table')
            <!-- </div> -->


@endif

@endsection
