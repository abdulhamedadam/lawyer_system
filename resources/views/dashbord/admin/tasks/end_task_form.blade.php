<form method="post" action="{{ route('admin.save_end_task',$details->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">{{translate('end_reasons')}}</label>
            <textarea class="form-control" name="act_ended_reason" id="act_ended_reason" rows="3">{{old('act_ended_reason')}}</textarea>
        </div>
            @error('act_ended_reason')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">{{translate('task_results')}}</label>
            <textarea class="form-control" name="act_ended_result" id="act_ended_result" rows="3">{{old('act_ended_result')}}</textarea>
        </div>
            @error('act_ended_result')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <label for="basic-url"class="form-label">{{translate('attachment')}}</label>
        <input   class="form-control " type="file" name="file[]" id="file" aria-describedby="basic-addon3" multiple>
        @if ($errors->has('file.*'))
            <span class="invalid-feedback d-block" role="alert">{{ $errors->first('file.*') }}</span>
        @endif
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat" style="border-radius: 0; font-size: 16px;">
                <i class="fa fa-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>



</form>
