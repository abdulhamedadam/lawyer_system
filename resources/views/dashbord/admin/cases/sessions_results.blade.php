
<form action="{{ route('admin.case_update_session_results',$session_data->id) }}" method="post" enctype="multipart/form-data" id="form2">
    @csrf
<div class="col-md-12" style="margin-top: 10px">
    <div class="mb-3">
        <label for="exampleTextarea" class="form-label">{{translate('session_results')}}</label>
        <textarea class="form-control" name="session_results" id="exampleTextarea" rows="3">{{old('session_results',$session_data->session_results)}}</textarea>
        @error('session_results')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>

    </div>

    <div class="modal-footer">
        <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
            <i class="bi bi-save fs-2x"></i> <?= translate('SaveButton') ?>
        </button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>
</form>
