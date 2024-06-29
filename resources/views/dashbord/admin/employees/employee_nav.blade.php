<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11">
                    <a href="{{ route('admin.employee_files', $all_data->id) }}" class="btn btn-success p-2"> <!-- Changed to green color -->
                        <i class="fas fa-file"></i> <?= translate('employee_files') ?> <!-- Changed icon -->
                    </a>

                </div>

                <div class="col-md-1  text-end">
                    <a class="btn btn-warning" href="{{ route('admin.employee_data') }}"> <!-- Changed to yellow color -->
                        <i class="bi bi-arrow-repeat fs-3"></i>{{translate('back')}} <!-- Changed icon -->
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
