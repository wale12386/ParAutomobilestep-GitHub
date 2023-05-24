@extends('layouts.app')

@section('content')
<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <h1 class="text-centre text-multed mb-3 mt-5 ">Mot de passe oublié</h1>
        <p class="text-centre text-multed  mt-2">veuillez saisir votre adresse é-mail,vous enverra un lien pour reposer votre mot de passe</p>
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="success">
                {{Session::get('success')}}
            </div>

            @endif

        <form method="POST" action="/login/forgotpassword">
          
            @csrf
            
          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" name="email" id="form3Example3" placeholder="veuillez saisir votre adresse é-mail" class="form-control @error('email-erreur')is-invalid @enderror @error('email-success')is-valid @enderror form-control-lg"
             value="@if(Session::has('oldemail')){{Session::get('oldemail')}} @endif" placeholder="Enter a valid email address" />
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
         
                  
          </div>
       
            @if(Session::has('danger'))
            <div class="alert alert-danger text-center" role="danger">
                {{Session::get('danger')}}
            </div>

            @endif

         
         
           

          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                reposer mot de passe
            </button>
            <p class="text-centre text-multed  mt-2"> retour à <a href="{{ url('/login') }}">login</a></p>

          </div>

        </form>
      </div>
    </div>
  </div>
<br>
  <div 
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->

  </div>
@endsection