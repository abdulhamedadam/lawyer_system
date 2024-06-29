<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= translate('archive_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('archive_type') ?></td>
                <td class="class_result"><?php echo $all_data->archive_type; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('related_folders') ?></td>
                <?php
                $folder =[1 => translate('casses'), 2 => translate('employees'), 3 => translate('clients'),4 => translate('not_related')];
                ?>
                <td class="class_result"><?php echo $folder[$all_data->related_folder]; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('related_entity') ?></td>
                <?php
                $folder =[1 =>($all_data->case_name) , 2 => ($all_data->employee), 3 => ($all_data->client_name),4 => translate('not_related')];
                ?>
                <td class="class_result" ><?php echo $folder[$all_data->related_entity_id]; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= translate('secret_degree') ?></td>
                <td class="class_result"><span style="color:{{$all_data->secret_color}}">{{$all_data->secret_degree_name}} : </span></td>
            </tr>
            <tr style="background:burlywood">
                <td class="class_label" ><?= translate('desk') ?></td>
                <td class="class_result"><?php echo $all_data->desk; ?></td>
            </tr>

            <tr style="background:burlywood">
                <td class="class_label"><?= translate('shelf') ?></td>
                <td class="class_result"><?php echo $all_data->shelf; ?></td>
            </tr>
            <tr style="background:burlywood">
                <td class="class_label"><?= translate('folder_code') ?></td>
                <td class="class_result"><?php echo $all_data->folder_code; ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>


@section('js')

@endsection
