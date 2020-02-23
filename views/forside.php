<div ng-controller="mainCtrl" class="container">
    <div class="row">
        <div class="col-12">
            <h1>Velkommen hos Tinas Klip & Krøl</h1>
            <h2 class="h3">Din mobilfrisør på Fyn og omegn</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-8 col">
            <img src="../assets/img/fp_img.jpg" alt="Banner" class="banner-img"/>
        </div>
        <div class="col-4 flex-end col">
            <iframe class="fb_feed" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMobilfris%25C3%25B8r-Tinas-Klip-Kr%25C3%25B8l-1788457027891608%2F%3Fhc_ref%3DARQ_bFPLbrH6hgNAS_3h3mMm5A2cO_SM7hT6Kx5UQZBKD9OS0NR-fuYMQoBx3MW3H5A%26fref%3Dnf&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" allowTransparency="true"></iframe>
        </div>
    </div>

    <div class="row" ng-init="getGallery()">
        <div class="col-12 col carousel-col">
            <slick settings="slickConfig" infinite="true" slides-to-scroll="2" ng-if="images.length" class="img-carousel">
                <div ng-repeat="i in images">
                    <img ng-src="uploads/small/{{i.name}}" ng-click="setLightbox(i.id)">
                </div>
            </slick>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" role="dialog" aria-hidden="true" key-right="nextImg()" key-left="prevImg()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="mt-2">{{index+1}}/{{images.length}}</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="next" ng-click="nextImg()"><i class="fas fa-arrow-right"></i></div>
                    <div class="prev" ng-click="prevImg()"><i class="fas fa-arrow-left"></i></div>
                    <img class="lightBoxImage" ng-src="{{lightBoxSrc}}" ng-swipe-left="nextImg()" ng-swipe-right="prevImg()">
                </div>
            </div>
        </div>
    </div>
</div>