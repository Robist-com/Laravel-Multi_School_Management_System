
             
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>
            @if($template->template == '0')
            @include('fee.admindefault.multi-fee-payment')
            @else
            @include('fee.adminbsb.multi-fee-payment')
            @endif


    @csrf


  

         