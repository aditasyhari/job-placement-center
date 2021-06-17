@component('mail::message')
# Pemberitahuan

{!! $data['pesan'] !!}

@component('mail::button', ['url' => $data['url']])
Lihat
@endcomponent

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
