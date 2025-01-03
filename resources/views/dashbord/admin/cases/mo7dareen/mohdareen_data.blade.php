<div class="" style="margin-top: 30px; padding: 0px">
    @if(isset($mo7dareen_data) && !empty($mo7dareen_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('mo7dareen_num') }}</th>
                <th>{{ translate('lawyer') }}</th>
                <th>{{ translate('mo7dareen_pen') }}</th>
                <th>{{ translate('session_date') }}</th>
                <th>{{ translate('delivery_date') }}</th>
                <th>{{ translate('notes') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($mo7dareen_data as $item)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: red">
                        <span style="color: green;">{{ translate('mo7dareen_num') }}</span> : <span style="color: blue;">{{$item['mo7dareen_num']}}</span>
                        <br>
                        <span style="color: green;">{{ translate('for_year') }}</span> : <span style="color: blue;">{{$item['year']}}</span>
                        </td>
                    <td style="color: purple">{{ $item->employee->employee}}</td>
                    <td><span >{{ $item['mo7dareen_pen']}}</span></td>
                    <td style="color: blue;text-decoration: underline">{{ $item['session_date']}}</td>
                    <td style="color: green">{{ $item['delivery_date']}}</td>
                    <td>{{ $item['notes']}}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_mo7dareen({{ $item['id'] }})" class="btn btn-sm btn-primary" title="{{ translate('edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.delete_mo7dareen', $item['id']) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
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
        function edit_mo7dareen(id)
        {
            $.ajax({
                url: "{{ route('admin.case_edit_mo7dareen', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
