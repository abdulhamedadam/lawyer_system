<div class="" style="margin-top: 30px">
    @if(isset($all_clients_cases) && !empty($all_clients_cases))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%">
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('case_number') }}</th>
                <th>{{ translate('case_title') }}</th>
                <th>{{ translate('case_type') }}</th>
                <th>{{ translate('court') }}</th>
                <th>{{ translate('case_status') }}</th>
                <th>{{ translate('fees') }}</th>
                <th>{{ translate('added_date') }}</th>
                <th>{{ translate('added_time') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($all_clients_cases as $case)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $case->case_num }}</td>
                    <td>{{ $case->case_name }}</td>
                    <td>{{ $case->case_type }}</td>
                    <td>{{ $case->court }}</td>
                    <td>{{ $case->case_status }}</td>
                    <td>{{ $case->fees }}</td>
                    <td class="fnt_center_black">{{ \Illuminate\Support\Carbon::parse($case->created_at)->format('Y-m-d') }}</td>
                    <td class="fnt_center_red">{{ \Illuminate\Support\Carbon::parse($case->created_at)->format('H:i:s') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.delete_file', $case->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>

                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>
    @else
        <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>{{translate('Warning:')}}</strong> {{ translate('there_is_no_related_cases') }}
            </div>
        </div>
    @endif
</div>
