@extends('layout.layout')

@section('title', $foo)

@section('content')
<h1>Home Page</h1>
<h2>Items</h2>
<ul>
    @foreach ($tasks as $task)
    <li> {{ $task }} </li>
    @endforeach
</ul>
@endsection

