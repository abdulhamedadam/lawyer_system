

<!-- Your Blade view file -->
<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px" >
        <div class="card-body" style="padding: 10px">

            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11">
                    <a href="{{ route('admin.case_morfqat', $all_data->id) }}" class="btn btn-success p-2"> <!-- Changed to green color -->
                        <i class="bi bi-check-circle-fill"></i> <?= translate('case_status') ?>
                    </a>

                    <a href="{{ route('admin.case_morfqat', $all_data->id) }}" class="btn btn-primary p-2"> <!-- Changed to blue color -->
                        <i class="bi bi-files"></i><?= translate('case_attachments') ?> <!-- Changed icon -->
                    </a>

                    <a href="{{ route('admin.case_payments',$all_data->id) }}" class="btn btn-info p-2">
                        <i class="bi bi-currency-exchange"></i> <?= translate('Case_financial_transactions') ?> <!-- Changed icon -->
                    </a>

                    <a href="{{ route('admin.case_tasks',$all_data->id) }}" class="btn btn-warning p-2">
                        <i class="bi bi-check-square"></i><?= translate('Case_tasks') ?>
                    </a>

                    <a href="{{ route('admin.case_sessions',$all_data->id) }}" class="btn btn-danger p-2">
                        <i class="bi bi-calendar"></i> <?= translate('Case_sessions') ?>
                    </a>
                </div>

                <div class="col-md-1  text-end">
                    <a class="btn btn-warning p-2" href="{{ route('admin.cases_data') }}"> <!-- Changed to yellow color -->
                        <i class="bi bi-arrow-repeat "></i> B{{translate('back')}}
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>


