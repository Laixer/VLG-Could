<div class="inmodal">
    
        <div class="modal-header">
            <h4 class="modal-title">Projectopties</h4>
        </div>
        <div class="modal-body">
            <form role="form" name="option" novalidate>
                <h3>Mailherinneringen</h3>
                <div class="form-group">
                    <label>Eerste herinnering na dag</label>
                    <input type="number" min="1" max="99" placeholder="Dagen" name="email_interval_1" ng-model="interval1" class="form-control" required>

                    <div class="m-t-xs" ng-show="option.email_interval_1.$invalid && option.email_interval_1.$dirty">
                        <small class="text-danger" ng-show="option.email_interval_1.$error.required">Geef een waarde op</small>
                    </div>
                </div>
                <div class="m-b">Tweede herinnering volgt na dag @{{ interval1 * 2 }}</div>
                <div class="form-group">
                    <label>Laatste herinnering na dag</label>
                    <input type="number" min="1" max="99" placeholder="Dagen" name="email_interval_2" ng-model="interval2" class="form-control" required>

                    <div class="m-t-xs" ng-show="option.email_interval_2.$invalid && option.email_interval_2.$dirty">
                        <small class="text-danger" ng-show="option.email_interval_2.$error.required">Geef een waarde op</small>
                    </div>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" ng-click="cancel()">Sluiten</button>
            <button type="button" class="btn btn-primary" ng-disabled="!option.$valid" ng-click="ok()">Opslaan</button>
        </div>
</div>
