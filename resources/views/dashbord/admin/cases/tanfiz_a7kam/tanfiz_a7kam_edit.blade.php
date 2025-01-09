<form action="{{ route('admin.update_tanfiz_a7kam', $tanfiz_A7kam_data->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('partial_num') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="partial_num" id="partial_num"
                    value="{{ old('partial_num', $tanfiz_A7kam_data->partial_num) }}" aria-describedby="basic-addon3">
            </div>
            @error('partial_num')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        @php
            $years = getYears(2000, date('Y'));
        @endphp
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('for_year') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="year" id="year"
                        data-placeholder="{{ translate('select') }}">
                        <option value="">{{ translate('select') }}</option>
                        @foreach ($years as $item)
                            <option value="{{ $item }}"
                                {{ old('year', $tanfiz_A7kam_data->year) == $item ? 'selected' : '' }}>
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
            <label for="basic-url" class="form-label">{{ translate('tanfiz_circle') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="tanfiz_circle" id="tanfiz_circle"
                    value="{{ old('tanfiz_circle', $tanfiz_A7kam_data->tanfiz_circle) }}"
                    aria-describedby="basic-addon3">
            </div>
            @error('tanfiz_circle')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12 row" style="margin-top: 20px">
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('elkady_name') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="elkady_name" id="elkady_name"
                    value="{{ old('elkady_name', $tanfiz_A7kam_data->elkady_name) }}" aria-describedby="basic-addon3">
            </div>
            @error('elkady_name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('elmarkaz') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="elmarkaz" id="elmarkaz"
                    value="{{ old('elmarkaz', $tanfiz_A7kam_data->elmarkaz) }}" aria-describedby="basic-addon3">
            </div>
            @error('elmarkaz')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{ translate('el7okm_date') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="el7okm_date" id="el7okm_date"
                    value="{{ old('el7okm_date', $tanfiz_A7kam_data->el7okm_date) }}" aria-describedby="basic-addon3">
            </div>
            @error('el7okm_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="col-md-4" style="margin-top: 10px">
        <label for="basic-url" class="form-label">{{ translate('court_name') }}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
            <div class="overflow-hidden flex-grow-1">
                <select class="form-select rounded-start-0" name="court" id="court"
                    data-placeholder="{{ translate('select') }}">
                    <option value="">{{ translate('select') }}</option>
                    @foreach ($courts as $item)
                        <option value="{{ $item->id }}"
                            {{ old('court', $tanfiz_A7kam_data->court) == $item->id ? 'selected' : '' }}>
                            {{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('court')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="el7okm" class="form-label">{{ translate('el7okm') }}</label>
            <textarea class="form-control" id="el7okm" name="el7okm" rows="3">{{ old('el7okm', $tanfiz_A7kam_data->el7okm) }}</textarea>
            @error('el7okm')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="update" value="update" class="btn btn-success btn-flat">
                <i class="bi bi-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>
</form>
