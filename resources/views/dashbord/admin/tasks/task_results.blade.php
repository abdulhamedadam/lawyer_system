<div class="card shadow bg-white rounded" style="margin-top: 8px">
    <div class="card-header" >
        <h3 class="card-title"> {{ translate('end_task_reasons_and_results') }}</h3>
    </div>
    <div class="card-body" style="padding: 20px !important">
        <table class="table table-bordered table-sm table-striped">
            <tbody>
            <tr>
                <th scope="row">{{ translate('task_resaons') }}</th>
                <td class="class_result">{{ $details->action_ended_reason }}</td>
            </tr>
            <tr>
                <th scope="row">{{ translate('task_results') }}</th>
                <td>
                    @php
                        $text = trim($details->action_ended_result);
                        $textAr = explode("\n", $text);
                        $textAr = array_filter($textAr, 'trim');
                    @endphp
                    <ul class="stylish-list">
                        @foreach ($textAr as $line)
                            <li style="font-size: 13px; color: blue; font-weight: 500;">
                                {{ str_replace("\n", "", str_replace("\r", "", $line)) }}
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
