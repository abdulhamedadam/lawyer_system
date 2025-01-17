<form action="{{ route('admin.edary_work_add_payments', $all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="col-md-12 row">

    <div class="col-md-4">
        <label for="basic-url" class="form-label">{{translate('paid_date')}}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar2 fs-2"></i></i></span>
            <input type="date" class="form-control" name="paid_date" id="paid_date" value="{{old('paid_date', \Carbon\Carbon::now()->toDateString())}}" aria-describedby="basic-addon3">
        </div>
        @error('paid_date')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="basic-url" class="form-label">{{translate('recieved_from')}}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></i></span>
            <input type="text" class="form-control" name="person_name" id="person_name" value="{{old('person_name', $all_data->client->name)}}" aria-describedby="basic-addon3" readonly>
        </div>
        @error('person_name')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="basic-url" class="form-label">{{translate('phone')}}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-telephone-fill fs-2"></i></span>
            <input type="text" class="form-control" name="person_phone" id="person_phone" value="{{old('person_phone', $all_data->client->phone_number)}}" aria-describedby="basic-addon3" readonly>
        </div>
        @error('person_phone')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

</div>
<div class="col-md-12 row" style="margin-top: 20px">

    <div class="col-md-4">
        <label for="basic-url" class="form-label">{{translate('paid_value')}}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-currency-dollar fs-2"></i></span>
            <input type="number" step="0.01" class="form-control" name="paid_value" id="paid_value" value="{{old('paid_value')}}" aria-describedby="basic-addon3">
        </div>
        @error('paid_value')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-8">
        <label for="basic-url" class="form-label">{{translate('this_about')}}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-chat-dots fs-2"></i></span>
            <input type="text" class="form-control" name="notes" id="notes" value="{{old('notes')}}" aria-describedby="basic-addon3">
        </div>
        @error('notes')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>


    <div class="col-md-12">
        <div class="form-group text-end" style="margin-top: 27px;">
            <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                <i class="bi bi-save"></i> <?= translate('SaveButton') ?>
            </button>
        </div>
    </div>
</div>


</form>
