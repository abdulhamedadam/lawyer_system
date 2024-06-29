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
                    <div class="col-12 col-sm-12" >
                        <nav class="mt-2" style="background-color: #fff4f0 !important; border-radius: 5px;">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','status')}}" class="nav-link @if($type=='status') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('status')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('status')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->

                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','nationality')}}" class="nav-link @if($type=='nationality') active @endif" style="width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('nationality')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('nationality')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->

                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','religion')}}" class="nav-link @if($type=='religion') active @endif" style="width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('religion')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('religion')}}</span>
                            </span>
                                    </a>
                                </li>

                                <hr class="nav-separator"><!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','qualifications')}}" class="nav-link @if($type=='qualifications') active @endif" style="width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('qualifications')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('qualifications')}}</span>
                            </span>
                                    </a>
                                </li>



                                <hr class="nav-separator"><!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','degrees')}}" class="nav-link @if($type=='degrees') active @endif" style="width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('degrees')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('degrees')}}</span>
                            </span>
                                    </a>
                                </li>



                                <hr class="nav-separator"><!-- Horizontal line -->


                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','priority')}}" class="nav-link @if($type=='priority') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('priority')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('priority')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','jobs')}}" class="nav-link @if($type=='jobs') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('jobs')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('jobs')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','material_status')}}" class="nav-link @if($type=='material_status') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('material_status')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('material_status')}}</span>
                            </span>
                                    </a>
                                </li>

                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','currency')}}" class="nav-link @if($type=='currency') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center; ">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('currency')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_general_setting('currency')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">


                                <!-- Horizontal line -->
                                <!-- Add more list items with horizontal lines as needed -->
                            </ul>
                        </nav>
                        <div style="text-align: center;">
                        <span style="font-size: 16px">{{ translate('library_settings') }}</span>
                        </div>
                        <nav class="mt-2" style="background-color: #fff4f0 !important; border-radius: 5px;">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                 <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','book_tasnef')}}" class="nav-link @if($type=='book_tasnef') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('tasnef')}}
                                </span>
                                <span class="badge badge-warning" style="order: 1; margin-left: 5px;">{{count_general_setting('book_tasnef')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">
                                <li class="nav-item">
                                    <a href="{{route('admin.general_settings','book_author')}}" class="nav-link @if($type=='book_author') active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{translate('authors')}}
                                </span>
                                <span class="badge badge-warning" style="order: 1; margin-left: 5px;">{{count_general_setting('book_author')}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <!-- Horizontal line -->



                                <!-- Horizontal line -->
                                <!-- Add more list items with horizontal lines as needed -->
                            </ul>
                        </nav>

                        <div style="text-align: center;">
                            <span style="font-size: 16px">{{ translate('archive_settings') }}</span>
                        </div>
                        <nav class="mt-2" style="background-color: #fff4f0 !important; border-radius: 5px;">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
