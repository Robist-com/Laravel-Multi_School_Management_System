
<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

        @include('teachers.admindefault.homework.create')
 
@else

  @include('teachers.adminbsb.homework.create')

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

$('input[type="file"]').each(function(){
  // Refs
  var $file = $(this),
      $label = $file.next('label'),
      $labelText = $label.find('input[name="edit"]'),
      labelDefault = $labelText.text();
  
  // When a new file is selected
  $file.on('change', function(event){
    var fileName = $file.val().split( '\\' ).pop(),
        tmppath = URL.createObjectURL(event.target.files[0]);
    //Check successfully selection
		if( fileName ){
            $label
        .addClass('file-ok')
        .css('background-image', 'url(' + tmppath + ')');
			$labelText.text(fileName);
           
    }else{
      $label.removeClass('file-ok');
			$labelText.text(labelDefault);
    }
  });
  
// End loop of file input elements  
});

        </script>
        @endsection
