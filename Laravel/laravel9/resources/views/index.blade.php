<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>What's new in php8 and laravel9</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex justify-center items-center bg-yellow-300">
        <span class="p-3">What's new in Php8 and Laravel 9</span>
    </div>

    <div class="my-5 ml-5">Match : {{ $match }}</div>
    <hr>
    <div class="my-5 ml-5">
        <div>Promotor Nama : {{ $promotor["nama"] }}</div>
        <div>Promotor Umur : {{ $promotor["umur"] }}</div>
    </div>
    <hr>
    <div class="my-5 ml-5">Named Arguments : {{ $named_args }}</div>
    <hr>
    <div class="my-5 ml-5">Null safe operator : {{ $promotor2->getNullSafe()?->alamat }}</div>
    <hr>
</body>

</html>
