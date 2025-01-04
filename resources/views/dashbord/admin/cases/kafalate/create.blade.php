
<form action="{{ route('admin.add_kafalate',$all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-2">
            <label for="basic-url" class="form-label">{{translate('kafala_num')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="kafala_num" id="kafala_num"
                       value="{{old('kafala_num')}}" aria-describedby="basic-addon3">
            </div>
            @error('kafala_num')
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
            <label for="basic-url" class="form-label">{{translate('qasema_num')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="qasema_num" id="qasema_num"
                       value="{{old('qasema_num')}}" aria-describedby="basic-addon3">
            </div>
            @error('qasema_num')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('paper_num')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="paper_num" id="paper_num"
                       value="{{old('paper_num')}}" aria-describedby="basic-addon3">
            </div>
            @error('paper_num')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>



    </div>
    <div class="col-md-12 row" style="margin-top: 20px">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('kafala_value')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="number" class="form-control" name="kafala_value" id="kafala_value"
                       value="{{old('mo7dareen_pen')}}" aria-describedby="basic-addon3">
            </div>
            @error('kafala_value')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('payment_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" class="form-control" name="payment_date" id="payment_date"
                       value="{{old('payment_date')}}" aria-describedby="basic-addon3">
            </div>
            @error('payment_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>


    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="notes" class="form-label">{{translate('al7ukm')}}</label>
            <textarea class="form-control" id="al7ukm" name="al7ukm" rows="3">{{old('al7ukm')}}</textarea>
            @error('al7ukm')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12" style="margin-top: 10px">
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
                <i class="fa fa-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>

</form>
