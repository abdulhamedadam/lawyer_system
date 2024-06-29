<div class="row">
    <div class="col-md-12">
        <div class="card" style="margin-right: 20px; margin-left: 20px; margin-top: 5px;">
            <div class="card-body" style="padding: 10px; display: flex; justify-content: space-around;">

                @php
                    use Carbon\Carbon;
                        $today    = Carbon::now()->toDateString();
                        $user_id = auth()->user()->id;
                        $isAdmin = auth()->user()->role_id_fk == 1;
                           $arr_type=[
                                   'create'       =>['create'=>'primary',''=>'secondary'],
                                   'all'          =>['all'=>'primary',''=>'secondary'],
                                   'wared'        =>['wared'=>'primary',''=>'secondary'],
                                   'sader'        =>['sader'=>'primary',''=>'secondary'],
                                   'doing'        =>['doing'=>'primary',''=>'secondary'],
                                   'done'        =>['done'=>'primary',''=>'secondary'],
                                   'delayed'      =>['delayed'=>'primary',''=>'secondary'],
                                   'evaluate'     =>['evaluate'=>'primary',''=>'secondary'],
                                   'cancelled'    =>['cancelled'=>'primary',''=>'secondary'],
                                   'needReply'    =>['needReply'=>'primary',''=>'secondary'],
                                 ]


                @endphp

                <a href="{{ route('admin.tasks') }}" class="btn btn-{{ $type === 'create' ? $arr_type['create'][$type] : $arr_type['create'][''] }} custom-btn">
                    <i class="bi bi-list-check fs-2x"></i>
                    <span class="btn-text"><?= translate('create_tasks') ?></span>
                </a>

                <a href="{{ route('admin.all_task_data') }}" class="btn btn-{{ $type === 'all' ? $arr_type['all'][$type] : $arr_type['all'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('', '', '', '', '', $isAdmin ? '' : $user_id, '')}}</span>
                    <i class="bi bi-check-circle fs-2x"></i>
                    <span class="btn-text"><?= translate('all_tasks') ?></span>
                </a>

                <a href="{{ route('admin.wared_data') }}" class="btn btn-{{ $type === 'wared' ? $arr_type['wared'][$type] : $arr_type['wared'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('', $isAdmin ? '' : $user_id, 'do', '', '', '', '')}}</span>
                    <i class="bi bi-arrow-down-circle fs-2x"></i>
                    <span class="btn-text"><?= translate('incoming_tasks') ?></span>
                </a>

                <a href="{{ route('admin.sader_tasks') }}" class="btn btn-{{ $type === 'sader' ? $arr_type['sader'][$type] : $arr_type['sader'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('', '', 'do', $isAdmin ? '' : $user_id, '', '', '')}}</span>
                    <i class="bi bi-arrow-up-circle fs-2x"></i>
                    <span class="btn-text"><?= translate('outgoing_tasks') ?></span>
                </a>

                <a href="{{ route('admin.doing_tasks') }}" class="btn btn-{{ $type === 'doing' ? $arr_type['doing'][$type] : $arr_type['doing'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('',$isAdmin ? '' : $user_id, 'doing', '', '', '', '')}}</span>
                    <i class="bi bi-clock fs-2x"></i> <!-- Replaced with a clock icon -->
                    <span class="btn-text"><?= translate('doing_tasks') ?></span>
                </a>

                <a href="{{ route('admin.done_tasks') }}" class="btn btn-{{ $type === 'done' ? $arr_type['done'][$type] : $arr_type['done'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('',$isAdmin ? '' : $user_id, 'done', '', '', '', '')}}</span>
                    <i class="bi bi-check-circle fs-2x"></i> <!-- Replaced with a check circle icon -->
                    <span class="btn-text"><?= translate('done_tasks') ?></span>
                </a>


                <a href="{{ route('admin.delayed_tasks') }}" class="btn btn-{{ $type === 'delayed' ? $arr_type['delayed'][$type] : $arr_type['delayed'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task($today,'', '', '', '', '', '')}}</span>
                    <i class="bi bi-clock fs-2x"></i> <!-- Replace with a suitable icon, e.g., "bi-clock" -->
                    <span class="btn-text"><?= translate('delayed_tasks') ?></span>
                </a>

                <a href="{{ route('admin.evaluate_tasks') }}" class="btn btn-{{ $type === 'evaluate' ? $arr_type['evaluate'][$type] : $arr_type['evaluate'][''] }} custom-btn">

                    <span class="badge bg-danger">{{count_task('',$isAdmin ? '' : $user_id, 'do', '', '', '', '')}}</span>
                    <i class="bi bi-clipboard-check fs-2x"></i> <!-- Replace with a suitable icon, e.g., "bi-clipboard-check" -->
                    <span class="btn-text"><?= translate('evaluate_tasks') ?></span>
                </a>

                <a href="{{ route('admin.cancelled_tasks') }}" class="btn btn-{{ $type === 'cancelled' ? $arr_type['cancelled'][$type] : $arr_type['cancelled'][''] }} custom-btn">
                    <?php
                    $user_id = auth()->user()->id;
                    if(auth('admin')->user()->role_id_fk==1)
                    {
                        $count=count_task('','','done','','','','no');
                    }else{
                        $count=count_task('','','done','','','','no');
                    }
                    ?>
                    <span class="badge bg-danger">{{$count}}</span>
                    <i class="bi bi-x-circle fs-2x"></i> <!-- Replace with a suitable icon, e.g., "bi-x-circle" -->
                    <span class="btn-text"><?= translate('Cancelled_tasks') ?></span>
                </a>

                <a href="{{ route('admin.needReply_tasks') }}" class="btn btn-{{ $type === 'needReply' ? $arr_type['needReply'][$type] : $arr_type['needReply'][''] }} custom-btn">
                    <?php
                    $user_id = auth()->user()->id;
                    if(auth('admin')->user()->role_id_fk==1)
                    {
                        $count=count_task('','','do','','','','no');
                    }else{
                        $count=count_task('','','do','',$user_id,'','no');
                    }
                    ?>
                    <span class="badge bg-danger">{{count_task('','', 'do', '', $isAdmin ? '' : $user_id, '', 'no')}}</span>
                    <i class="bi bi-chat-dots fs-2x"></i> <!-- Replace with a suitable icon, e.g., "bi-chat-dots" -->
                    <span class="btn-text"><?= translate('NeedReply_tasks') ?></span>
                </a>

            </div>
        </div>
    </div>
</div>
