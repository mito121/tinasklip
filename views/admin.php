<div ng-controller="adminCtrl">
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto mt-4">
                <form ng-submit="signIn(username, password)">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter email" ng-model="username">                
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" ng-model="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
            </div>
        </div>
    </div>
</div>