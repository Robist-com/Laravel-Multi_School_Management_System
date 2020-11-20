@component('mail::message')
# Introduction


Please Active School. Here are new school detail.

School Name : {{$school->name}}
School Owner : {{$school->owner->name}}

@component('mail::button', ['url' => 'admin/schools'])
Manage school
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
