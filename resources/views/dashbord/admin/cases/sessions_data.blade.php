<div class="" style="margin-top: 30px; padding: 20px">
    @if(isset($session_data) && !empty($session_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('session_title') }}</th>
                <th>{{ translate('session_date') }}</th>
                <th>{{ translate('session_time') }}</th>
                <th>{{ translate('assign_to') }}</th>
                <th>{{ translate('court') }}</th>
                <th>{{ translate('session_judge') }}</th>
                <th>{{ translate('session_notes') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($session_data as $item)

                @php
                    $status = [
                        'do'    => '<span style="background-color: lightblue;" class="span_data_table">' . translate('do') . '</span>',
                        'doing' => '<span style="background-color: lightcoral;" class="span_data_table">' . translate('doing') . '</span>',
                        'done'  => '<span style="background-color: lightcoral;" class="span_data_table">' . translate('done') . '</span>',
                    ];
                @endphp

                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: #008000;text-decoration: underline">{{ $item->session_title }}</td>
                    <td style="color: #ff0000">{{ $item->session_date }}</td>
                    <td style="color: purple">{{ $item->session_time }}</td>
                    <td style="color: black">{{ $item->employee_name }}</td>
                    <td style="color: #52674a; text-decoration: underline">{{ $item->court_name }}</td>
                    <td style="color: blue; text-decoration: underline">{{ $item->session_judge }}</td>
                    <td style="color: #83605a; text-decoration: underline">{{ $item->session_notes }}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_session({{ $item->id }})" class="btn btn-sm btn-warning" title="{{ translate('edit') }}">
                                <i class="bi bi-pencil"></i>{{translate('edit')}}
                            </a>
                            <a href="{{ route('admin.case_delete_session', $item->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>{{translate('delete')}}
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#myModal_results" onclick="edit_session_results({{ $item->id }})" class="btn btn-sm btn-primary">
                                <i class="bi bi-info"></i>{{translate('session_results')}}
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
                <h3 class="modal-title">{{translate('session_edit')}}</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div class="modal-body" id="result_info">


            </div>


    </div>
</div>
</div>

    <div class="modal fade" tabindex="-1" id="myModal_results">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{translate('session_results')}}</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>

                <div class="modal-body" id="session_results">


                </div>


            </div>
        </div>
    </div>

@section('js')
    <script>
        function edit_session(id)
        {
            $.ajax({
                url: "{{ route('admin.case_edit_session', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
            <script>
        function edit_session_results(id)
        {
            $.ajax({
                url: "{{ route('admin.case_session_results', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#session_results').html(html);
                },
            });
        }
    </script>


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Cases\CaseSessions_R', '#form') !!}
@endsection
