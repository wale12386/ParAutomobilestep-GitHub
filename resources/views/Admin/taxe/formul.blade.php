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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('formulaire/css/formvoiture.css') }}" rel="stylesheet" id="style-default">
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
            @include('include.admin.nav',['searchRoute'=>route('taxe.search')]);





            <div class="content">
                <form class="row g-3" method="POST" action="/admin/taxe/add" >
                    

                    @csrf

                 <fieldset >
                    <legend>Information Taxe:</legend>

                        <div class="col-md-6 mt-4">
                            <label class="form-label" >Matrucule</label>
                            <input class="form-control" name="matricule" type="text">
                            @error('matricule')
                                <div class="alert alert-danger">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-4" >
                            <label class="form-label" >Date </label>
                            <input class="form-control" name="datetaxe" type="text">
                            @error('datetaxe')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror


                        </div>
                       

                        


                        <div class="col-12 mt-4">
                           <a href="/admin/taxe"> <button  href="/admin/taxe" type="button" class="btn btn-light" >Annuler</button></a>
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </fieldset> 





                </form>

                <!-- end formulaire-->




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
