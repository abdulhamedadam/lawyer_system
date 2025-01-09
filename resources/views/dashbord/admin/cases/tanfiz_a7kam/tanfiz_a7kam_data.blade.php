<div class="" style="margin-top: 30px; padding: 0px">
    @if(isset($tanfiz_A7kam_data) && !empty($tanfiz_A7kam_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('partial_num') }}</th>
                <th>{{ translate('tanfiz_circle') }}</th>
                <th>{{ translate('elkady_name') }}</th>
                <th>{{ translate('elmarkaz') }}</th>
                <th>{{ translate('el7okm_date') }}</th>
                <th>{{ translate('court_name') }}</th>
                <th>{{ translate('el7okm') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($tanfiz_A7kam_data as $item)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: red">
                        <span style="color: green;">{{ translate('partial_num') }}</span> : <span style="color: blue;">{{$item['partial_num']}}</span>
                        <br>
                        <span style="color: green;">{{ translate('for_year') }}</span> : <span style="color: blue;">{{$item['year']}}</span>
                    </td>
                    <td><span >{{ $item['tanfiz_circle']}}</span></td>
                    <td style="color: blue;text-decoration: underline">{{ $item['elkady_name']}}</td>
                    <td style="color: green">{{ $item['elmarkaz']}}</td>
                    <td style="color: green">{{ $item['el7okm_date']}}</td>
                    <td>{{ $item['court_name'] }}</td>
                    <td>{{ \Str::words($item['el7okm'], 25) }}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_tanfiz_a7kam({{ $item['id'] }})" class="btn btn-sm btn-primary" title="{{ translate('edit') }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('admin.delete_tanfiz_a7kam', $item['id']) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
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
                <h3 class="modal-title">{{ translate('edit_tanfiz_a7kam') }}</h3>

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
        function edit_tanfiz_a7kam(id)
        {
            $.ajax({
                url: "{{ route('admin.edit_tanfiz_a7kam', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
