<form action="{{ route('admin.edary_work_add_agra2', $all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('agra2_num') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-hash fs-2"></i></span>
                <input type="number" class="form-control" name="agra2_num" id="agra2_num"
                    value="{{ old('agra2_num', $newAgra2Num) }}" aria-describedby="basic-addon3" readonly>
            </div>
            @error('agra2_num')
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
            <label for="basic-url" class="form-label">{{ translate('agra2_date') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar2 fs-2"></i></span>
                <input type="date" class="form-control" name="agra2_date" id="agra2_date"
                    value="{{ old('agra2_date', now()->format('Y-m-d')) }}" aria-describedby="basic-addon3">
            </div>
            @error('agra2_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>


    </div>
    <div class="col-md-12 row" style="margin-top: 20px">
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('agra2_take_place') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-house-door fs-2"></i></span>
                <input type="text" class="form-control" name="agra2_take_place" id="agra2_take_place"
                    value="{{ old('agra2_take_place') }}" aria-describedby="basic-addon3">
            </div>
            @error('agra2_take_place')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="lawyer" class="form-label">{{ translate('lawyer') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="lawyer_id" id="lawyer_id"
                        data-placeholder="{{ translate('select') }}">
                        <option value="">{{ translate('Select') }}</option>
                        @foreach ($emps as $item)
                            <option value="{{ $item->id }}" {{ old('lawyer_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->employee }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('lawyer_id')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 row" style="margin-top: 20px">

            <div class="col-md-12">
                <label for="basic-url" class="form-label">{{ translate('alagra2') }}</label>
                <div class="input-group flex-nowrap">
                    <textarea class="form-control" name="alagra2" id="alagra2" rows="4">{{ old('alagra2') }}</textarea>
                </div>
                @error('alagra2')
                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>

        </div>


    </div>

    <div class="col-md-12 row">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn"
                class="btn btn-success btn-flat ">
                <i class="bi bi-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>


</form>
