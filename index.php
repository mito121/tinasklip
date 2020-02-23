<!DOCTYPE html>
<html lang="da">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tinas Klip & Krøl</title>
        <!-- set base href to not require base tags (hashtags in url) -->
        <base href="https://tinasklip.dk/"/>

        <!-- ==== CSS ==== -->

        <!-- bootstrap -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- angular slick img carousel -->
        <link href="assets/css/slick.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/slick-theme.css" rel="stylesheet" type="text/css"/>

        <!-- custom css -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

        <!-- ==== JAVASCRIPT ==== -->

        <!-- jQuery -->
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="assets/js/bootstrap.js"></script>

        <!-- Angularjs -->
        <script src="assets/js/angular.js"></script>

        <!-- Angularjs route -->
        <script src="assets/js/route.js"></script>

        <!-- Angularjs Animate -->
        <script src="assets/js/angular-animate.js"></script>
        
        <!-- Angularjs ngTouch -->
        <script src="assets/js/angular-touch.js"></script>

        <!-- Angularjs ng-map -->
        <script src="https://maps.google.com/maps/api/js?libraries=placeses,visualization,drawing,geometry,places&key=AIzaSyCj5hRdf8MbX8dhGnNrST_60sMWfEQtXJA"></script>
        <script src="assets/js/ng-map.min.js"></script>

        <!-- Angular slick img carousel -->
        <script src="assets/js/slick.js"></script>
        <script src="assets/js/angular-slick.js"></script>

        <!-- Angularjs app -->
        <script src="assets/js/app.js"></script>

        <!-- Angularjs controller -->
        <script src="assets/js/controller.js"></script>
    </head>
    
    <body ng-app="tk_app" class="container-fluid">
        <div id="mobileNav-container"></div>
        <header ng-controller="navCtrl">
            <!-- desktop nav -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand headerLogo" id="headerLogo"><img src="assets/img/logo2.svg" alt="Logo" class="logo headerLogo"></a>
                    <button class="navbar-toggler" id="mobileNav-toggler" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item" id="home" ng-class="{activeNavLink: getLocation() === '/forside' || getLocation() === '/'}">
                                <a class="nav-link" ng-href="#forside" ng-click="moveNavSlider()">Forside</a>
                            </li>
                            <li class="nav-item" ng-class="{activeNavLink: getLocation() === '/om-mig'}">
                                <a class="nav-link" ng-href="#om-mig" ng-click="moveNavSlider()">Om mig</a>
                            </li>
                            <li class="nav-item" ng-class="{activeNavLink: getLocation() === '/priser'}">
                                <a class="nav-link" ng-href="#priser">Priser & ydelser</a>
                            </li>
                            <li class="nav-item" ng-class="{activeNavLink: getLocation() === '/galleri'}">
                                <a class="nav-link" ng-href="#galleri">Galleri</a>
                            </li>
                            <li class="nav-item" ng-class="{activeNavLink: getLocation() === '/kontakt'}">
                                <a class="nav-link" ng-href="#kontakt">Kontakt</a>
                            </li>
                            <li ng-if="getLogged() == true">
                                <a class="nav-link" href="" ng-click="signOut()"><i class="fas fa-sign-out-alt"></i> Log ud</a>
                            </li>
                            <div class="active-slider"></div>
                        </ul>
                    </div>
                </div><!-- container -->
            </nav>
        </header>

        <!-- view -->
        <main class="view-animate-container">
            <my-directive></my-directive>
            <ng-view autoscroll="false" class="view-animate"></ng-view>
        </main>

        <!-- footer -->
        <footer>
            <div class="container text-center">
                <p>Tinas Klip & Krøl &copy; <span id="currentYear"></span></p>
                <p>Tlf: 20 35 92 04</p>
                <p>CVR: 27162029</p>
            </div>
        </footer>

        <!-- cookie bar -->
        <div class="cookieConsent" id="cookieBar" ng-init="toggleCookieBar()">
            <div class="container">
                <div class="row no-gutters p-0">
                    <div class="col-12 no-gutters p-0">
                        <span>
                            På dette website anvendes førstepartscookies til forbedring af brugeroplevelsen. 
                            Ved fortsat brug af websiden godkender du 
                            <button class="cookieBtn" data-toggle="modal" data-target="#cookieModal">cookiepolitikken</button>.
                        </span>
                        <span>
                            <button type="button" ng-click="acceptCookies()" class="btn btn-sm btn-success">Acceptér</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- reset cookies -->
        <div class="smallCookieConsent"  data-toggle="modal" data-target="#cookieModal" id="cookiesAccepted">Cookie- & privatlivspolitik</div>

        <!-- Cookies modal -->
        <div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cookieModalLabel">Cookie- og privatlivspolitik</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Introduktion</h5>
                        <p>Når du besøger dette website indsamles der oplysninger om dig, som bruges til at tilpasse og forbedre websitets indhold. Hvis du ikke ønsker, at der indsamles oplysninger, bør du slette dine cookies (<a href="http://minecookies.org/cookiehandtering" target="_blank">se vejledning</a>) og undlade videre brug af dette website.</p>

                        <h5>Cookies</h5>
                        <p>Dette website anvender ”cookies”, der er en tekstfil, som gemmes på din computer, mobil el. tilsvarende med det formål at genkende den, huske indstillinger, udføre statistik og målrette annoncer. Cookies kan ikke indeholde skadelig kode som f.eks. virus.</p>
                        <p>Dette website anvender udelukkende førstepartscookies.</p>
                        <p>Det er muligt at slette eller blokere for cookies. Se vejledning: <a href="http://minecookies.org/cookiehandtering" target="_blank">http://minecookies.org/cookiehandtering</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                        <button type="button" class="btn btn-success" ng-if="!getCookieConsent() || getCookieConsent() == 'false'" ng-click="acceptCookies()" data-dismiss="modal">Acceptér</button>
                        <button type="button" class="btn btn-danger" ng-if="getCookieConsent()" ng-click="resetCookies()" data-dismiss="modal">Acceptér ikke</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
