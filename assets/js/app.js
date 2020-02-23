//Angular application
var app = angular.module("tk_app", ['ngRoute', 'ngAnimate', 'ngMap', 'slickCarousel', 'ngTouch']);

app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
        // Setting html5Mode as true to remove hashtag
//        $locationProvider.html5Mode(true);
//        $locationProvider.html5Mode({
//            enabled: true,
//            requireBase: false
//        });
        
        $routeProvider
                .when('/', {
                    templateUrl: 'views/forside.php',
                    controller: 'mainCtrl'
                })
                .when('/forside', {
                    templateUrl: 'views/forside.php',
                    controller: 'mainCtrl'
                })
                .when('/om-mig', {
                    templateUrl: 'views/om-mig.php',
                    controller: 'mainCtrl'
                })
                .when('/priser', {
                    templateUrl: 'views/priser.php',
                    controller: 'mainCtrl'
                })
                .when('/galleri', {
                    templateUrl: 'views/galleri.php',
                    controller: 'galleryCtrl'
                })
                .when('/kontakt', {
                    templateUrl: 'views/kontakt.php',
                    controller: 'mainCtrl'
                })
                .when('/admin', {
                    templateUrl: 'views/admin.php',
                    controller: 'adminCtrl'
                })
                .otherwise({
                    template: '404 page not found.'
                });
    }]);