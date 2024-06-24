@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Localization Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('localizations.create') }}"> Create New Localization</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Key</th>
            <th>Translations</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($localizations as $localization)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $localization->key }}</td>
            <td>{{ json_encode($localization->translations) }}</td>
            <td>
                <form action="{{ route('localizations.destroy',$localization->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('localizations.edit',$localization->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
