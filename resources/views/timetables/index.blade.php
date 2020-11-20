
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        <div class="clearfix"></div>

        @include('timetables.admindefault.timetable')
            <!-- </div> -->
            @include('timetables.teacher_timetable')
 

@else

       

        @include('timetables.adminbsb.timetable')

        @include('timetables.teacher_timetable')
            <!-- </div> -->


@endif

@endsection
