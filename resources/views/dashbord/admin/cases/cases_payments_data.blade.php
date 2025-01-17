<div class="" style="margin-top: 30px; padding: 20px">
    @if(isset($payment_data) && !empty($payment_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%" >
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('paid_date') }}</th>
                <th>{{ translate('paid_time') }}</th>
                <th>{{ translate('paid_value') }}</th>
                <th>{{ translate('recieved_from') }}</th>
                <th>{{ translate('phone') }}</th>
                <th>{{ translate('notes') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($payment_data as $item)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td style="color: red">{{ $item['paid_date'] }}</td>
                    <td style="color: purple">{{ $item['paid_time']}}</td>
                    <td><span style="background-color: lightblue ; " class="span_data_table">{{ $item['paid_value']}}</span></td>
                    <td style="color: blue;text-decoration: underline">{{ $item['person_name']}}</td>
                    <td style="color: green">{{ $item['person_phone']}}</td>
                    <td>{{ $item['notes']}}</td>
                    <td>
                        <div class="btn-group">

                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_payment({{ $item['id'] }})" class="btn btn-sm btn-primary" title="{{ translate('edit') }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('admin.case_delete_payments', $item['id']) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
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
        function edit_payment(id)
        {
            $.ajax({
                url: "{{ route('admin.case_edit_payments', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
