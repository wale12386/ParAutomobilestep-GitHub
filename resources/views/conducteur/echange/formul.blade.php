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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashbordassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashbordassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>

<body onchange="myFunc()">
    <main class="main" id="top">
        <div class="container-fluid px-0">
            
            @include('include.conducteur.nav');





            <div class="content">

                <!--formulaire-->

                <form name="form" class="row g-3" method="POST" action="/conducteur/echange/add/{{$matricule}}" enctype="multipart/form-data">
                    

                    @csrf
                  <fieldset >
                        <legend>Caracteristique Echange</legend>

                        <div class="col-md-6 mt-4">
                            <label class="form-label" for="inputEmail4">Matrucule</label>
                            <input class="form-control" name="matricule" type="text" value="{{$matricule}}">
                            @error('matricule')
                                <div class="alert alert-danger">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-4" >
                            <label class="form-label" for="inputPassword4">Date Echange</label>
                            <input class="form-control" name="dateEch" type="text">
                            @error('dateEch')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror


                        </div>


                        


                       
                        <fieldset class="col-md-6 mt-4">
                            <legend>l'etat de voiture</legend>
                            <div class="col-md-6 mt-4" >
                                <input type="radio" id="huey" name="etat" value="accidentelle" checked>
                                <label for="huey">la voiture est accidentelle</label>
                            </div>

                            <div class="col-md-6 mt-4">
                                <input type="radio" id="dewey" name="etat" value=" non accidentelle">
                                <label for="dewey">la voiture n'est pas accidentelle</label>
                            </div>
                            @error('etat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </fieldset>
                        <div class="col-md-6 mt-4" >
                            <label class="form-label" for="inputPassword4">kilometrage</label>
                            <input class="form-control" name="kilometrage" type="text">
                            @error('kilometrage')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror


                        </div>
                        <div class="col-md-6 mt-4" >
                            <label class="form-label" for="inputPassword4">Niveau carburant</label>
                            <input class="form-control" name="niveaucarburant" type="text">
                            @error('niveaucarburant')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror


                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">conducteur1</label>
                            <select class="form-control" name="conducteur1" id="exampleFormControlTextarea1" rows="3">
                                 
                              @foreach ($conducteurs as $conducteur)
                                   
                                       <option value="{{ $conducteur->CINC }}">{{ $conducteur->nom }} {{ $conducteur->prenom }}</option>
                                  
                               @endforeach
                         
                        </select>
                          @error('conducteur1')
                          <div class="alert alert-danger">
                              {{ $message }}
              
                          </div>
                         @enderror
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">conducteur2</label>
                            <select class="form-control" name="conducteur2" id="exampleFormControlTextarea1" rows="3">
                                 
                              @foreach ($conducteurs as $conducteur)
                                  
                              
                                   
                                       <option value="{{ $conducteur->CINC }}">{{ $conducteur->nom }} {{ $conducteur->prenom }}</option>
                                  
                               @endforeach
                         
                            </select>
                          @error('conducteur2')
                          <div class="alert alert-danger">
                              {{ $message }}
              
                          </div>
                      @enderror
                          </div>
                       

                        


                        <div class="col-12 mt-4">
                            <button class="btn btn-primary"  type="submit">Envoyer</button>
                        </div>
                    </fieldset> 





                </form>

                <!-- end formulaire-->




                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>
    <script src="{{ asset('dashbordassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashbordassets/js/ecommerce-dashboard.js') }}"></script>



</body>

</html>
