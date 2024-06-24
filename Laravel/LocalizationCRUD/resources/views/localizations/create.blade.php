@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Localization</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('localizations.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="key" class="col-md-4 col-form-label text-md-end">Key</label>

                            <div class="col-md-6">
                                <input type="text" id="key" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autofocus>

                                @error('key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="translations" class="col-md-4 col-form-label text-md-end">Translations</label>

                            <div class="col-md-6">
                                <div id="translations">
                                    <div class="input-group mb-2">
                                        <input type="text" name="translations[keys][]" class="form-control" placeholder="Key" required>
                                        <input type="text" name="translations[values][]" class="form-control" placeholder="Value" required>
                                    </div>
                                </div>
                                <button type="button" id="add-translation" class="btn btn-secondary">Add Translation</button>

                                @error('translations')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-translation').addEventListener('click', function () {
        var container = document.getElementById('translations');
        var inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = '<input type="text" name="translations[keys][]" class="form-control" placeholder="Key" required><input type="text" name="translations[values][]" class="form-control" placeholder="Value" required>';
        container.appendChild(inputGroup);
    });

</script>
@endsection
