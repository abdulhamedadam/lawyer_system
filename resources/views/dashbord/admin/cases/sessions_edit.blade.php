<form action="{{ route('admin.case_update_session',$session_data->id) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf

    <div class="col-md-12 row">

        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('cases')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down-fill fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="case_id" id="case_id"    data-placeholder="{{translate('select')}}" >
                        <option value="">{{translate('select')}}</option>
                        @foreach($cases as $item)
                            <option value="{{ $item->id }}" {{ old('case_id',$session_data->id) == $item->id ? 'selected' : '' }}>{{$item->case_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('case_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('session_title')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">#</span>
                <input type="text" class="form-control" name="session_title" id="session_title" value="{{old('session_title',$session_data->session_title)}}" aria-describedby="basic-addon3">
            </div>
            @error('session_title')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>



    </div>
    <div class="col-md-12 row" style="margin-top: 20px">

        <div class="col-md-3">
            <label for="basic-url" class="form-label">{{translate('session_date')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                <input type="date" class="form-control" name="session_date" id="session_date" value="{{old('session_date',$session_data->session_date)}}" aria-describedby="basic-addon3">
            </div>
            @error('session_date')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="basic-url" class="form-label">{{translate('session_time')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                <input type="time" class="form-control" name="session_time" id="session_time" value="{{old('session_time',$session_data->session_time)}}" aria-describedby="basic-addon3">
            </div>
            @error('session_time')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('assign_to')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="esnad_to" id="esnad_to"    data-placeholder="{{translate('select')}}">
                        <option value="">{{translate('select')}}</option>
                        @foreach($emps as $item)
                            <option value="{{$item->id}}" {{ old('esnad_to',$session_data->emp_id) == $item->id ? 'selected' : '' }}>{{$item->employee}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('esnad_to')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>


    <div class="col-md-12 row">
        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('court')}}</label>
            <div class="input-group flex-nowrap ">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down-fill fs-2"></i></span>
                <div class="overflow-hidden flex-grow-1">
                    <select class="form-select rounded-start-0" name="court_id" id="court_id"    data-placeholder="{{translate('select')}}" >
                        <option value="">{{translate('select')}}</option>
                        @foreach($courts as $item)
                            <option value="{{ $item->id }}" {{ old('court_id',$session_data->court_id) == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('court_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="basic-url" class="form-label">{{translate('session_judge')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">#</span>
                <input type="text" class="form-control" name="session_judge" id="session_judge" value="{{old('session_judge',$session_data->session_judge)}}" aria-describedby="basic-addon3">
            </div>
            @error('session_judge')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">{{translate('requirements')}}</label>
            <textarea class="form-control" name="session_requirements" id="exampleTextarea" rows="3">{{old('session_requirements',$session_data->session_requirements)}}</textarea>
            @error('session_requirements')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">{{translate('session_notes')}}</label>
            <textarea class="form-control" name="session_notes" id="exampleTextarea" rows="3">{{old('session_notes',$session_data->session_notes)}}</textarea>
            @error('session_notes')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>



    </div>

    <div class="modal-footer">
        <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
            <i class="bi bi-save fs-2x"></i> <?= translate('SaveButton') ?>
        </button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    </div>
</form>
