<form action="{{ route('admin.case_update_mraf3a', $mraf3a_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-4">
            <label for="source" class="form-label">{{ translate('source') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="source" id="source"
                    value="{{ old('source', $mraf3a_data->source) }}" aria-describedby="basic-addon3">
            </div>
            @error('source')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="mraf3a_name" class="form-label">{{ translate('mraf3a_name') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="mraf3a_name" id="mraf3a_name"
                    value="{{ old('mraf3a_name', $mraf3a_data->mraf3a_name) }}" aria-describedby="basic-addon3">
            </div>
            @error('mraf3a_name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="addition_date" class="form-label">{{ translate('addition_date') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('calendar') !!}</span>
                <input type="date" class="form-control" name="addition_date" id="addition_date"
                    value="{{ old('addition_date', $mraf3a_data->addition_date) }}" aria-describedby="basic-addon3">
            </div>
            @error('addition_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="col-md-12" style="margin-top: 20px">
        <div class="mb-3">
            <label for="mraf3a_text" class="form-label">{{ translate('mraf3a_text') }}</label>
            <textarea class="form-control" id="mraf3a_text" name="mraf3a_text" rows="3">{{ old('mraf3a_text', $mraf3a_data->mraf3a_text) }}</textarea>
            @error('mraf3a_text')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="update" value="update" class="btn btn-success btn-flat">
                <i class="bi bi-save"></i> {{ translate('SaveButton') }}
            </button>
        </div>
    </div>
</form>
