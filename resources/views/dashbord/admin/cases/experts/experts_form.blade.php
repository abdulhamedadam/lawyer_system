<form action="{{ route('admin.add_expert', $all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-4">
            <label for="expert_num" class="form-label">{{ translate('expert_num') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="expert_num" id="expert_num"
                    value="{{ old('expert_num') }}" aria-describedby="basic-addon3">
            </div>
            @error('expert_num')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        @php
            $years = getYears(2000, date('Y'));
        @endphp
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('for_year') }}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="year" id="year"
                        data-placeholder="{{ translate('select') }}">
                        <option value="">{{ translate('select') }}</option>
                        @foreach ($years as $item)
                            <option value="{{ $item }}" {{ old('year', date('Y')) == $item ? 'selected' : '' }}>
                                {{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('year')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="expert_name" class="form-label">{{ translate('expert_name') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="expert_name" id="expert_name"
                    value="{{ old('expert_name') }}" aria-describedby="basic-addon3">
            </div>
            @error('expert_name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>


    </div>

    <div class="col-md-12 row" style="margin-top: 20px">
        <div class="col-md-4">
            <label for="lawyer" class="form-label">{{ translate('lawyer') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="lawyer" id="lawyer"
                        data-placeholder="{{ translate('select') }}">
                        <option value="">{{ translate('Select') }}</option>
                        @foreach ($emps as $item)
                            <option value="{{ $item->id }}" {{ old('lawyer') == $item->id ? 'selected' : '' }}>
                                {{ $item->employee }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('lawyer')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="visit_date" class="form-label">{{ translate('visit_date') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="visit_date" id="visit_date"
                    value="{{ old('visit_date') }}" aria-describedby="basic-addon3">
            </div>
            @error('visit_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="delivery_date" class="form-label">{{ translate('delivery_date') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="delivery_date" id="delivery_date"
                    value="{{ old('delivery_date') }}" aria-describedby="basic-addon3">
            </div>
            @error('delivery_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="col-md-12" style="margin-top: 20px;">
        <label for="notes" class="form-label">{{ translate('notes') }}</label>
        <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
        @error('notes')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" class="btn btn-success btn-flat">
                <i class="bi bi-save"></i> {{ translate('Save') }}
            </button>
        </div>
    </div>

</form>
