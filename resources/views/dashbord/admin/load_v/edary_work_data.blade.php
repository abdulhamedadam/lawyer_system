<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="bi bi-file-earmark-text"></i> <?= translate('edary_work_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped">
            <tbody>
                <tr>
                    <td class="class_label" style="width: 25%"><?= translate('Client') ?></td>
                    <td class="class_result"><?php echo $all_data->client->name; ?></td>
                </tr>
                <tr>
                    <td class="class_label" style="width: 25%"><?= translate('tawkel_number') ?></td>
                    <td class="class_result"><?php echo $all_data->tawkelat->tawkel_number; ?></td>
                </tr>
                <tr>
                    <td class="class_label" style="width: 25%"><?= translate('tawkel_type') ?></td>
                    <td class="class_result"><?php echo $all_data->tawkelat->TawkelType->title; ?></td>
                </tr>
                <tr>
                    <td class="class_label"><?= translate('edary_work_type') ?></td>
                    <td class="class_result"><?php echo $all_data->edaryType->title; ?></td>
                </tr>
                <tr>
                    <td class="class_label" style="width: 25%"><?= translate('esnad_to') ?></td>
                    <td class="class_result"><?php echo $all_data->employee->employee; ?></td>
                </tr>
                <tr>
                    <td class="class_label"><?= translate('subject_entity') ?></td>
                    <td class="class_result"><?php echo $all_data->subject_entity; ?></td>
                </tr>
                <tr>
                    <td class="class_label"><?= translate('authority_entity') ?></td>
                    <td class="class_result"><?php echo $all_data->authority_entity; ?></td>
                </tr>
                <tr>
                    <td class="class_label"><?= translate('subject_entity_address') ?></td>
                    <td class="class_result"><?php echo $all_data->subject_entity_address; ?></td>
                </tr>
                <tr>
                    <td class="class_label"><?= translate('subject') ?></td>
                    <td class="class_result"><?php echo Str::words($all_data->subject, 10); ?></td>
                </tr>
                <tr style="background-color: #d37091">
                    <td class="class_label"><?= translate('total_fees') ?></td>
                    <td class="class_result"><?php echo $all_data->total_fees; ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
