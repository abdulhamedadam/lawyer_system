<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="" style="padding-top: 20px;padding-right: 20px">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class=" nav-icon fa fa-cog fa-fw text-primary"></i>

                    <?=translate('general_settings')?>

                </h3>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12" style="background-color: #fff4f0 !important; border-radius: 5px;">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{route('admin.hr_settings','edarat')}}" class="nav-link @if($type=='edarat') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="bi bi-circle nav-icon text-warning"></i>
                                    {{translate('edarat')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_hr_setting('edarat')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">
                                <li class="nav-item">
                                    <a href="{{route('admin.hr_settings','holidays')}}" class="nav-link @if($type=='holidays') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="bi bi-circle nav-icon text-warning"></i>
                                    {{translate('holidays')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_hr_setting('holidays')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.hr_settings','mokalfat')}}" class="nav-link @if($type=='mokalfat') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="bi bi-circle nav-icon text-warning"></i>
                                    {{translate('mokalfat')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_hr_setting('mokalfat')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">



                            </ul>
                        </nav>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
