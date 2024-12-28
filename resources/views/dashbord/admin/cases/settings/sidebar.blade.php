<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="" style="padding-top: 20px;padding-right: 20px">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class=" nav-icon fa fa-cog fa-fw text-primary"></i>

                    <?=translate('case_settings')?>

                </h3>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12" style="background-color: #fff4f0  !important; border-radius: 5px;">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">

                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','case_type')}}"
                                       class="nav-link @if($type=='case_type') active @endif" style=" width: 100%;">
                <span style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        <i class="far fa-circle nav-icon text-warning"></i>
                        {{translate('case_type')}}
                    </span>
                    <span class="badge badge-danger"
                          style="order: 1; margin-left: 5px;">{{count_case_setting('case_type')}}</span>
                </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','courts')}}"
                                       class="nav-link @if($type=='courts') active @endif" style=" width: 100%;">
                <span style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        <i class="far fa-circle nav-icon text-warning"></i>
                        {{translate('courts')}}
                    </span>
                    <span class="badge badge-danger"
                          style="order: 1; margin-left: 5px;">{{count_case_setting('courts')}}</span>
                </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','case_status')}}"
                                       class="nav-link @if($type=='case_status') active @endif" style=" width: 100%;">
                <span style="display: flex; justify-content: space-between; align-items: center; ">
                    <span>
                        <i class="far fa-circle nav-icon text-warning"></i>
                        {{translate('case_status')}}
                    </span>
                    <span class="badge badge-danger"
                          style="order: 1; margin-left: 5px;">{{count_case_setting('case_status')}}</span>
                </span>
                                    </a>
                                </li>
                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','sarf_band')}}"
                                       class="nav-link @if($type=='sarf_band') active @endif" style=" width: 100%;">
                <span style="display: flex; justify-content: space-between; align-items: center; ">
                    <span>
                        <i class="far fa-circle nav-icon text-warning"></i>
                        {{translate('sarf_band')}}
                    </span>
                    <span class="badge badge-danger"
                          style="order: 1; margin-left: 5px;">{{count_case_setting('sarf_band')}}</span>
                </span>
                                    </a>
                                </li>

                                <hr class="nav-separator"> <!-- Horizontal line -->
                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','legal_service')}}"
                                       class="nav-link @if($type=='legal_service') active @endif" style=" width: 100%;">
                <span style="display: flex; justify-content: space-between; align-items: center; ">
                    <span>
                        <i class="far fa-circle nav-icon text-warning"></i>
                        {{translate('legal_services')}}
                    </span>
                    <span class="badge badge-danger"
                          style="order: 1; margin-left: 5px;">{{count_case_setting('legal_service')}}</span>
                </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','tawkel_type')}}"
                                       class="nav-link @if($type=='tawkel_type') active @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('tawkel_type')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('tawkel_type')}}</span>
                                    </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','mawkel_type')}}"
                                       class="nav-link @if($type=='mawkel_type') active @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('mawkel_type')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('mawkel_type')}}</span>
                                    </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','litigation_degree')}}"
                                       class="nav-link @if($type=='litigation_degree') active @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('litigation_degree')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('litigation_degree')}}</span>
                                    </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">


                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','administrative_work')}}"
                                       class="nav-link @if($type=='administrative_work') active @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('administrative_work')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('administrative_work')}}</span>
                                    </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">


                                <li class="nav-item">
                                    <a href="{{route('admin.case_settings','cash_boxes')}}"
                                       class="nav-link @if($type=='cash_boxes') active @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('cash_boxes')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('cash_boxes')}}</span>
                                    </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{route('admin.assets_type')}}"
                                       class="nav-link @if(optional(explode('.', Route::currentRouteName()))[1] == 'assets_type')  active   @endif" style=" width: 100%;">
                                    <span style="display: flex; justify-content: space-between; align-items: center; ">
                                          <span>
                                                  <i class="far fa-circle nav-icon text-warning"></i>
                                                        {{translate('assets_type')}}
                                          </span>
                                    <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_case_setting('cash_boxes')}}</span>
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
