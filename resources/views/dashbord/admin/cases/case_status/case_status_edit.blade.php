<form action="{{ route('admin.update_case_status', $case_status_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">
        <div class="col-md-4">
            <label for="lawyer_id" class="form-label">{{ translate('lawyer') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="lawyer_id" id="lawyer_id" data-placeholder="{{ translate('select') }}">
                        <option value="">{{ translate('Select') }}</option>
                        @foreach($emps as $item)
                            <option value="{{ $item->id }}" {{ old('lawyer_id', $case_status_data->lawyer_id) == $item->id ? 'selected' : '' }}>{{ $item->employee }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('lawyer_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('case_status') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="case_status_id" id="case_status_id">
                        <option value="">{{ translate('select') }}</option>
                        @foreach($statuses as $item)
                            <option value="{{ $item->id }}" {{ old('case_status_id', $case_status_data->case_status_id) == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('case_status_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12" style="margin-top: 20px">
        <div class="mb-3">
            <label for="reasons" class="form-label">{{ translate('reasons') }}</label>
            <textarea class="form-control" id="reasons" name="reasons" rows="3">{{ old('reasons', $case_status_data->reasons) }}</textarea>
            @error('reasons')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12" style="margin-top: 20px">
        <div class="mb-3">
            <label for="notes" class="form-label">{{ translate('notes') }}</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $case_status_data->notes) }}</textarea>
            @error('notes')
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
