@extends('layouts.main')

@section('content')
   <div class="row justify-content-center">
      <div class="col-lg-5">
         {{-- Alert Flash --}}
         @if (session()->has('alert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session('alert') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
         @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ session('loginError') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
         {{-- End Alert Flash --}}
         <main class="form-signin">
            <h1 class="h3 fw-normal my-4 text-center">Please Login</h1>
            <form action="/login" method="POST">
               @csrf
               <div class="form-floating">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus value="{{ old('email') }}">
                  <label for="email">Email address</label>
                  @error('email')
                     <small class="invalid-feedback">{{ $message }}</small>
                  @enderror
               </div>
               <div class="form-floating mb-4">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                  <label for="password">Password</label>
                  @error('password')
                     <small class="invalid-feedback">{{ $message }}</small>
                  @enderror
               </div>
               <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small class="d-block mt-3 text-center">Not Registered? <a href="/register" class="text-decoration-none">Register now!</a></small>
         </main>
      </div>
   </div>
@endsection
