
@foreach($id_cards as $idcard)
@if($idcard->card_title == 'student_id_card')
@include('admins.id_cards.id_card')
@elseif($idcard->card_title == 'staff_id_card')
@include('admins.id_cards.staff_id_card')
@elseif($idcard->card_title == 'admit_card')
@include('admins.id_cards.admit_card')
@elseif($idcard->card_title == 'leaving_certificate')
@include('admins.id_cards.leaving_certificate')
@endif
@endforeach