@component('mail::message')
Selamat Datang di Sekolah Aisha University.
untuk lebih detailnya silahkan Klik Link Disini :

@component('mail::button', ['url' => 'muhammadashshiddiq.github.io'])
Klik Disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
