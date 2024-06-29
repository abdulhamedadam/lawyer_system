<form method="post" action="{{ route('admin.add_notes',$all_data->id) }}" enctype="multipart/form-data">
    @csrf

        <div class="col-md-12" style="margin-top: 10px">
            <div class="mb-3">
                <label for="exampleTextarea" class="form-label">{{translate('notes')}}</label>
                <textarea class="form-control" name="notes" id="exampleTextarea" rows="3">{{old('notes')}}</textarea>
                @error('notes')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat" style="border-radius: 0; font-size: 16px;">
                <i class="fa fa-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>



</form>
