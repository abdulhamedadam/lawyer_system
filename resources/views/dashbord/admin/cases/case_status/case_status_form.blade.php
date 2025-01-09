
<form action="{{ route('admin.add_case_status',$all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('case_code')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="code" id="code"
                    value="{{old('code')}}" aria-describedby="basic-addon3">
            </div>
            @error('code')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        @php
            $years = getYears(2000, date('Y'));
        @endphp
        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('for_year')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="year" id="year"
                            data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($years as $item)
                            <option
                                value="{{$item}}" {{ old('year',date('Y')) == $item ? 'selected' : '' }}>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('year')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('case_status')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="case_status_id" id="case_status_id"
                            data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($statuses as $item)
                            <option
                                value="{{$item->id}}" {{ old('case_status_id') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @error('case_status_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 row" style="margin-top: 20px">
        <div class="col-md-4">
            <label for="lawyer_id" class="form-label">{{ translate('lawyer') }}</label>
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

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('case_archive_id')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="case_archive_id" id="case_archive_id"
                    value="{{old('case_archive_id')}}" aria-describedby="basic-addon3">
            </div>
            @error('case_archive_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-md-12" style="margin-top: 20px">
        <div class="mb-3">
            <label for="reasons" class="form-label">{{translate('reasons')}}</label>
            <textarea class="form-control" id="reasons" name="reasons" rows="3">{{old('reasons')}}</textarea>
            @error('reasons')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12" style="margin-top: 20px">
        <div class="mb-3">
            <label for="notes" class="form-label">{{translate('notes')}}</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{old('notes')}}</textarea>
            @error('notes')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                <i class="bi bi-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>

</form>
