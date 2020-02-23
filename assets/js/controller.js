/////////////////////////////
//App directives
//Gallery next image on right arrow keypress
app.directive('keyRight', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 39) {
                scope.$apply(function () {
                    scope.$eval(attrs.keyRight);
                });

                event.preventDefault();
            }
        });
    };
});

//Gallery prev image on left arrow keypress
app.directive('keyLeft', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 37) {
                scope.$apply(function () {
                    scope.$eval(attrs.keyLeft);
                });

                event.preventDefault();
            }
        });
    };
});

//On finish ng-repeat render
app.directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
});

//Get screen size
//app.directive('myDirective', ['$window', function ($window) {
//    
//     return {
//        link: link,
//        restrict: 'E',
//        template: '<div>window size: {{width}}px</div>'
//     };
//     
//     function link(scope, element, attrs){
//       
//       scope.width = $window.innerWidth;
//       
//       angular.element($window).bind('resize', function(){
//       
//         scope.width = $window.innerWidth;
//         
//         // manuall $digest required as resize event
//         // is outside of angular
//         scope.$digest();
//       });
//       
//     }
//     
// }]);



/////////////////////////////
//App.run
angular.module("tk_app").run(['$rootScope', '$location', '$window', function ($rootScope, $location, $window) {

        //Redirect to HTTPS
        if (window.location.protocol == "http:") {
            window.location = document.URL.replace("http://", "https://");
        }

        //Reload page when 992px screen width is passed (for changing navigation)
        var ww = $(window).width();
        var limit = 992;

        function refresh() {
            ww = $(window).width();
            var w = ww < limit ? (location.reload(true)) : (ww > limit ? (location.reload(true)) : ww = limit);
        }

        $(window).resize(function () {
            var resW = $(window).width();
            if ((ww > limit && resW < limit) || (ww < limit && resW > limit)) {
                refresh();
            }
        });

        //Check if logged
        $rootScope.getLogged = function () {
            var logged = localStorage.getItem('logged');
            if (logged == "true") {
                return true;
            } else {
                return false;
            }
        };

        //Check cookie consent
        $rootScope.getCookieConsent = function () {
            var cookieConsent = localStorage.getItem('cookieConsent');
            if (cookieConsent) {
                return true;
            } else {
                return false;
            }
        };

        //Show cookie bar if no cookie consent
        $rootScope.toggleCookieBar = function () {
            if (localStorage.getItem('cookieConsent') == "true") {
                document.getElementById("cookieBar").style.bottom = "-150px";
                document.getElementById("cookiesAccepted").style.bottom = "0";
            } else {
                document.getElementById("cookieBar").style.bottom = "0";
                document.getElementById("cookiesAccepted").style.bottom = "-150px";
            }
        };

        //Accept cookies
        $rootScope.acceptCookies = function () {
            localStorage.setItem('cookieConsent', 'true');
            $rootScope.toggleCookieBar();
        };

        //Reset cookies
        $rootScope.resetCookies = function () {
            localStorage.removeItem('cookieConsent');
            $rootScope.toggleCookieBar();
        };

    }]);


////////////////////////
// nav controller
app.controller("navCtrl", ['$scope', '$location', function ($scope, $location) {

        //Get location for active nav links
        $scope.getLocation = function () {
            return $scope.location = $location.path();
        };

        if ($(window).width() > 991) {
            //Add CSS for desktop navigation
            $('head').append('<link rel="stylesheet" href="assets/css/nav.css" type="text/css" />');

            //Move navigation active-slider
            $('.nav-link').click(function () {
                if (!$(this).hasClass('activeNavLink')) {

                    $('.nav-link').removeClass('activeNavLink');
                    $(this).addClass('activeNavLink');
                    var width = $(this).width();
                    offsetTop = $(this).offset().top - $('.navbar-nav').offset().top;
                    offsetLeft = $(this).offset().left - $('.navbar-nav').offset().left;

                    $('.active-slider').animate({
                        top: offsetTop - 7,
                        left: offsetLeft + 8,
                        right: $('.navbar-nav').width() - $(this).width() - offsetLeft,
                        bottom: $('.navbar-nav').height() - $(this).height() - offsetTop,
                        width: width + 2
                    }, 50, 'linear');
                }
            });
        } else {
            //With hashtags
            $("#mobileNav-container").append(" <div class='mobileNavOverlay'> </div> <div class='mobileNav zindex' id='mobileNav'> <ul class='navbar-nav ml-auto'> <span id='closeMobileNav'>×</span> <li> <a href='#forside' class='mobileNavLink'>Forside</a> </li> <li> <a href='#om-mig' class='mobileNavLink'>Om mig</a> </li> <li> <a href='#priser' class='mobileNavLink'>Priser & ydelser</a> </li> <li> <a href='#galleri' class='mobileNavLink'>Galleri</a> </li> <li> <a href='#kontakt' class='mobileNavLink'>Kontakt</a> </li> </ul> </div>");
            //Without hashtags
//            $("#mobileNav-container").append(" <div class='mobileNavOverlay'> </div> <div class='mobileNav zindex' id='mobileNav'> <ul class='navbar-nav ml-auto'> <span id='closeMobileNav'>×</span> <li> <a href='forside' class='mobileNavLink'>Forside</a> </li> <li> <a href='om-mig' class='mobileNavLink'>Om mig</a> </li> <li> <a href='priser' class='mobileNavLink'>Priser & ydelser</a> </li> <li> <a href='galleri' class='mobileNavLink'>Galleri</a> </li> <li> <a href='kontakt' class='mobileNavLink'>Kontakt</a> </li> </ul> </div>");
        }

        //Logo on-click
        $('#headerLogo').click(function () {
            window.location.href = "https://tinasklip.dk";
        });

        //Show / hide mobile nav
        $('.mobileNavOverlay').hide();
        $('#mobileNav').hide();
        //Hide mobile nav when overlay is clicked
        $('.mobileNavOverlay').click(function () {
            $('#mobileNav').animate({'width': 'toggle'});
            $('.mobileNavOverlay').toggle();
        });
        //Show mobile nav and overlay
        $('#mobileNav-toggler').click(function () {
            $('#mobileNav').animate({'width': 'toggle'});
            $('.mobileNavOverlay').toggle();
        });
        //Close mobile nav and overlay when link is clicked
        $('.mobileNavLink').click(function () {
            $('#mobileNav').animate({'width': 'toggle'});
            $('.mobileNavOverlay').toggle();
        });
        //Close mobile nav when X is clicked
        $('#closeMobileNav').click(function () {
            $('#mobileNav').animate({'width': 'toggle'});
            $('.mobileNavOverlay').toggle();
        });

        //Log off
        $scope.signOut = function () {
            localStorage.removeItem("logged");
            window.location.reload();
        }

        //Get current year
        document.getElementById("currentYear").innerHTML = new Date().getFullYear();

    }]);


//////////////////////
// Main controller
app.controller("mainCtrl", function ($scope, $http) {

    ///////////
    // Forside

    //Get images
    $scope.getGallery = function () {
        $scope.gallery = [];
        $http.get("handlers/all_images.php")
                .success(function (data) {
                    $scope.gallery = data;

                    //Get array of image objects
                    $scope.images = [];
                    for (i = 0; i < $scope.gallery.length; i++) {
                        var obj = {
                            name: $scope.gallery[i]['name'],
                            id: $scope.gallery[i]['id']
                        };
                        $scope.images.push(obj);
                    }

                });
    };

    //Slick config
    $scope.slickConfig = {
        enabled: true,
        swipe: false,
        autoplay: true,
        cssEase: 'ease',
        swipeToSlide: true,
        dots: !0,
        autoplaySpeed: 2500,
        slidesToShow: 4,
        touchMove: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            }
        ],
        method: {},
        event: {
            beforeChange: function (event, slick, currentSlide, nextSlide) {
            },
            afterChange: function (event, slick, currentSlide, nextSlide) {
            }
        }
    };

    //Slider lightbox
    //Get image gallery array for lightbox
//    $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
//        $scope.images = [];
//        for (i = 0; i < $scope.gallery.length; i++) {
//            var obj = {
//                id: $scope.gallery[i]['id'],
//                name: $scope.gallery[i]['name']
//            };
//            $scope.images.push(obj);
//        }
//    });

    //Set lightbox img
    $scope.setLightbox = function (img) {
        $scope.index = $scope.images.findIndex(function (item, i) {
            return item.id === img;
        });
        $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        $("#lightboxModal").modal('toggle');
    };

    //Next image
    $scope.nextImg = function () {
        if ($scope.index == $scope.images.length - 1) {
            $scope.index = 0;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        } else {
            $scope.index++;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        }
    };

    //Previous image
    $scope.prevImg = function () {
        if ($scope.index == 0) {
            $scope.index = $scope.images.length - 1;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        } else {
            $scope.index--;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        }
    };

    ///////////////////
    //Priser & Ydelser

    //Get all services
    $scope.getServices = function () {
        $scope.services = [];
        $http.get("handlers/all_services.php")
                .success(function (data) {
                    $scope.services = data;
                });
    };

    //Add service
    $scope.addService = function (name, price) {
        $http.post("handlers/add_service.php", {
            'name': name,
            'price': price
        }).success(function (response) {
            $scope.getServices();
            if (response == "true") {
                $scope.server_msg = "Ydelse tilføjet.";
            } else {
                $scope.server_msg = "Noget gik galt.";
            }
            $scope.name = null;
            $scope.price = null;
            document.getElementById("name").focus();
        });
    };

    //Open modal for service management
    $scope.editModal = function (id) {
        $http.post("handlers/single_service.php", {
            'id': id
        }).success(function (data) {
            $scope.serviceId = data[0]['id'];
            $scope.newServiceName = data[0]['name'];
            $scope.newServicePrice = data[0]['price'];

            $("#editModal").modal('toggle');
        });
    };

    //Edit service
    $scope.editService = function (id, name, price) {
        $http.post("handlers/edit_service.php", {
            'id': id,
            'name': name,
            'price': price
        }).success(function (response) {
            $scope.getServices();
            $("#editModal").modal('toggle');
            if (response == "true") {
                $scope.server_msg = "Ydelse redigeret.";
            } else {
                $scope.server_msg = "Noget gik galt.";
            }
        });
    };

    //Delete service
    $scope.deleteService = function (id) {
        if (confirm("Er du sikker på at ydelsen skal slettes?")) {
            $http.post("handlers/delete_service.php", {
                'id': id
            }).success(function () {
                $scope.getServices();
            });
        } else {
            return false;
        }
    };


    //////////
    //Kontakt

    //Show NgMap info window
    $scope.showInfo = function () {
        $scope.map.showInfoWindow('tkInfoWindow', this);
    };
    //Hide NgMap info window
    $scope.hideInfo = function () {
        $scope.map.hideInfoWindow('tkInfoWindow', this);
    };
});


//////////////////////
// Galleri controller
app.controller("galleryCtrl", function ($scope, $http) {

    //Loading gif
    $scope.loading = false;

    //Add image
    $scope.image_source = 'assets/img/imgpreview.svg';
    $scope.imageForm = [];
    $scope.files = [];
    $scope.addImage = function () {
        $scope.loading = true;
        $scope.imageForm.image = $scope.files[0];
        $http({
            method: 'POST',
            url: '../handlers/add_image.php',
            processData: false,
            transformRequest: function (data) {
                var formData = new FormData();
                formData.append("image", $scope.imageForm.image);
                return formData;
            },
            data: $scope.imageForm,
            headers: {
                'Content-Type': undefined
            }
        }).success(function (response) {
            $scope.loading = false;
            $scope.response = response;
            $scope.getGallery();
            //Reset input field
            var fileElement = angular.element('#imageInput');
            angular.element(fileElement).val(null);
            $scope.image_source = 'assets/img/imgpreview.svg';
        });
    };

    $scope.uploadedFile = function (element) {
        $scope.currentFile = element.files[0];
        var reader = new FileReader();
        reader.onload = function (event) {
            $scope.image_source = event.target.result
            $scope.$apply(function ($scope) {
                $scope.files = element.files;
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    //Get images
    $scope.getGallery = function () {
        $scope.gallery = [];
        $http.get("handlers/all_images.php")
                .success(function (data) {
                    $scope.gallery = data;
                });
    };

    //Remove image
    $scope.deleteImg = function (id) {
        if (confirm("Er du sikker på at billedet skal slettes?")) {
            $http.post("handlers/delete_image.php", {
                'id': id
            }).success(function (response) {
                $scope.getGallery();
            });
        } else {
            return false;
        }
    };

    //Get image gallery array for lightbox
    $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
        $scope.images = [];
        for (i = 0; i < $scope.gallery.length; i++) {
            var obj = {
                id: $scope.gallery[i]['id'],
                name: $scope.gallery[i]['name']
            };
            $scope.images.push(obj);
        }
    });

    //Set lightbox img
    $scope.setLightbox = function (img) {
        $scope.index = $scope.images.findIndex(function (item, i) {
            return item.id === img;
        });
        $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        $("#lightboxModal").modal('toggle');
    };

    //Next image
    $scope.nextImg = function () {
        if ($scope.index == $scope.images.length - 1) {
            $scope.index = 0;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        } else {
            $scope.index++;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        }
    };

    //Previous image
    $scope.prevImg = function () {
        if ($scope.index == 0) {
            $scope.index = $scope.images.length - 1;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        } else {
            $scope.index--;
            $scope.lightBoxSrc = "uploads/" + $scope.images[$scope.index]['name'];
        }
    };

    //Swipe drag effect
//    var dragItem = document.querySelector(".lightBoxImage");
//    var container = document.querySelector("#lightboxModal");
//
//    var active = false;
//    var currentX;
//    var initialX;
//    var xOffset = 0;
//
//    container.addEventListener("touchstart", dragStart, false);
//    container.addEventListener("touchend", dragEnd, false);
//    container.addEventListener("touchmove", drag, false);
//
//    container.addEventListener("mousedown", dragStart, false);
//    container.addEventListener("mouseup", dragEnd, false);
//    container.addEventListener("mousemove", drag, false);
//
//
//    function dragStart(e) {
//        if (e.type === "touchstart") {
//            initialX = e.touches[0].clientX - xOffset;
//        } else {
//            initialX = e.clientX - xOffset;
//        }
//
//        if (e.target === dragItem) {
//            active = true;
//        }
//    }
//
//    function dragEnd(e) {
//        resetTranslate(dragItem);
//        active = false;
//    }
//
//    function drag(e) {
//        if (active) {
//            e.preventDefault();
//
//            if (e.type === "touchmove") {
//                currentX = e.touches[0].clientX - initialX;
//            } else {
//                currentX = e.clientX - initialX;
//            }
//
//            setTranslate(currentX, dragItem);
//        }
//    }
//
//    function setTranslate(xPos, el) {
//        el.style.transform = "translate3d(" + xPos + "px, 0px, 0)";
//    }
//    function resetTranslate(el) {
//        el.style.transform = "translate3d(0px, 0px, 0)";
//    }

});


//////////////////////
// Admin controller
app.controller("adminCtrl", function ($scope, $http, $window, $location) {

    //Check if logged
    var logged = localStorage.getItem('logged');
    if (logged == "true") {
        $location.path('forside');
    }

    //Sign in
    $scope.signIn = function () {
        $http.post(
                "handlers/logon.php", {
                    'username': $scope.username,
                    'password': $scope.password
                }
        ).success(function (data) {
            $scope.user_data = data;
            if ($scope.user_data != 0) { //If login was successful
                $window.localStorage.setItem("logged", "true");
                $location.path('forside');
            } else { //If login failed
                alert("Forkert username eller password.");
            }
        });
    };
});