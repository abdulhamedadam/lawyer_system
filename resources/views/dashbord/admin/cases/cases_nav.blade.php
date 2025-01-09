
<style>

    .btn.active {
        position: relative;
        font-weight: bold;
        color: #fff !important;
    }

    .btn.active::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid red;
    }


    .btn:hover {
        border-bottom: 3px solid rgba(0, 0, 0, 0.2);
    }
    button, label, option, select, i {
        font-family: 'Noto Sans Arabic', 'Helvetica Neue', sans-serif;
        font-size: 16px;
        font-weight: bold !important;
    }

    input, select {
        border: 2px solid bold !important;
    }


    a, button {
        padding: 8px !important;
    }

    .class_label {
        font-size: 14px;
        font-weight: bold;
        color: black;
        background: #fffbdc;
        border: 1px solid #ccc;
    }

    .class_result {
        color: blue;
        font-weight: 600;
        border: 1px solid #ccc;
    }

</style>
<!-- Your Blade view file -->
<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px; " >
        <div class="card-body" style="padding: 10px">

            <div class="row">
                <div class="col-md-11">
                    <a href="{{ route('admin.case_status', $all_data->id) }}"
                       class="btn btn-primary p-2 {{ request()->routeIs('admin.case_status') ? 'active' : '' }}">
                        <i class="bi bi-check-circle-fill"></i> <?= translate('case_status') ?>
                    </a>

                    <a href="{{ route('admin.case_morfqat', $all_data->id) }}"
                       class="btn btn-success p-2 {{ request()->routeIs('admin.case_morfqat') ? 'active' : '' }}">
                        <i class="bi bi-paperclip"></i> <?= translate('case_attachments') ?>
                    </a>

                    <a href="{{ route('admin.case_mo7dareen', $all_data->id) }}"
                       class="btn btn-info p-2 {{ request()->routeIs('admin.case_mo7dareen') ? 'active' : '' }}">
                        <i class="bi bi-person-add"></i> <?= translate('mo7dareen') ?>
                    </a>

                    <a href="{{ route('admin.case_kafalate', $all_data->id) }}"
                       class="btn btn-warning p-2 {{ request()->routeIs('admin.case_kafalate') ? 'active' : '' }}">
                        <i class="bi-person-badge"></i> <?= translate('case_kafalate') ?>
                    </a>

                    <a href="{{ route('admin.case_tanfiz_a7kam', $all_data->id) }}"
                        class="btn p-2 {{ request()->routeIs('admin.case_tanfiz_a7kam') ? 'active' : '' }}"
                        style="background-color: #ca5555; color: white;">
                        <i class="bi bi-clipboard-check"></i> <?= translate('tanfiz_a7kam') ?>
                    </a>

                    <a href="{{ route('admin.case_experts', $all_data->id) }}"
                       class="btn p-2 {{ request()->routeIs('admin.case_experts') ? 'active' : '' }}"
                       style="background-color: #33C1FF; color: white;">
                        <i class="bi bi-person-workspace"></i> <?= translate('experts') ?>
                    </a>

                    <a href="{{ route('admin.case_payments', $all_data->id) }}"
                       class="btn btn-danger p-2 {{ request()->routeIs('admin.case_payments') ? 'active' : '' }}">
                        <i class="bi bi-currency-exchange"></i> <?= translate('Case_financial_transactions') ?>
                    </a>

                    <a href="{{ route('admin.case_tasks', $all_data->id) }}"
                       class="btn btn-secondary p-2 {{ request()->routeIs('admin.case_tasks') ? 'active' : '' }}">
                        <i class="bi bi-check-square"></i> <?= translate('Case_tasks') ?>
                    </a>

                    <a href="{{ route('admin.case_sessions', $all_data->id) }}"
                       class="btn btn-dark p-2 {{ request()->routeIs('admin.case_sessions') ? 'active' : '' }}">
                        <i class="bi bi-calendar"></i> <?= translate('Case_sessions') ?>
                    </a>
                </div>

                <div class="col-md-1 text-end">
                    <a class="btn btn-warning p-2" href="{{ route('admin.cases_data') }}">
                        <i class="bi bi-arrow-repeat"></i> <?= translate('back') ?>
                    </a>
                </div>
            </div>




        </div>
    </div>
</div>


