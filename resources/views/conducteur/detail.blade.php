
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
      .show{
        margin-bottom: 50px
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
          @include('include.alert')

          <div class="col-md-12">
            <a href="/conducteur/dashbord/{{$matricule}}">
                <button type="button" style="" class="btn btn-primary" style="width: 500px; height: 40px;">Dashbord</button>
            </a>
          </div>

            <div class="dropdown mt-3  col-md-12">
                <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Liste des Assurances
                </button>

                <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                    <h1>Liste Assurances</h1>
                    <a href="/conducteur/assurance/add/{{$matricule}}" class="mt-6">
                        <button type="button" class="btn btn-primary">Ajouter assurance</button>
                           </a>
                    <hr>
                    <table class="table table-striped mt-6">
                        <thead>
                          <tr >
                            <th scope="col">#</th>
                            <th scope="col">Matricule</th>
                            <th scope="col">Date</th>
                            <th scope="col">contrat</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($assurances as $index=>$c)
                <tr>
                  <th scope="row">{{$index+1}}</th>
                  <td>{{$c->Matricule}}</td>
                  <td>{{$c->dateAssur}}</td>
                  <td>{{$c->contratAssur}}</td>
                  <td>
                    
                    <a href="">
                      <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                    </a>
                    <a onclick="return confirm('voulez-vous vraiment archiver cette assurance ? ')" href="/admin/assurance/{{ $c->id_assurance }}/delete">
                      <img src="{{ asset('dashbordassets/img/voiture/archive.png') }}"
                          alt="supprimer" width="30px">
                  </a>
                   
                  </td>
                </tr>
              @endforeach
                        </tbody>
                      </table>

                   
                </div>
                
            </div>
            <div class="dropdown mt-3  col-md-12">
              <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Liste des taxes
              </button>

              <div class="dropdown-menu  position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                  <h1>Liste taxes</h1>
                  <a href="/conducteur/taxe/add/{{$matricule}}" class="mt-6">
                      <button type="button" class="btn btn-primary">Ajouter taxe</button>
                         </a>
                  <hr>
                  <table class="table table-striped mt-6">
                    <thead>
                      <tr >
                        <th scope="col">#</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Date</th>
                       
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                      @foreach($taxes as $index=>$c)
                      <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$c->Matricule}}</td>
        
                       
                        
                        <td>{{$c->date_taxe}}</td>                
                  
        
        
        
                        <td>
                          
                          <a href="">
                            <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                          </a>
                         
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  

                 
              </div>
              
          </div>

          <div class="dropdown mt-3  col-md-12">
            <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Liste des visites technique
            </button>

            <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                <h1>Liste visites technique</h1>
                <a href="/conducteur/visite/add/{{$matricule}}" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter visite technique</button>
                       </a>
                <hr>
                <table class="table table-striped mt-6">
                  <thead>
                    <tr >
                      <th scope="col">#</th>
                      <th scope="col">Matricule</th>
                      <th scope="col">Date</th>
                      <th scope="col">Resultat</th>
                      <th scope="col">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($visites as $index=>$c)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$c->Matricule}}</td>
                      <td>{{$c->datev}}</td>
                      <td>{{$c->resultatv}}</td>
                      <td>{{$c->description}}</td>
                      <td><a href="" data-bs-toggle="modal" data-bs-target="#modifiervisite{{$c->idvisite}}">
                        <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                      </a>
                    
                      <a onclick="return confirm('voulez-vous vraiment archiver cette entretien? ')" href="/admin/visite/{{ $c->idvisite }}/delete">
                        <img src="{{ asset('dashbordassets/img/voiture/archive.png') }}"
                            alt="supprimer" width="30px">
                    </a></td>
                    </tr>
                   @endforeach
                   
                  </tbody>
                </table>
                

               
            </div>
            
        </div>

            <div class="dropdown mt-3  col-md-12">
              <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Liste des accidents
              </button>

              <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                  <h1>Liste accidents</h1>
                  <a href="/conducteur/accident/add{{$matricule}}" class="mt-6">
                      <button type="button" class="btn btn-primary">Ajouter accident</button>
                         </a>
                  <hr>
                  <table class="table table-striped mt-6">
                    <thead>
                      <tr >
                        <th scope="col">#</th>
                        <th scope="col">Matricuule</th>
                        <th scope="col">Date accidant</th>
                        <th scope="col">assurance de l'autre voiture</th>
                        <th scope="col">Action</th>
        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($accidents as $index=>$c)
                      <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$c->Matricule}}</td>
                        <td>{{$c->date_A}}</td>
                        <?php 
                        if($c->id_constat!=null) {
                        $assurance = optional(DB::table('constats')
                          ->where('id_constat', $c->id_constat)
                          ->select('assurancev')
                          ->first())->assurancev;}
                          else {
                            $assurance='n'.'admet pas constat';
                          }
                      //dd($assurance);
                      ?>
                  
                    <td>{{$assurance}}</td>
                  
                  
                  
                        <td>
                          
                          <a href="" data-bs-toggle="modal" data-bs-target="#modifieraccident{{$c->id_Accident}}">
                            <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                          </a>
                         
                        </td>
                      </tr>
                    @endforeach
                     
                    </tbody>
                  </table>
                      
                 
              </div>
              
             </div>
          
             <div class="dropdown mt-3  col-md-12">
            <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Liste des constats
            </button>

            <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                <h1>Liste constats</h1>
                <a href="/conducteur/constat/add/{{$matricule}}" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter constat</button>
                       </a>
                <hr>
                <table class="table table-striped mt-6">
                  <thead>
                    <tr >
                      <th scope="col">#</th>
                      <th scope="col">Matricule</th>
                      <th scope="col">Date </th>
                      <th scope="col">Lieu</th>
                      <th scope="col">matricule de l'autre <br>voiture</th>
                      <th scope="col">assurance de l'autre<br> voiture</th>
                      <th scope="col">Action</th>
                      
      
      
                    </tr>
                  </thead>
                  <tbody>
                 
                    @foreach($constats as $index=>$c)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$c->vehicule_id}}</td>
                      <td>{{$c->date_c}}</td>
                      <td>{{$c->lieu_c}}</td>
                      <td>{{$c->matriculev}}</td>
                      <td>{{$c->assurancev}}</td>
                      
      
      
                      <td>
                        
                        <a href="">
                          <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                        </a>
                       
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>

               
            </div>
            
          </div>
          
           <div class="dropdown mt-3  col-md-12">
            <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Liste des deplacements
            </button>

            <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                <h1>Liste deplacements</h1>
                <a href="/conducteur/deplacement/add/{{$matricule}}" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter deplacement</button>
                      </a>
                <hr>
                <table class="table table-striped mt-6">
                  <thead>
                    <tr >
                      <th scope="col">#</th>
                      <th scope="col">Matricule</th>
                      <th scope="col">Conducteur</th>
                      
                      <th scope="col">Destination</th>
                      <th scope="col">Kilométrage</th>
                      <th scope="col">Quantite carburant </th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($deplacements as $index=>$c)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$c->Matricule}}</td>
                        <?php $nom= DB::table('conducteurs')
                        ->where('CINC',$c->CINC )
                        ->select('nom','prenom')
                        ->first(); ?>
                      <td>{{$nom->nom}} {{$nom->prenom}} </td>
                      
                      <td>{{$c->destination}}</td>
                      <td>{{$c->kilometrage}}</td>
                      
                      <td>{{$c->qte_carburant}}   litre</td>               
                
      
      
      
                      <td>
                        
                        <a href="">
                          <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                        </a>
                      
                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              
            </div>
            
        </div>
          
      
      <div class="dropdown mt-3  col-md-12">
            <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Liste des echanges
            </button>

            <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                <h1>Liste echanges</h1>
                <a href="/conducteur/echange/add/{{$matricule}}" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter echange</button>
                      </a>
                <hr>
                <table class="table table-striped mt-6">
                  <thead>
                    <tr >
                      <th scope="col">#</th>
                      <th scope="col">Matricule</th>
                      <th scope="col">Date</th>
                      <th scope="col">Kilometrage</th>
                      <th scope="col">Niveau carburant</th>
                      <th scope="col">Conducteur1</th>
                      <th scope="col">Conducteur2</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($echanges as $index=>$c)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$c->Matricule}}</td>
                      <td>{{$c->dateEch}}</td>
                      <td>{{$c->kilometrage}}</td>
                      <td>{{$c->Niveaucarburant}}</td>
                      <td>{{$c->conducteur1}}</td>                
                      <td>{{$c->conducteur2}}</td>
      
      
      
                      <td>
                        
                        <a href="">
                          <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                        </a>
                      
                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
                </table>
                
              
            </div>
            
      </div>
          
          <div class="dropdown mt-3  col-md-12">
            <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Liste des entretiens 
            </button>

            <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
                <h1>Liste entretiens </h1>
                <a href="/conducteur/entretien/add/{{$matricule}}" class="mt-6">
                    <button type="button" class="btn btn-primary">Ajouter entretien</button>
                      </a>
                <hr>
                <table class="table table-striped mt-6">
                  <thead>
                    <tr >
                      <th scope="col">#</th>
                      <th scope="col">Matricule</th>
                      <th scope="col">Date</th>
                      <th scope="col">kilométrage</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($entretiens as $index=>$c)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$c->Matricule}}</td>
                      <td>{{$c->dateE}}</td>
                      <td>{{$c->kilométrage}}</td>
                      <td>
                          
                        <a href="" data-bs-toggle="modal" data-bs-target="#modifierassurance{{$c->identretien}}">
                          <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                        </a>
                        <a onclick="return confirm('voulez-vous vraiment archiver cette entretien? ')" href="/admin/entretien/{{ $c->identretien }}/delete">
                          <img src="{{ asset('dashbordassets/img/voiture/archive.png') }}"
                              alt="supprimer" width="30px">
                      </a>
                       
                      
                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
                </table>
                
                
              
            </div>
            
        </div>

      
      
          
          
      <div class="dropdown mt-3  col-md-12">
          <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Liste des reparations
          </button>

          <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
              <h1>Liste reparations</h1>
              <a href="/conducteur/reparation/add/{{$matricule}}" class="mt-6">
                  <button type="button" class="btn btn-primary">Ajouter reparation</button>
                     </a>
              <hr>
              <table class="table table-striped mt-6">
                <thead>
                  <tr >
                    <th scope="col">#</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">Date</th>
                    
                    <th scope="col">Dégat</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Adresse fournisseur</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reparations as $index=>$c)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$c->Matricule}}</td>
    
                    <td>{{$c->dateR}}</td>
                    
                    <td>{{$c->dégât}}</td>
                    <td>{{$c->montant}}</td>
                    <?php  $adresse= DB::table('fournisseurs')
                    ->where('id_fournisseur',$c->id_fournisseur )
                    ->select('adresse')
                    ->first(); ?>
                    <td>{{$adresse->adresse}}</td>               
              
    
    
    
                    <td>
                      
                      <a href="">
                        <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                      </a>
                     
                    </td>
                  </tr>
                @endforeach
                 
                </tbody>
              </table>
             
          </div>
          
      </div>
      <div class="dropdown mt-3  col-md-12">
        <button class="btn btn-secondary dropdown-toggle btn-lg" style="width:100%; height: 50px; margin-bottom: 0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Liste des vidanges
        </button>

        <div class="dropdown-menu position-static" aria-labelledby="dropdownMenuButton" style="width: 100%; height: 100%; transform: translate(0px, 0px); margin: 0px; position: absolute; inset: 0px auto auto 0px;">
            <h1>Liste vidanges</h1>
            <a href="/conducteur/vidange/add/{{$matricule}}" class="mt-6">
                <button type="button" class="btn btn-primary">Ajouter vidange</button>
                   </a>
            <hr>
            
          <table class="table table-striped mt-6">
            <thead>
              <tr >
                <th scope="col">#</th>
                <th scope="col">Matricule</th>
                <th scope="col">Kilometrage</th>
                <th scope="col">Montant</th>
                <th scope="col">adresse fournisseur</th>

                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach($vidanges as $index=>$c)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$c->Matricule}}</td>

                <td>{{$c->kilométrage}}</td>
                <td>{{$c->montant}}</td>
                <?php  $adresse= DB::table('fournisseurs')
                ->where('id_fournisseur',$c->id_fournisseur )
                ->select('adresse')
                ->first(); ?>
                <td>{{$adresse->adresse}}</td>                
          



                <td>
                  
                  <a href="">
                    <img src="{{asset('dashbordassets/img/voiture/modifier.png')}}" alt="modifier" width="30px">
                  </a>
                 
                </td>
              </tr>
            @endforeach
             
            </tbody>
          </table>
          
           
        </div>
        
      </div> 
             
              
    
          
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


    <script>

      document.querySelector("#bouton").addEventListener("click",()=>{
        document.querySelector(".table-container").style.display = "block";
      })
      document.querySelector("#closeBtn").addEventListener("click",()=>{
        document.querySelector(".table-container").style.display = "none";
      })      
      
      
            fetch('http://127.0.0.1:8000/test{{$matricule}}')
                  .then(response => response.json())
                  .then(data => {
                    console.log("eee",data);


                    var taxes = data.taxes;
                    var assurances = data.assurances;
                    var entretiens = data.entretiens;
                    var accidents = data.accidents;
                    var visites = data.visites;
                    var vidanges = data.vidanges;

                 


                    var taxBody = document.getElementById('taxBody');
                   
                    taxBody.innerHTML = '';
      
                     // Remplir le tableau avec les données des visites
                     visites.forEach(item => {
                      taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une visite a la date  " + item.datev + " <a href='/read'><br><button type='button' class='btn btn-info'>read</button></a></td></tr>";
    
                    });

                    // Remplir le tableau avec les données des vidanges
                    vidanges.forEach(item => {
                      taxBody.innerHTML += "<tr><td>Il faut faire le vidange de  voiture de matricule" + item.Matricule + "   <a href='/read'><br><button type='button' class='btn btn-info'>read</button></a></td></tr>";
    
                    });

                     // Remplir le tableau avec les données des accidents
                     accidents.forEach(item => {
                      taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une accidant a la date  " + item.date_A + " qui ne fait pas sa constat et la date limite est " + (item.date_A +5)+"  <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
    
                    });

                     // Remplir le tableau avec les données des reparation
                     entretiens.forEach(item => {
                      taxBody.innerHTML += "<tr><td>'Modifier le kilométrage pour la réparation de voiture avec  la  matricule" + item.Matricule + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
    
                    });
        
      
                    // Remplir le tableau avec les données des assurance
                    taxes.forEach(item => {
                      taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une taxe a la date  " + item.date_taxe + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
    
                    });
        
                    // Remplir le conteneur des notifications supplémentaires
                    assurances.forEach(item => {
                      taxBody.innerHTML += "<tr><td>la voiture de matricule" + item.Matricule + " admet une assurance a la date  " + item.dateAssur + " <a href='/read'><button type='button' class='btn btn-info'>read</button></a></td></tr>";
                    });
                  });
  </script>
    <script src="{{asset('dashbordassets/js/phoenix.js')}}"></script>
    <script src="{{asset('dashbordassets/js/ecommerce-dashboard.js')}}"></script>
   
      

  </body>

</html>