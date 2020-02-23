<div ng-controller="mainCtrl" class="container" ng-init="getServices()">

    <div class="row" ng-if="getLogged() == true">
        <div class="col-6 mx-auto mt-4">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addServiceForm" aria-expanded="false" aria-controls="addServiceForm">
                Tilføj ydelse
            </button>

            <form ng-submit="addService(name, price)" id="addServiceForm" class="collapse">
                <div class="form-group">
                    <label for="name">Navn på ydelse</label>
                    <input type="text" class="form-control" id="name" ng-model="$parent.name">                
                </div>

                <div class="form-group">
                    <label for="price">Pris</label>
                    <input type="text" class="form-control" id="price" ng-model="$parent.price">
                </div>

                <button type="submit" class="btn btn-success">Tilføj</button>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-6 col mx-auto">
            <h2 class="text-center m-4">Priser & ydelser</h2>
            <ul class="pricelist">
                <li ng-repeat="service in services">
                    <span>{{service.name}}</span>
                    <span>{{service.price}} kr 
                        <i class="fas fa-edit manage edit" ng-if="getLogged() == true" ng-click="editModal(service.id)"></i>
                        <i class="fas fa-trash-alt manage delete" ng-if="getLogged() == true" ng-click="deleteService(service.id)"></i>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Rediger ydelse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ng-submit="editService(serviceId, newServiceName, newServicePrice)">
                        <input type="hidden" ng-model="serviceId">
                        <div class="form-group">
                            <label for="newName">Navn:</label>
                            <input type="text" class="form-control" id="newName" placeholder="Indtast navn" ng-model="newServiceName">                
                        </div>

                        <div class="form-group">
                            <label for="newPrice">Pris:</label>
                            <input type="text" class="form-control" id="newPrice" placeholder="Password" ng-model="newServicePrice">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Gem ændringer</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annullér</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>