

<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11"> <!-- Increase the width to 12 columns -->
                    <a style="font-size: 16px" data-bs-toggle="modal" data-bs-target="#modal_comments" class="btn btn-success p-3"> <!-- Increase padding and change text size -->
                        <i class="fas fa-comment-alt fs-2"></i> <?=translate('add_comments')?> <!-- Change icon and increase icon size -->
                    </a>

                    <a style="font-size: 16px" data-bs-toggle="modal" data-bs-target="#modal_mad" class="btn btn-primary p-3">
                        <i class="fas fa-clock fs-2"></i> <?=translate('task_extension')?> <!-- Change icon and increase icon size -->
                    </a>
                </div>

                <div class="col-md-1 text-end"> <!-- Increase the width to 12 columns -->
                    <a style="font-size: 16px" class="btn btn-warning" href="{{ route('admin.all_task_data') }}">
                        <i class="bi bi-arrow-repeat fs-3"></i>{{translate('back')}} <!-- Increase icon size -->
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" id="modal_comments">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?=translate('add_comments')?></h3>


                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>
            <form method="post" action="{{ route('admin.add_task_comment', $details->id) }}" enctype="multipart/form-data" id="comment_form">
                @csrf
            <div class="modal-body"  id="main_comments">
            <input type="hidden" name="task_id_fk" value="{{ $details->id }}" />

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ translate('comment') }}</label>
                        <input type="text"  name="comment" required="required" class="form-control" placeholder="{{ translate('comment') }}" />

                    </div>
                </div>

            </div>
            </div>
            <div class="modal-footer ">

                <button type="submit" name="add_comment" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>  <?=translate('save')?> </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=translate('cancel')?></button>
            </div>

            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="modal_mad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?=translate('extend_date')?></h3>


                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>
            <form method="post" action="{{ route('admin.extend_task_date',$details->id) }}" enctype="multipart/form-data" id="date_extend">
                @csrf
                    @if($details->action_ended!='done')
                <div class="modal-body"  id="main_comments">
                    <input type="hidden" name="task_id_fk" value="{{ $details->id }}" />


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ translate('to_date') }}</label>
                                <input type="date"  name="to_date" min="{{$details->end_date}}" value="{{$details->end_date}}" required="required" class="form-control"  />

                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 8px">
                            <div class="form-group">
                                <label>{{ translate('reasons') }}</label>
                                <input type="text"  name="last_mad_notes"  required="required" placeholder="{{translate('reasons')}}" class="form-control"  />

                            </div>
                        </div>



                </div>
                <div class="modal-footer ">

                    <button type="submit" name="add_comment" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>  <?=translate('save')?> </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?=translate('cancel')?></button>
                </div>
                        @endif

            </form>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\task\TaskCommentsRequest', '#comment_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Admin\task\ExtendDateRequest', '#date_extend') !!}
    @endsection
