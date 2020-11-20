
             
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>
            @if(count($data)!="0")
            @if(count($readStudentFee)!= 0)
            @if($template->template == '0')
            @include('fee.admindefault.fee-payment')
            @else
            @include('fee.adminbsb.fee-payment')
            @endif
            <input type="hidden" value="0" id="disabled">
            @endif
            @endif

    @csrf


  

         