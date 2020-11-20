
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        @include('teachers.admindefault.homework.edit')
 
@else

  @include('teachers.adminbsb.homework.edit')
  @include('admins.id_cards.style')

@endif

@endsection


@section('js')
        <script type="text/javascript">

           //  Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

$(document).ready(function(){
// alert(1)
  var deleteLinks = document.querySelectorAll('#addAttendance');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                  document.getElementById("attendance_form").submit(); //form id
            }
        });
    }

})



        </script>
        @endsection
