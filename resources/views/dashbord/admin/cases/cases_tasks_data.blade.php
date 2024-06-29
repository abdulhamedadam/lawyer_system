<div class="" style="margin-top: 30px; padding: 20px">
    @if(isset($tasks_data) && !empty($tasks_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('ensha_data') }}</th>
                <th>{{ translate('task_name') }}</th>
                <th>{{ translate('assign_to') }}</th>
                <th>{{ translate('start_date') }}</th>
                <th>{{ translate('end_date') }}</th>
                <th>{{ translate('priority') }}</th>
                <th>{{ translate('task_status') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($tasks_data as $item)

                @php
                    $status = [
                        'do'    => '<span style="background-color: lightblue;" class="span_data_table">' . translate('do') . '</span>',
                        'doing' => '<span style="background-color: lightcoral;" class="span_data_table">' . translate('doing') . '</span>',
                        'done'  => '<span style="background-color: lightcoral;" class="span_data_table">' . translate('done') . '</span>',
                    ];
                @endphp

                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: #ff0000">{{ $item->ensha_date }}</td>
                    <td style="color: purple">{{ $item->task_name }}</td>
                    <td style="color: black">{{ $item->to_emp }}</td>
                    <td style="color: blue; text-decoration: underline">{{ $item->start_date }}</td>
                    <td style="color: #008000;text-decoration: underline">{{ $item->end_date }}</td>
                    <td><span style="background-color: {{$item->priority_color}};" class="span_data_table">{{ $item->priority }}</span></td>
                    <td>{!! $status[$item->action_ended] !!}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_task({{ $item->id }})" class="btn btn-sm btn-primary" title="{{ translate('edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.case_delete_tasks', $item->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>

                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>

    @endif
</div>

<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modal title</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div class="modal-body" id="result_info">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        function edit_task(id)
        {
            $.ajax({
                url: "{{ route('admin.case_edit_tasks', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
