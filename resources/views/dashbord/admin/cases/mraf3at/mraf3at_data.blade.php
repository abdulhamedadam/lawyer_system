<div class="" style="margin-top: 30px; padding: 0px">
    @if(isset($mraf3a_data) && !empty($mraf3a_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('source') }}</th>
                <th>{{ translate('mraf3a_name') }}</th>
                <th>{{ translate('addition_date') }}</th>
                <th>{{ translate('mraf3a_text') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($mraf3a_data as $item)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: red">
                        <span style="color: blue;">{{$item->source}}</span>
                    </td>
                    <td style="color: green">{{ $item->mraf3a_name }}</td>
                    <td style="color: blue">{{ $item->addition_date }}</td>
                    <td>{{ \Str::words($item->mraf3a_text, 25) }}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_mraf3a({{ $item['id'] }})" class="btn btn-sm btn-primary" title="{{ translate('edit') }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('admin.case_delete_mraf3a', $item['id']) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
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
                <h3 class="modal-title">{{ translate('edit_mraf3a') }}</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div class="modal-body" id="result_info">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ translate('close') }}</button>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        function edit_mraf3a(id)
        {
            $.ajax({
                url: "{{ route('admin.case_edit_mraf3a', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
