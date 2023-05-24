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
    <style>

    </style>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        <!--les includes-->
        
       
        @include('include.conducteur.nav');
        



        <div class="content">
          <div class="overlay"></div>
          
         
       
          <?php $voiture = DB::table('voitures')->where('matricule', $matricule)->first(); ?>
          <div class="row">
            <div class="col-md-6">
              
              <img src="{{asset('uploads')}}/{{$voiture->photo}}"  style="width: 450px; " class="img-responsive" alt="Product Image">
            </div>
            
            <div class="col-md-6">
              <h3>Caractéristiques du voiture</h3>
              <table class="table">
                <tbody>
                  <tr>
                    <td>Matricule:</td>
                    <td>{{$voiture->matricule}}</td>
                  </tr>
                  <tr>
                    <td>Couleur:</td>
                    <td>{{$voiture->couleur}}</td>
                  </tr>
                  <tr>
                    <td>Date de premiere cerculation:</td>
                    <td>{{$voiture->Date_1ere_cerculation}}</td>
                  </tr>
                  <tr>
                    <?php $marque = DB::table('marques')->where('idmarque', $voiture->id_marque)->first(); ?>
                    <td>Marque:</td>
                    <td>{{$marque->libellemarque}}</td>
                  </tr>
                  <tr>
                    <?php $modele = DB::table('modeles')->where('idmodele', $voiture->id_modele)->first(); ?>
                    <td>Modele:</td>
                    <td>{{$modele->libellemodele}}</td>
                  </tr>
                  <tr>
                    <td>GPS:</td>
                    <td>{{$voiture->GPS}}</td>
                  </tr>
                </tbody>
              </table>
              <a href="/conducteur/detail/{{$matricule}}">
                <div class="mt-6" >
                  <button type="button" class="btn btn-primary" style="width: 500px; height: 40px;">Les detait du voiture</button>
                </div>
              </a>
            </div>
          </div>
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
      
  
fetch('http://127.0.0.1:8000/test/12355')
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