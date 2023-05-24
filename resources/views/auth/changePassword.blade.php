@extends('layouts.app')

@section('content')
<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <h1>Changer le mot de passe</h1>
    
       <form method="POST" action="/login/changePassword">
           @csrf
           
           <input type="hidden" name="token" value="{{ $token }}">
           @if(Session::has('danger'))
           <div class="alert alert-danger text-center" role="danger">
               {{Session::get('danger')}}
           </div>

           @endif
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Nouveau mot de passe</label>
            <input type="password" name="password" id="form3Example3" placeholder="veuillez saisir votre nouveau mot de passe" class="form-control @error('email-erreur')is-invalid @enderror @error('email-success')is-valid @enderror form-control-lg"
              />
              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
         
                  
          </div>
          
           
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3"> Confirmer le nouveau mot de passe</label>
            <input type="password" name="confirmerpassword" id="form3Example3" placeholder="veuillez confirmer votre nouveau mot de passe" class="form-control @error('email-erreur')is-invalid @enderror @error('email-success')is-valid @enderror form-control-lg"
              />
              @error('confirmerpassword')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
         
                  
          </div>
           <div class="col-md-8 offset-md-4">
            <a href="{{ url('/login') }}">
            <button type="submit" class="btn btn-primary">
                Changer le mot de passe            </button>
            </a>
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