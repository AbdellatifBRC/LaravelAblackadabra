<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600&family=Bebas+Neue&family=Heebo:wght@100;200;300;400;500;600;700&family=Kanit:wght@300&family=Lobster&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <title>Ablackadabra</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/media-style.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
    crossorigin="anonymous">
    <script src="{{asset('js/ablackNav.js')}}"></script>
    <style>


    </style>
</head>
<body>
    <header class="">
        <!--nav for wide screen-->
        <nav class="navbar nav-lg navbar-expand-lg navbar-dark d-none d-lg-block">
            <div class="container-fluid">
                <div class="div-logo">
                    <a class="" href="#"><img class="img-fluid" src="{{asset('images/ablackadabra-logo-removebg-preview.png')}}" alt="logo"/></a>
                </div>
                <!--nav for small screen < 800 px-->
                <div class="nav-ul" id="">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link" href="#">ACCUEIL</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">DEVENIR PIONNEIER</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">MON COMPTE</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">QUI EST ABLACKADABRA ?</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">CONTACT</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">SE CONNECTER</a>
                            </li>
                        </ul>
                </div>
                <!--nav for wide screen > 800 px-->
                <div class="div-globe">
                    <a href="#" class="globe">
                        <i class="fa fa-globe fa-3x" aria-hidden="true"></i>
                    </a>
                    <div class="menu-item">
                        <span class="bars">
                            <i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </nav>
        <!--navbar for small screnn-->
        <nav class="navbar navbar-expand-lg navbar-dark d-lg-none">
            <div class="container-fluid">
                <div class="div-globe">
                    <a href="#" class="globe">
                        <i class="fa fa-globe fa-3x" aria-hidden="true"></i>
                    </a>
                    <div class="menu-item">
                        <span class="bars">
                            <i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div class="div-logo">
                    <a class="" href="#"><img class="img-fluid" src="{{asset('images/ablackadabra-logo-removebg-preview.png')}}" alt="logo"/></a>
                </div>
                <!--nav for small screen < 800 px-->
                <div class="modal fade " id="myModal">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-5 nav-sm border-0 rounded-0">
                        {{-- close button --}}
                        <div class="position-absolute" style="right: 5px;top:5px;">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa-solid fa-xmark" style="color: white;"></i>
                            </button>
                        </div>
                        <!-- Modal Header -->
                        <div class="popup-header">
                            <h4 class="">Ablackadabra</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                <a class="nav-link" href="#">ACCUEIL</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">DEVENIR PIONNEIER</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">MON COMPTE</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">QUI EST ABLACKADABRA ?</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">CONTACT</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">SE CONNECTER</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer m-auto">
                            <a class="" href="#"><img class="img-fluid" src="{{asset('images/ablackadabra-logo-removebg-preview.png')}}" alt="logo"/></a>
                        </div>
                    </div>
                    </div>
                </div>
                <!--button for small screen < 800px -->
                <button class="navbar-toggler nav-btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#myModal" >
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
    </header>
    <!-- end of navbar ablackadabra-->
    {{-- navbar container end  --}}

    {{-- content section start --}}
    @yield('content')
    {{-- content section end --}}

        <!--footer-->

        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 pb-4">
                        <div class="first-part">
                            <img src="{{asset("images/ablackadabra-logo-removebg-preview1.png")}}" />
                            <h1>ABLACKADABRA</h1>
                            <p>Ablackadabra est un site exclusivement dédié à la Communauté Noire internationale. Plus qu’un simple site Internet, c’est un lieu de participation collaborative dédié à l’émancipation intellectuelle, financière et spirituelle du Peuple Noir</p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4 pb-4">
                            <div class="second-part">
                                <h3>INFORMATIONS LÉGALES</h3>
                                <h4>Editeur</h4>
                                <h5>Steam Beam</h5>
                                <p>31 avenue du Général Leclerc
                                <br>94420 Le Plessis-Trévise
                                <br> France
                                <br>RCS Créteil B 824 146 146</p>
                                <h4>Hébergeur</h4>
                                <p>Le site Ablackadabra est hébergé par
                                <br>Gandi
                                <br>63 boulevard Massena
                                <br>75013 Paris
                                </p>
                            </div>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <div class="third-part">
                            <h6>CONTACT</h6>
                            <p><strong>Vous avez une demande concernant Ablackadabra ? <br> Vous souhaitez un site Internet personnalisé ? <br> Une refonte de votre site actuel ?</strong></p>
                            <br>
                            <div class="section1-btn">
                                <a href="#">
                                    <span>
                                        Nous contacter
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="section9">
            <div class="row container-fluid">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <p>Copyright</p>
                </div>
            </div>
        </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
</html>

