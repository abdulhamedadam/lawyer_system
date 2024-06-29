
        <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title"></i> {{translate('task_comments')}}</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <?php if (empty($all_task_comments)) { ?>
                    <span class="text-muted"><?= translate('no_comments_exist') ?></span>
                    <?php } else { ?>
                    <?php foreach ($all_task_comments as $one_comment) {

                    if (isset($one_comment->personal_photo) && $one_comment->personal_photo != $one_comment or $one_comment->personal_photo != null) {
                       // $personal_photo =  asset(Storage::disk('images')->url($one_comment->personal_photo));
                        $personal_photo = asset(Storage::disk('images')->url('1.jpg'));

                    } else {
                        $personal_photo = asset(Storage::disk('images')->url('1.jpg'));


                    }
                    ?>
                        <div class="timeline-item" style="display: flex !important;">
                            <div style="margin-left: 10px">
                                <i class="fas fa-comment-alt fs-2 text-warning"></i>

                            </div>
                            <div class="timeline-item-body" style="width: 100%;">
                                <span class="time span_label"><i class="fas fa-clock"></i> {{ \Illuminate\Support\Carbon::parse($one_comment->created_at)->format('H:i:s') }}</span>
                                <span class="time span_label"><i class="far fa-calendar-alt"></i>{{ \Illuminate\Support\Carbon::parse($one_comment->created_at)->format('Y-m-d') }}</span>

                                <!-- Container for personal image and user name -->
                                <div class="user-info-container" style="display: flex; align-items: center; margin-left: 6px;">
                                    <img style="width: 35px !important; height: 35px !important; border-radius: 50%;" class="img-bordered-sm" src="<?= $personal_photo ?>" alt="user image">

                                    <h6 style="color: blue; font-weight: 600; text-decoration: underline; font-size: 14px; margin-left: 6px;" class="timeline-header"><?= $one_comment->from_user_name ?> </h6>
                                </div>

                                <div class="timeline-body relay_class" style="display: flex; align-items: center; justify-content: space-between;">
                                    <div>
                                        <?= $one_comment->comment ?>
                                    </div>

                                    <!-- Add delete and edit icons -->
                                    <div class="icons">
                                        <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#modalinfo"  style="color: green;"></i>
                                        <a href="{{ route('admin.delete_task_comment',[$one_comment->id,$one_comment->task_id_fk]) }}" onclick="return confirm('<?= translate('delete_alert_msg') ?>');">
                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" id="modalinfo">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title"><?=translate('add_comments')?></h3>


                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1">&times;</i>
                                        </div>

                                    </div>
                                    <form method="post" action="{{ route('admin.update_task_comment',[$one_comment->id,$one_comment->task_id_fk]) }}" enctype="multipart/form-data" id="comment_form">
                                        @csrf
                                        <div class="modal-body"  id="main_comments">
                                            <input type="hidden" name="task_id_fk" value="{{ $one_comment->id }}" />

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ translate('comment') }}</label>
                                                        <input type="text"  name="comment" required="required" class="form-control" value="{{ $one_comment->comment }}"  />

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

                    <?php } ?>
                    <?php } ?>
                </div>

            </div>


        </div>

        @if($details->action_ended='done')
        @include('dashbord.admin.tasks.task_results')
        @endif
        @section('js')
            <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

            {!! JsValidator::formRequest('App\Http\Requests\Admin\task\TaskCommentsRequest', '#comment_form') !!}
        @endsection
