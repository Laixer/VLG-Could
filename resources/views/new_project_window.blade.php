<div class="inmodal">
    <div class="modal-header">
        <h4 class="modal-title">Nieuw project</h4>
        <small class="font-bold">Voeg een nieuw project toe.</small>
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
        <button type="button" class="btn btn-primary" ng-click="ok()">Opslaan</button>
    </div>
</div>
