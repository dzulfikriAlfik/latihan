@component('mail::message')
# Pendaftaran Siswa Baru

Selamat Anda telah terdaftar di SDIT Medissina Cikijing.

@component('mail::button', ['url' => 'https://instagram.com/sditmedissina'])
Klik Selengkapnya
@endcomponent

Thanks,<br>
{{ config('sekolah.title') }}
@endcomponent