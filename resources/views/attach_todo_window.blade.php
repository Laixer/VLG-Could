<div class="inmodal">
    <div class="modal-header">
        <h4 class="modal-title">@{{ report.name }}</h4>
        <small class="font-bold">Voeg informatie aanvraag toe aan bestand.</small>
    </div>
    <div class="modal-body">
        <label>Opgevraagde informatie</label>
        <select class="form-control" ng-model="todo">
            <option ng-repeat="todo in todos" value="@{{ todo.id }}">@{{ todo.message }}</option>
        </select>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
        <button type="button" class="btn btn-primary" ng-click="ok()">Koppelen</button>
    </div>
</div>
