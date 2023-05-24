<!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ParcAutomobileStep</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('dashbordassets/css/phoenix.min.css')}}"  rel="stylesheet" id="style-default">
    <link href="{{asset('dashbordassets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <style>
      body {
        opacity: 0;
      }
    </style>

<style>
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      display: none;
    }

    .table-container {
      position: fixed;
      width: 300px;
      right: 50px;
      top: 64px;
      background-color: #fff;
      z-index: 10000;
      display: none;
    }
    
  </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        <!--les includes-->
        
       
        @include('include.conducteur.nav');




        <div class="content">

            
            <div class="container-xl px-4 mt-4">
                @if(Session::has('success'))
            
                <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                    <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                    <p class="mb-0 flex-1"> {{Session::get('success')}}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
    
                <form action="/conducteur/profil/update" method="POST"  enctype="multipart/form-data">
                    @csrf
                <hr class="mt-0 mb-4">
            
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Image de profil</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded-circle mb-2" id="profilePicture" src="{{ asset('uploads') }}/{{ $conducteur->photo }}" alt="">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <input type="file" id="uploadInput" name="photo" accept="image/png, image/jpeg" style="display: none;">
                                <button class="btn btn-primary" id="uploadButton" type="button">Upload new image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Détails du compte</div>
                            <div class="card-body">
                                
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">carte d'identité nationale</label>
                                        <input class="form-control" name="CINC" id="inputUsername" type="text" placeholder="Entrez votre CIN " value="{{$conducteur->CINC}}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Prénom   </label>
                                            <input class="form-control" name="prenom" id="inputFirstName" type="text" placeholder="Entrez votre prénom " value="{{$conducteur->prenom}}">
                                        </div>
                                        <!-- Form Group (last name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Nom</label>
                                            <input class="form-control" name="nom" id="inputLastName" type="text" placeholder="Entrez votre nom" value="{{$conducteur->nom}}">
                                        </div>
                                    </div>
                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (organization name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOrgName">Date de naissance</label>
                                            <input class="form-control" id="inputOrgName" name="date_naissance" type="text" placeholder="Entrez votre date de naissance " value="{{$conducteur->date_naissance}}">
                                        </div>
                                        <!-- Form Group (location)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLocation">Adresse</label>
                                            <input class="form-control" id="inputLocation" name="adress" type="text" placeholder="Entrez votre adress " value="{{$conducteur->adresse}}">
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Adresse e-mail</label>
                                        <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Entrez votre adresse e-mail" value="{{$conducteur->email}}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (phone number)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Numéro de téléphone</label>
                                            <input class="form-control" id="inputPhone" name="telephone" type="tel" placeholder="Entrez votre Numéro de téléphone" value="{{$conducteur->telephone}}">
                                        </div>
                                        <!-- Form Group (birthday)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputBirthday">Mot de passe</label>
                                            <input class="form-control" id="inputBirthday" type="password" name="password" placeholder="Entrez votre nouveau mot de pass" value="">
                                        </div>
                                    </div>
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Sauvegarder les modifications</button>
                                    <a href="/conducteur/dashbord/{{$matricule}}"> <button class="btn btn-primary" type="button">Annuler</button>    </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <script>
                document.getElementById('uploadButton').addEventListener('click', function() {
                    document.getElementById('uploadInput').click();
                });
            
                document.getElementById('uploadInput').addEventListener('change', function(e) {
                    var file = e.target.files[0];
                    var reader = new FileReader();
            
                    reader.onload = function(event) {
                        document.getElementById('profilePicture').src = event.target.result;
                    };
            
                    reader.readAsDataURL(file);
                });
            </script>
        <style>
            body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
            </style>            

          
          
          
          
          
            <footer class="footer">
            <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
              <div class="col-12 col-sm-auto text-center">



               
                <p class="mb-0 text-900">Thank you for creating with phoenix<span class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v1.1.0</p>
              </div>
            </div>
          </footer>



        </div>
      </div>
    </main>
    <script src="{{asset('dashbordassets/js/phoenix.js')}}"></script>
    <script src="{{asset('dashbordassets/js/ecommerce-dashboard.js')}}"></script>
  </body>

</html>