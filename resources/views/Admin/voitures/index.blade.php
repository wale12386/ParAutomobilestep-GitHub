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

            @include('include.admin.sidebare');
            @include('include.admin.nav',['searchRoute'=>route('voiture.search')]);





            <div class="content">
                <h1>Liste Voitures</h1>
                <hr>

                <a href="/admin/voiture/add" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter voiture</button>
                </a>
@if(Session::has('success'))
<div class="alert alert-soft-success d-flex align-items-center" role="alert">
    <span class="fas fa-check-circle text-success fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{Session::get('success')}}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

            @endif
          


                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center">#</th>
                            <th scope="col" style="text-align:center">Matricule</th>
                            <th scope="col" style="text-align:center">photo</th>
                            <th scope="col" style="text-align:center">couleur</th>
                            <th scope="col" style="text-align:center">GPS</th>
                            <th scope="col" style="text-align:center">1ere cerculation</th>
                            <th scope="col" style="text-align:center">Marque</th>
                            <th scope="col" style="text-align:center">Modele</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voitures as $index => $c)
                       
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $c->matricule }}</td>
                                <td>
                                    <img src="{{ asset('uploads') }}/{{ $c->photo }}" alt="" width="100px">

                                </td>
                                <td>{{ $c->couleur }}</td>
                                <td>{{ $c->GPS }}</td>

                                <td>
                                    @if ($c->Date_1ere_cerculation)
                                        {{ $c->Date_1ere_cerculation }}
                                    @endif
                                </td>
                                <td>{{ $c->marques->libellemarque }}</td>
                                <td>{{ $c->modele->libellemodele }}</td>

                                <td>

                                    <a onclick="return confirm('voulez-vous vraiment archiver cette voiture avec tout leur donne ')" href="/admin/voiture/{{ $c->matricule }}/delete">
                                        <img src="{{ asset('dashbordassets/img/voiture/archive.png') }}"
                                            alt="supprimer" width="30px">
                                    </a>
                                    <a data-bs-toggle="modal" data-bs-target="#modifiervoiture{{$c->matricule}}">
                                        <img src="{{ asset('dashbordassets/img/voiture/modifier.png') }}"
                                            alt="modifier" width="30px">
                                    </a>
                                    <a  href="/admin/voiture/{{ $c->matricule }}/affecter">
                                        <button  type="button" class="btn btn-light"> Affecter</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>



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

 <!--modal pour la modification--> 
 @foreach ($voitures as $index => $c )
 <div class="modal fade" id="modifiervoiture{{$c->matricule}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier les information de voiture {{$c->matricule}}</h5>
        <img src="{{ asset('uploads') }}/{{ $c->photo }}" alt="" width="100px">

        <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
      </div>
      <div class="modal-body">
         
        <form action="/admin/voiture/update" method="POST"  enctype="multipart/form-data">
                   
          @csrf
       <fieldset >
        
          <legend>Caracteristique voiture</legend>
          

              <div class="col-md-6 mt-4">
                  <label class="form-label" >Matrucule</label>
                  <input class="form-control" name="matricule" type="text" value="{{$c->matricule}}">
                  @error('matricule')
                      <div class="alert alert-danger">
                          {{ $message }}

                      </div>
                  @enderror
              </div>
            
              <div class="col-md-6 mt-4" >
                  <label class="form-label" >Date de première mise en circulation:</label>
                  <input class="form-control" name="Date_1ere_cerculation" type="text" value="{{$c->Date_1ere_cerculation}}">
                  @error('Date_1ere_cerculation')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror


              </div>
              
              <div class="col-md-6 mt-4" >
                  <label class="form-label" >Couleur</label>
                  <input class="form-control" name="couleur" type="text" value="{{$c->couleur}}">

                  <!--input class="form-control" name="couleur" type="color"-->
                  @error('couleur')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror


              </div>
              
              <div class="col-md-6 mt-4" >
                  <label class="form-label" >Modele</label>
                  <select class="form-control" name="modele" value="{{$c->modele->libellemodele }}">
                      @foreach ($modeles as $modele )
                          <option value="{{$modele->idmodele}}">{{$modele->libellemodele}}</option>
                      @endforeach
                  </select> 
                  @error('modele')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror


              </div>
         
              <div class="col-md-6 mt-4" >
                  <label class="form-label" >Marque</label>
                  <select class="form-control" name="marque" valeur="{{$c->marques->libellemarque}}">
                      @foreach ($marques as $cc )
                          <option value="{{$cc->idmarque}}">{{$cc->libellemarque}}</option>
                      @endforeach
                  </select> 
                  @error('marque')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror


              </div>
             
              <div class="col-md-6 mt-4" >
                  <label class="form-label" >Photo</label>
                  <input class="form-control form-control-sm" name="photo" id="formFileSm" type="file" value="{{$c->photo}}">
                  <!--input name="photo" type="file"-->
                  @error('photo')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror


              </div>




              


              
             


             
              <fieldset class="col-md-6 mt-4">
                  <legend>L'installation de GPS: </legend>
                
                 
                  
                  <div class="col-md-6 mt-4" >
                      <input type="radio" id="huey" name="gps" value="GPS instalé"  {{ ($c->GPS == 'GPS instalé') ? 'checked' : '' }} >
                      <label for="huey">GPS instalé</label>
                  </div>

                  <div class="col-md-6 mt-4">
                      <input type="radio" id="dewey" name="gps" value="GPS non instalé"  {{ ($c->GPS == 'GPS non instalé') ? 'checked' : '' }}>
                      <label for="dewey">GPS non instalé</label>
                  </div>
                  @error('contrat')
                      <div class="alert alert-danger">
                          {{ $message }}
                      </div>
                  @enderror
                 
               
              </fieldset>


              


              
          </fieldset> 



        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Okay</button>
          <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
    </div>

      </form>
             
           
     
  </div>
</div>
 @endforeach
  
 <!--end de modal pour la modification-->  
 
 
    <script src="{{ asset('dashbordassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashbordassets/js/ecommerce-dashboard.js') }}"></script>
    <script>

        document.querySelector("#bouton").addEventListener("click",()=>{
          document.querySelector(".table-container").style.display = "block";
        })
        document.querySelector("#closeBtn").addEventListener("click",()=>{
          document.querySelector(".table-container").style.display = "none";
        })
        
        
        
              fetch('http://127.0.0.1:8000/test')
                    .then(response => response.json())
                    .then(data => {
                      console.log("eee",data);
                      var tax = data.taxes;
                      var assur = data.assurances;
                      var visite = data.visite;
                      var taxBody = document.getElementById('taxBody');
                      var astab = document.getElementById('astab');
                      var visitetab = document.getElementById('visitetab');
                      console.log("assur",assur);
                      taxBody.innerHTML = '';
        
                       // Remplir le tableau avec les données des taxes
                       visite.forEach(item => {
                        taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une assurance a la date  " + item.dateAssur + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
      
                      });
          
        
                      // Remplir le tableau avec les données des taxes
                      tax.forEach(item => {
                        taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une assurance a la date  " + item.dateAssur + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
      
                      });
          
                      // Remplir le conteneur des notifications supplémentaires
                      assur.forEach(item => {
                        taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une assurance a la date  " + item.dateAssur + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
                      });
                      console.log("tax",tax);
                    });
    </script>
</body>

</html>
