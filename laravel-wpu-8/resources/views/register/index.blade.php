@extends('layouts.main')

@section('content')
   <div class="row justify-content-center" style="margin-bottom: 100px">
      <div class="col-lg-5">
         <main class="form-registration">
            <h1 class="h3 fw-normal my-4 text-center">Registration Form</h1>
            <form action="/register" method="POST">
               @csrf
               <div class="form-floating">
                  <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Enter your name" value="{{ old('name') }}">
                  <label for="name">Name</label>
                  @error('name')
                     <small class="invalid-feedback mb-2">{{ $message }}</small>
                  @enderror
               </div>
               <div class="form-floating">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter your Username" value="{{ old('username') }}">
                  <label for="username">Username</label>
                  @error('username')
                     <small class="invalid-feedback mb-2">{{ $message }}</small>
                  @enderror
               </div>
               <div class="form-floating">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your valid email" value="{{ old('email') }}">
                  <label for="email">Email address</label>
                  @error('email')
                     <small class="invalid-feedback mb-2">{{ $message }}</small>
                  @enderror
               </div>
               <div class="form-floating mb-4">
                  <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password">
                  <label for="password">Password</label>
                  @error('password')
                     <small class="invalid-feedback mb-2">{{ $message }}</small>
                  @enderror
               </div>
               <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
            <small class="d-block mt-3 text-center">Already Registered? <a href="/login" class="text-decoration-none">Login!</a></small>
         </main>
      </div>
   </div>
@endsection
