<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="" style="padding-top: 20px;padding-right: 20px">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class=" nav-icon fa fa-cog fa-fw text-primary"></i>

                    <?=translate('archive_settings')?>

                </h3>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12" style="background-color: #fff4f0 !important; border-radius: 5px;">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.archive_settings','desk')}}" class="nav-link @if($type=='desk') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('desk')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_archive_setting('desk')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.archive_shelf_settings','shelf')}}" class="nav-link @if($type=='shelf') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('shelf')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_archive_setting('shelf')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.archive_settings','secret_degree')}}" class="nav-link @if($type=='secret_degree') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('secret_degree')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_archive_setting('secret_degree')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.archive_settings','archive_type')}}" class="nav-link @if($type=='archive_type') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('archive_type')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_archive_setting('archive_type')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">
                                <!-- Horizontal line -->
                                <!-- Add more list items with horizontal lines as needed -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
