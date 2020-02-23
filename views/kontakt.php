<div ng-controller="mainCtrl" class="container">
    <div class="row">
        <div class="col-3 col mx-auto">
            <h2>Telefontid</h2>

            <table class="openHrs">
                <tr>
                    <td>Mandag</td><td>07:00 - 18:00</td>
                </tr>
                <tr>
                    <td>Tirsdag</td><td>07:00 - 18:00</td>
                </tr>
                <tr>
                    <td>Onsdag</td><td>07:00 - 18:00</td>
                </tr>
                <tr>
                    <td>Torsdag</td><td>07:00 - 18:00</td>
                </tr>
                <tr>
                    <td>Fredag</td><td>07:00 - 18:00</td>
                </tr>
                <tr>
                    <td>Lørdag</td><td>Lukket.</td>
                </tr>
                <tr>
                    <td>Søndag</td><td>Lukket.</td>
                </tr>
            </table>
        </div>
        <div class="col-6 col ml-auto">
            <h2>For tidsbestilling</h2>

            <p>Ring til mig på tlf. <a href="tel:20359204" class="big-link">20 35 92 04</a></p>
            <p>Eller send en mail til <a href="mailto:tinasklip@gmail.com?Subject=Tidsbestilling" class="big-link" target="_top">Tinasklip@gmail.com</a></p>
            <p>Jeg kører på hele Fyn og omegn.</p>

            <ng-map zoom="8" center="[55.346840, 10.343980]">
                <info-window id="tkInfoWindow">
                    <div ng-non-bindable>
                        <h6><strong>Tinas Klip & Krøl</strong></h6>
                    </div>
                </info-window>
                <marker position="[55.346840, 10.343980]" title="Tinas Klip & Krøl" on-click="showInfo()"></marker>
            </ng-map>
        </div>
    </div>
</div>