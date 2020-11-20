@component('mail::message')

Congradulation 

The body of your message.

your school is now activated!

@component('mail::button', ['url' => route('school.show', $school->id)])
Visit your school
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
