<div ng-controller="galleryCtrl" class="container" ng-init="getGallery()">

    <div class="row" ng-if="getLogged() == true">
        <div class="col-6 mx-auto mt-4">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addImageForm" aria-expanded="false" aria-controls="addImageForm">
                Tilføj billede
            </button>

            <div class="collapse m-4 loading-container" id="addImageForm">
                <form ng-submit="addImage()" name="imageForm" role="form">
                    <div class="imgPreview"><img ng-src="{{image_source}}"></div>
                    <input ng-model="imageForm.image" type="file" id="imageInput" accept="image/*" onchange="angular.element(this).scope().uploadedFile(this)">
                    <button type="submit" class="btn btn-success">Upload <i class="fas fa-upload"></i></button>	
                </form>
                <!-- loading gif -->
                <div class="loading-gif" ng-show="loading"><img src="assets/img/loading.gif"></div>
                <p>{{response}}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 gallery-wrapper">
            <div class="gallery-container" ng-repeat="img in gallery" on-finish-render="ngRepeatFinished">
                <i class="fas fa-trash-alt manage delete" ng-if="getLogged() == true" ng-click="deleteImg(img.id)"></i>
                <img class="img-responsive" ng-src="uploads/small/{{img.name}}" ng-click="setLightbox(img.id)" >
            </div>
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