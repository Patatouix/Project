<!DOCTYPE html>
<html>
    <head>
        <title>Matterberg</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/project/public/css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
        <script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
            window.Laravel = {!! json_encode([
                'user' => auth()->check() ? auth()->user()->id : null,
            ]) !!};
        </script>
        <style>
            html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
        </style>
    </head>
    <body class="w3-theme-l5">

        <!-- Navbar -->
        <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <a href="{{ url('home') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Accueil</a>
        <a href="{{ url('user/' . Auth::user()->id) }}" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white" title="Profil"><i class="fa fa-user w3-margin-right nav-icon"></i>Profil</a>
        <a href="{{ url('animal') }}" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white" title="Animaux"><i class="fa fa-paw w3-margin-right nav-icon"></i>Animaux</a>
        <a href="{{ url('rdv') }}" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white" title="Rendez-vous"><i class="fas fa-address-book w3-margin-right nav-icon"></i>RDVs</a>
        <a href="{{ url('reservation') }}" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white" title="Réservations"><i class="fa fa-gift w3-margin-right nav-icon"></i>Réservations</a>
        <div class="w3-dropdown-hover">
            <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green notifications-total">
                {{ session('reservations')->count() + session('rdvs')->count() }}
            </button>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                <a href="{{ url('rdv/status/2') }}" class="w3-bar-item w3-button"><span class="notifications-rdvs">{{ session('rdvs')->count() }}</span> rendez-vous à confirmer</a>
                <a href="{{ url('reservation/status/2') }}" class="w3-bar-item w3-button"><span class="notifications-reservations">{{ session('reservations')->count() }}</span> réservation(s) validée(s)</a>
            </div>
        </div>
        <a href="{{ url('logout') }}" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-right w3-padding-large w3-hover-white" title="My Account"><i class="fas fa-sign-out-alt w3-margin-right"></i>Déconnexion</a>
        </a>
        </div>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-large">
        <a href="{{ url('home') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home w3-margin-right"></i>Accueil</a>
        <a href="{{ url('user') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-user w3-margin-right"></i>Profil</a>
        <a href="{{ url('animal') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-paw w3-margin-right"></i>Animaux</a>
        <a href="{{ url('rdv') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fas fa-address-book w3-margin-right"></i>Rendez-vous</a>
        <a href="{{ url('reservation') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-gift w3-margin-right"></i>Réservations</a>
        <a href="{{ url('logout') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fas fa-sign-out-alt w3-margin-right"></i>Déconnexion</a>
        </div>

        <br>

        <!-- Page Container -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

        <!-- The Grid -->
        <div class="w3-row">

            @yield('content')

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
        </div>
        <br><br><br><br>


        <!-- Footer -->
        <footer class="w3-container w3-theme-d3 w3-padding-16 footer1">
            <h5 class="w3-center">Matterberg, because your pet matters ! <i class="fas fa-heart"></i></h5>
        </footer>

        <footer class="w3-container w3-theme-d5 footer2 pt-2">
            <button class="link-footer btn btn-link" data-toggle="modal" data-target=".exampleModal">Mentions légales</button> /
            <button class="link-footer btn btn-link" data-toggle="modal" data-target=".exampleModal">CGU</button> /
            <button class="link-footer btn btn-link" data-toggle="modal" data-target=".exampleModal">Politique de confidentialité</button>
        </footer>

        <!-- Modal -->
        <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Texte légal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Ici un contenu de texte légal. En construction.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script>
        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else {
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }

        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
        </script>

    </body>
</html>