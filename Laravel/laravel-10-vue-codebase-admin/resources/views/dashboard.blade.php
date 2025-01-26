<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link id="css-main" href="{{ asset('admin/assets/css/codebase.min.css') }}" rel="stylesheet">

    <script src="{{ asset('admin/assets/js/codebase.app.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/js/lib/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/assets/js/pages/op_auth_signin.min.js') }}"></script> --}}

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body id="app">
    <router-view></router-view>
</body>

</html>
