<div class="" style="margin-top: 30px; padding: 20px">
    @if(isset($agra2at_data) && !empty($agra2at_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('agra2_num') }}</th>
                <th>{{ translate('agra2_date') }}</th>
                <th>{{ translate('agra2_take_place') }}</th>
                <th>{{ translate('lawyer') }}</th>
                <th>{{ translate('alagra2') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($agra2at_data as $item)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: red">
                        <span style="color: green;">{{ translate('agra2_num') }}</span> : <span style="color: blue;">{{$item['agra2_num']}}</span>
                        <br>
                        <span style="color: green;">{{ translate('for_year') }}</span> : <span style="color: blue;">{{$item['year']}}</span>
                    </td>
                    <td><span >{{ $item['agra2_date']}}</span></td>
                    <td><span >{{ $item['agra2_take_place']}}</span></td>
                    <td style="color: blue; text-decoration: underline;">
                        <a href="{{ route('admin.employee_files', $item->employee->id) }}">
                            {{ $item->employee->employee }}
                        </a>
                    </td>
                    <td>{{ \Str::words($item['alagra2'], 25) }}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_agra2({{ $item['id'] }})" class="btn btn-sm btn-primary rounded me-2" title="{{ translate('edit') }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.edary_work_delete_agra2', $item['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Delete?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
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
        function edit_agra2(id)
        {
            $.ajax({
                url: "{{ route('admin.edary_work_edit_agra2', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
