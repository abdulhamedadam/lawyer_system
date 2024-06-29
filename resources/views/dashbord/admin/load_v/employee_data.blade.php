<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= translate('Case_details') ?></h3>
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
                <td class="class_label"><?= translate('details') ?></td>
                <td class="class_result"><a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#modaldetails" onclick="employee_details({{$all_data->id}})" ><i class="fa-solid fa-list"></i>{{translate('detail_employee')}}</a></td>
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

            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modaldetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?=translate('employee_details')?></h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div id="result_info">

            </div>

        </div>
    </div>
</div>
@section('js')
    <script>
        function employee_details(id)
        {
            $.ajax({
                url: "{{ route('admin.employee_details', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {

                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
