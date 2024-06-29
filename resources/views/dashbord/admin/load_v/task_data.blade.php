<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa">
        <h3 class="card-title"><i class="fas fa-text-width"></i> {{ translate('task_details') }}</h3>
    </div>
    <div class="card-body" style="padding: 20px !important">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%">{{ translate('create_date') }}</td>
                <td class="class_result">{{ $details->ensha_date }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%">{{ translate('task_name') }}</td>
                <td class="class_result">{{ $details->task_name }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%">{{ translate('priority') }}</td>
                <td class="class_result">{{ $details->priority }}</td>
            </tr>
            <tr>
                <td class="class_label">{{ translate('assign_from') }}</td>
                <td class="class_result">{{ $details->from_emp_name }}</td>
            </tr>
            <tr>
                <td class="class_label">{{ translate('assign_to') }}</td>
                <td class="class_result">{{ $details->to_emp_name }}</td>
            </tr>
            <tr>
                <td class="class_label">{{ translate('task_start_date') }}</td>
                <td class="class_result">{{ $details->start_date }}</td>
            </tr>

            <tr>
                <td class="class_label">{{ translate('task_end_date') }}</td>
                <td class="class_result">{{ $details->end_date }}</td>
            </tr>

            <tr>
                <td class="class_label">{{ translate('period_date') }}</td>
                <td class="class_result">{!! Diff_Days($details->start_date, $details->end_date) !!}</td>
            </tr>

            <tr>
                <td class="class_label">{{ translate('details') }}</td>
                <td class="class_result">{{  $details->task_details }}</td>
            </tr>


            @if(!empty($details->action_estlam_date))
                <tr>
                    <td class="class_label">{{ translate('receive_date') }}</td>
                    <td class="class_result">{{ $details->action_estlam_date }}</td>
                </tr>
                <tr>
                    <td class="class_label">{{ translate('receive_time') }}</td>
                    <td class="class_result">{{ $details->action_estlam_time }}</td>
                </tr>
            @endif

            @if($details->end_takeem == 'yes')
                @php
                    $amal_elazem_title = translate('yes');
                    $total_vvalue = 300;
                @endphp

                <tr style="background-color: #cd1e59">
                    <td class="class_label">{{ translate('do_require') }}</td>
                    <td class="class_result">{{ $amal_elazem_title }}</td>
                </tr>

                @if($details->amal_elazem == 'no')
                    <tr style="background-color: #cd1e59">
                        <td class="class_label">{{ translate('reasons') }}</td>
                        <td class="class_result">{{ $details->takeem_reason }}</td>
                    </tr>
                @endif

                <tr style="background-color: #cd1e59">
                    <td class="class_label">{{ translate('time_respect') }}</td>
                    <td class="class_result">{{ $details->takeem_time_work }}%</td>
                </tr>

                <tr style="background-color: #cd1e59">
                    <td class="class_label">{{ translate('complete') }}</td>
                    <td class="class_result">{{ $details->takeem_complet }}%</td>
                </tr>

                <tr style="background-color: #cd1e59">
                    <td class="class_label">{{ translate('accuracy') }}</td>
                    <td class="class_result">{{ $details->takeem_gwda }}%</td>
                </tr>

                @php
                    $total_takeem = round((($details->takeem_time_work + $details->takeem_complet + $details->takeem_gwda) / $total_vvalue) * 100);
                @endphp

                <tr style="background-color: #cd1e59">
                    <td class="class_label">{{ translate('total') }}</td>
                    <td class="class_result">{{ $total_takeem }}%</td>
                </tr>
            @endif



            </tbody>
        </table>
    </div>
</div>
