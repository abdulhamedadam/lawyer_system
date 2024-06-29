<form action="{{ route('admin.case_add_tasks',$all_data->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('creation_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                <input type="date" class="form-control" name="ensha_data" id="ensha_data" value="{{old('ensha_data', \Carbon\Carbon::now()->toDateString())}}" aria-describedby="basic-addon3">
            </div>
            @error('ensha_data')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('task_name')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="fas fa-user fs-2"></i></span>
                <input type="text" class="form-control" name="task_name" id="task_name" value="{{old('task_name')}}" aria-describedby="basic-addon3">
            </div>
            @error('task_name')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('assign_to')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="esnad_to" id="esnad_to"    data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($emps as $item)
                            <option value="{{$item->id}}" {{ old('esnad_to') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('esnad_to')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-md-12 row" style="margin-top: 20px">

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('priority')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="priority" id="priority"    data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($priority as $item)
                            <option value="{{$item->id}}" {{ old('priority') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('priority')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('start_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{old('ensha_data')}}" aria-describedby="basic-addon3">
            </div>
            @error('start_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="basic-url" class="form-label">{{translate('end_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{old('end_date')}}" aria-describedby="basic-addon3">
            </div>
            @error('end_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>


    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">{{translate('details')}}</label>
            <textarea class="form-control" name="details" id="exampleTextarea" rows="3">{{old('details')}}</textarea>
            @error('details')
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
