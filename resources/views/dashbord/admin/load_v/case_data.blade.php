<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= translate('Case_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('case_num') ?></td>
                <td class="class_result"><?php echo $all_data->case_num; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('client_name') ?></td>
                <td class="class_result"><?php echo $all_data->client_name; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('case_title') ?></td>
                <td class="class_result"><?php echo $all_data->case_name; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('case_status') ?></td>
                <td class="class_result"><?php echo $all_data->case_status; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('case_type') ?></td>
                <td class="class_result"><?php echo $all_data->case_type; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('start_date') ?></td>
                <td class="class_result"><?php echo $all_data->start_date; ?></td>
            </tr>
            <tr style="background-color: #cd1e59">
                <td class="class_label"><?= translate('fees') ?></td>
                <td class="class_result"><?php echo $all_data->fees; ?></td>
            </tr>
            <tr style="background-color: #cd1e59">
                <td class="class_label"><?= translate('paid') ?></td>
                <td class="class_result"><?php echo $all_data->total_paid_value; ?></td>
            </tr>
            <tr style="background-color: #cd1e59">
                <td class="class_label"><?= translate('remain') ?></td>
                <td class="class_result" style=""><?php echo sprintf("%.2f", ($all_data->fees - $all_data->total_paid_value)); ?></td>


            </tr>
            </tbody>
        </table>
    </div>
</div>
