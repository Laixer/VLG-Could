<div class="inmodal">
    
        <div class="modal-header">
            <h4 class="modal-title">Nieuw project</h4>
            <small class="font-bold">Voeg een nieuw project toe.</small>
        </div>
        <div class="modal-body">
            <form role="form" name="newproject" novalidate>
                <div class="form-group">
                    <label>Naam</label>
                    <input type="text" placeholder="Projectnaam" name="name" ng-model="name" class="form-control" required>

                    <div class="m-t-xs" ng-show="newproject.name.$invalid && newproject.name.$dirty">
                        <small class="text-danger" ng-show="newproject.name.$error.required">Geef een projectnaam op</small>
                    </div>
                    <div class="m-t-xs" ng-show="newproject.name.used">
                        <small class="text-danger">Projectnaam bestaat al</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nummer</label>
                    <input type="text" placeholder="Projectnummer" name="number" ng-model="number" class="form-control" required>

                    <div class="m-t-xs" ng-show="newproject.number.$invalid && newproject.number.$dirty">
                        <small class="text-danger" ng-show="newproject.number.$error.required">Geef een projectnummer op</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Referentie</label>
                    <input type="text" placeholder="Referentie" ng-model="reference" name="reference" class="form-control" required>

                    <div class="m-t-xs" ng-show="newproject.reference.$invalid && newproject.reference.$dirty">
                        <small class="text-danger" ng-show="newproject.reference.$error.required">Geef een referentie op</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Werkveld</label>
                    <select class="form-control" ng-model="workfield" required>
                        <option ng-repeat="field in fields" value="@{{ field.id }}">@{{ field.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Opdrachtgever</label>
                    <select class="form-control" ng-model="client" ng-change="reloadClients()" required>
                        <option ng-repeat="company in companies" value="@{{ company.id }}">@{{ company.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <select class="form-control" ng-model="client_contact" required>
                        <option ng-repeat="contact in contacts" value="@{{ contact.id }}">@{{ contact.name }}</option>
                    </select>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
            <button type="button" class="btn btn-primary" ng-disabled="!newproject.$valid" ng-click="ok()">Opslaan</button>
        </div>
</div>
