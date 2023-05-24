<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false"
            aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3"
            href="index.html">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <a href="/conducteur/dashbord/{{$matricule}}">
                        <img src="{{ asset('dashbordassets/img/logo1.png') }}" alt="phoenix"
                            width="32">
                        <p class="logo-text ms-2 d-none d-sm-block">StepParcAuto</p>
                    </a>
                </div>
            </div>
        </a></div>
    <div class="collapse navbar-collapse">
       
        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
            <li class="nav-item dropdown"> 
                <a id="bouton" href="#">
                  <img src="{{ asset('dashbordassets/img/voiture/notification.png') }}" alt="modifier" width="20px">
    
                </a>
              </li>
              <div class="table-container">
                <button style="border: 0; direction: rtl"  type="button" class="close" aria-label="Fermer" id="closeBtn">
                  <span aria-hidden="true">&times;</span>
                </button>
                <table class="table" id="taxtab">
                  <thead>
                    <tr>
                      <th>Notifications</th>
    
                    </tr>
                  </thead>
                  <tbody id="taxBody">
                    <!-- Ajoutez ici les autres lignes de notifications -->
                  </tbody>
                </table>
            </div>
              

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Titre</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                      <p>Texte du modal + choix et actions...</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      <button type="button" class="btn btn-primary">Enregistrer</button>
                    </div>
                  </div>
                </div>
              </div>


            <li class="nav-item"><a class="nav-link px-3" href="/conducteur/profil/{{$matricule}}"><span
                class="me-2 text-900" data-feather="user"></span>Profile</a>
            </li>

            <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownNotification">


                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"class="btn btn-phoenix-secondary d-flex flex-center w-100"
                        href="#!"><span class="me-2"
                            data-feather="log-out"></span></a>
    
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                
        </li>
           


           
           
           
            
        </ul>
    </div>
</nav>
