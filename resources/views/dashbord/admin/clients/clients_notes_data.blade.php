<div class="" style="margin-top: 30px">
    @if(isset($notes_data) && !empty($notes_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%">
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('notes') }}</th>
                <th>{{ translate('publisher_name') }}</th>
                <th>{{ translate('added_date') }}</th>
                <th>{{ translate('added_time') }}</th>
                <th>{{ translate('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp
            @foreach ($notes_data as $note)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $note->notes }}</td>
                    <td>{{ $note->publisher_n}}</td>
                    <td class="fnt_center_black">{{ \Illuminate\Support\Carbon::parse($note->created_at)->format('Y-m-d') }}</td>
                    <td class="fnt_center_red">{{ \Illuminate\Support\Carbon::parse($note->created_at)->format('H:i:s') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.download_file', $note->id) }}" class="btn btn-sm btn-primary" title="{{ translate('download') }}">
                                <i class="bi bi-download"></i>
                            </a>
                            <a href="{{ route('admin.delete_file', $note->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
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
