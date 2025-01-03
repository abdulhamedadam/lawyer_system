<form action="{{ route('admin.case_update_mo7dareen',$mo7dareen_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-2">
            <label for="basic-url" class="form-label">{{translate('mo7dareen_num')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="mo7dareen_num" id="mo7dareen_num"
                       value="{{old('mo7dareen_num',$mo7dareen_data->mo7dareen_num)}}" aria-describedby="basic-addon3">
            </div>
            @error('paid_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        @php
            $years = getYears(2000, date('Y'));
        @endphp
        <div class="col-md-2">
            <label for="basic-url" class="form-label">{{translate('for_year')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="year" id="year"
                            data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($years as $item)
                            <option
                                value="{{$item}}" {{ old('year',$mo7dareen_data->year) == $item ? 'selected' : '' }}>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('year')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('delivery_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="delivery_date" id="delivery_date"
                       value="{{old('delivery_date',$mo7dareen_data->delivery_date)}}" aria-describedby="basic-addon3">
            </div>
            @error('delivery_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('lawyer')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="lawyer" id="lawyer"
                            data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($emps as $item)
                            <option
                                value="{{$item->id}}" {{ old('lawyer',$mo7dareen_data->lawyer) == $item->id ? 'selected' : '' }}>{{$item->employee}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('lawyer')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-md-12 row" style="margin-top: 20px">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('mo7dareen_pen')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="mo7dareen_pen" id="mo7dareen_pen"
                       value="{{old('mo7dareen_pen',$mo7dareen_data->mo7dareen_pen)}}" aria-describedby="basic-addon3">
            </div>
            @error('mo7dareen_pen')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('session_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="session_date" id="session_date"
                       value="{{old('session_date',$mo7dareen_data->session_date)}}" aria-describedby="basic-addon3">
            </div>
            @error('session_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>


    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="notes" class="form-label">{{translate('notes')}}</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{old('notes',$mo7dareen_data->notes)}}</textarea>
            @error('notes')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                <i class="fa fa-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>
</form>
