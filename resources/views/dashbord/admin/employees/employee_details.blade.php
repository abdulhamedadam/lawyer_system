<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= translate('employee_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('employee') ?></td>
                <td class="class_result"><?php echo $all_data->employee; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('employee_code') ?></td>
                <td class="class_result"><?php echo $all_data->emp_code; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('national_id') ?></td>
                <td class="class_result"><?php echo $all_data->card_num; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('gender') ?></td>
                <td class="class_result"><?php echo $all_data->gender_type; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('job_title') ?></td>
                <td class="class_result"><?php echo $all_data->mosma_wazefy; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('governate') ?></td>
                <td class="class_result"><?php echo $all_data->governate; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('city') ?></td>
                <td class="class_result"><?php echo $all_data->city; ?></td>
            </tr>
            <tr >
                <td class="class_label"><?= translate('phone') ?></td>
                <td class="class_result"><?php echo $all_data->phone; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('birth_date') ?></td>
                <td class="class_result"><?php echo $all_data->birth_date; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('address') ?></td>
                <td class="class_result"><?php echo $all_data->address; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('nationality') ?></td>
                <td class="class_result"><?php echo $all_data->nationality_name; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('religion') ?></td>
                <td class="class_result"><?php echo $all_data->religion; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('material_status') ?></td>
                <td class="class_result"><?php echo $all_data->material_status; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('employee_qualification') ?></td>
                <td class="class_result"><?php echo $all_data->qualifications; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('employee_degree') ?></td>
                <td class="class_result"><?php echo $all_data->degrees; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('manager') ?></td>
                <td class="class_result"><?php echo $all_data->manager; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('start_work_date') ?></td>
                <td class="class_result"><?php echo $all_data->start_work_date; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('end_contract_date') ?></td>
                <td class="class_result"><?php echo $all_data->end_contract_date; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('end_service_date') ?></td>
                <td class="class_result"><?php echo $all_data->end_service_date; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('test_num_month') ?></td>
                <td class="class_result"><?php echo $all_data->test_num_month; ?></td>
            </tr>

            <tr>
                <td class="class_label"><?= translate('end_test_date') ?></td>
                <td class="class_result"><?php echo $all_data->end_test_date; ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
