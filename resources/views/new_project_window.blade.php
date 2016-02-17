<div class="inmodal">
    <div class="modal-header">
        <h4 class="modal-title">Nieuw project</h4>
        <small class="font-bold">Voeg een nieuw project toe.</small>
        <div class="text-danger" ng-show="error">@{{ error }}</div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Naam</label>
            <input type="text" placeholder="Projectnaam" ng-model="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Nummer</label>
            <input type="text" placeholder="Projectnummer" ng-model="number" class="form-control">
        </div>
        <div class="form-group">
            <label>Referentie</label>
            <input type="text" placeholder="Referentie" ng-model="reference" class="form-control">
        </div>
        <div class="form-group">
            <label>Werkveld</label>
            <select class="form-control" ng-model="workfield">
                <option ng-repeat="field in fields" value="@{{ field.id }}">@{{ field.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Opdrachtgever</label>
            <select class="form-control" ng-model="client">
                <option ng-repeat="company in companies" value="@{{ company.id }}">@{{ company.name }}</option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
        <button type="button" class="btn btn-primary" ng-click="ok()">Opslaan</button>
    </div>
</div>
