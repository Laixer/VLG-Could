<div class="inmodal">
    <div class="modal-header">
        <h4 class="modal-title">@{{ report.name }}</h4>
        <small class="font-bold">Voeg informatie aanvraag toe aan bestand.</small>
    </div>
    <div class="modal-body">

        <h4 ng-show="showReportOptions() && write">Document beschikbaar stellen als rapportage</h4>
        <div class="form-group" ng-show="showReportOptionsFinal() &&write">
            <label><input icheck2 type="checkbox" ng-model="done"> Definitief</label>
        </div>
        <div class="form-group" ng-show="showReportOptionsConcept() &&write">
            <label>Versie</label>
            <input type="number" min="1" placeholder="Documentversie" ng-disabled="done" ng-model="version" class="form-control">
        </div>
        
        <hr ng-show="showTodo() && write" />
        <div class="form-group" ng-show="showTodo()">
            <label>Document koppelen aan opgevraagde informatie</label>
            <select class="form-control" ng-model="todo">
                <option ng-repeat="todo in todos" value="@{{ todo.id }}">@{{ todo.message }}</option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
        <button type="button" class="btn btn-primary" ng-click="ok()">Opslaan</button>
    </div>
</div>
