<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false"
            aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3"
            href="index.html">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <a href="/admin/dashbord">
                        <img src="{{ asset('dashbordassets/img/logo1.png') }}" alt="phoenix"
                            width="32">
                        <p class="logo-text ms-2 d-none d-sm-block">StepParcAuto</p>
                    </a>
                </div>
            </div>
        </a></div>
    <div class="collapse navbar-collapse">
        <div class="search-box d-none d-lg-block" style="width:25rem;">
            <form class="position-relative" data-bs-toggle="search" data-bs-display="static" method="post" action="{{ $searchRoute }}">
                @csrf
                <input class="form-control form-control-sm search-input search min-h-auto" name="query" type="search" placeholder="Search..." aria-label="Search">
                 <span class="fas fa-search search-box-icon"></span>
            </form>
        </div>
        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">
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
