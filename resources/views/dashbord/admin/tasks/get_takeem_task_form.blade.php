<form method="post" action="{{route('admin.save_takeem_task',$task_id)}}" enctype="multipart/form-data" id="takeem_form">
    @csrf
    <div class="modal-body">
        <div class="row col-md-12" style="margin-top: 10px">
            <div class="col-md-3">
                <label for="basic-url" class="form-label">{{translate('do_necessary')}}</label>
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                    <div class="overflow-hidden flex-grow-1">
                        <select class="form-select rounded-start-0" name="do_necessary" id="do_necessary"    data-placeholder="{{translate('select')}}">
                            <option value="yes" {{ $all_task_data->amal_elazem == 'yes' ? 'selected' : '' }}>{{translate('yes')}}</option>
                            <option value="no" {{ $all_task_data->amal_elazem == 'no'? 'selected' : '' }}>{{translate('no')}}</option>
                        </select>
                    </div>
                </div>
            </div>

             <div class="col-md-9" >

                <label for="exampleTextarea" class="form-label">{{translate('reason')}}</label>
                <input class="form-control" name="takeem_reason" id="takeem_reason" value="{{$all_task_data->takeem_reason}}" >
            </div>

       </div>
        <div class="row col-md-12" style="margin-top: 10px">
            <div class="col-md-4">
                <label for="basic-url" class="form-label">{{translate('time_commitment')}}</label>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="basic-addon3">%100</span>
                    <input type="number" class="form-control" min="0" max="100" name="takeem_time_work" id="takeem_time_work" value="{{$all_task_data->takeem_time_work}}" aria-describedby="basic-addon3">
                </div>
            </div>

            <div class="col-md-4">
                <label for="basic-url" class="form-label">{{translate('completeness')}}</label>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="basic-addon3">%100</span>
                    <input type="number" class="form-control" min="0" max="100" name="takeem_complet" id="takeem_complet" value="{{$all_task_data->takeem_complet}}" aria-describedby="basic-addon3">
                </div>
            </div>

            <div class="col-md-4">
                <label for="basic-url" class="form-label">{{translate('accuracy')}}</label>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="basic-addon3">%100</span>
                    <input type="number" class="form-control" min="0" max="100" name="accuracy" id="accuracy" value="{{$all_task_data->takeem_gwda}}" aria-describedby="basic-addon3">
                </div>
            </div>
        </div>


    <div class="modal-footer" style="margin-top: 10px">
        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
    </div>

</form>
@section('js')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\task\TakeemTaskRequest', '#takeem_form') !!}
@endsection

