<div>
    <div class="modal fade" tabindex="-1" id="modalsettings">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?=translate('recieve_task')?></h3>


                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>
                <form wire:submit.prevent="saveSettings">
                    <div class="row col-md-12" style="margin-top: 10px">
                        <div class="col-md-6" >
                            <label for="setting_name" class="form-label">{{translate('name')}}</label>
                            <input class="form-control" name="setting_name" id="setting_name" value="" >
                        </div>
                        <div class="col-md-6" >

                            <label for="color" class="form-label">{{translate('color')}}</label>
                            <input class="form-control" name="color" id="takeemcolor_reason" value="" >
                        </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 10px">
                        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                    </div>
                </form>


            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive" >
            <table id="table1" class="table table-bordered">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th style="width: 5%"{{translate('m')}}<</th>
                    <th style="text-align: center"><i class="fas fa-user"></i> {{translate('name')}}</th>
                    <th style="text-align: center"><i class="fas fa-user"></i> {{translate('color')}}</th>
                    <th style="width: 20%; text-align: center"><i class="fas fa-cogs"></i> {{translate('actions')}}</th>
                </tr>
                </thead>
                <tbody>

            </table>
        </div>
    </div>
</div>
