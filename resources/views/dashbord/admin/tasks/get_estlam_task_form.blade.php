<form method="post" action="{{route('admin.save_estlam_task',$task_id)}}" enctype="multipart/form-data" id="estlam_form">
    @csrf
    <div class="modal-body">
        <div class="col-md-12" style="margin-top: 10px">
        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('receive_task')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="estlam_option" id="estlam_option"    data-placeholder="{{translate('select')}}">
                        <option value="yes">{{translate('yes')}}</option>
                        <option value="no">{{translate('no')}}</option>
                    </select>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-12" style="margin-top: 10px">
            <div class="mb-3">
                <label for="exampleTextarea" class="form-label">{{translate('notes')}}</label>
                <textarea class="form-control" name="notes" id="exampleTextarea" rows="3">{{old('notes')}}</textarea>
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
    </div>

</form>

