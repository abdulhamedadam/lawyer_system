<?php use Illuminate\Support\Facades\Route; ?>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->

    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">

        <!--begin::Logo image-->
            <a href="{{ route('admin.main_dash') }}" class="text-white ">
                <img alt="Logo" src="{{ asset((!empty($mainData->image)) ? $mainData->image : 'assets/media/logos/home-button (1).png') }}" class="h-30px app-sidebar-logo-default"/>

            </a>
     





    <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                          fill="currentColor"/>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>


    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3"
                 id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.main_dash') ? 'active' : '' }}"
                       href="{{ route('admin.main_dash') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-graph-up text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('reports_statistics') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.general_settings','jobs','admin.archive_shelf_settings','shelf','admin.archive_settings','desk']) ? 'active' : '' }}"
                       href="{{ route('admin.general_settings','jobs') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-gear text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('general_settings') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.case_settings','case_type']) ? 'active' : '' }}"
                       href="{{ route('admin.case_settings','case_type') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-gear text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('case_settings') }}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.clients_data') ? 'active' : '' }}"
                       href="{{ route('admin.clients_data') }}">
                            <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                 <i class="bi bi-person-check-fill text-warning fs-2x"></i>
                            </span>
                        <span class="menu-title">{{ translate('clients') }}</span>
                        <span class="badge badge-danger"
                              style="order: 1; margin-left: 5px;">{{data_count('tbl_clients')}}</span>
                    </a>
                </div>


                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion {{ request()->routeIs(['admin.cases_data','admin.case_tasks','admin.case_tasks','admin.case_payments','admin.case_morfqat']) ? 'show' : '' }}">
                    <span class="menu-link">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<i class="bi bi-briefcase fs-2x"></i>
												</span>
                                                <!--end::Svg Icon-->
											</span>
											<span class="menu-title">{{translate('cases')}}</span>
											<span class="menu-arrow"></span>

                     </span>


                    <div
                        class="menu-sub menu-sub-accordion {{ request()->routeIs(['admin.cases_data','admin.case_tasks','admin.case_payments','admin.case_morfqat']) ? 'show' : '' }}">
                        <div class="menu-item">

                            <a class="menu-link {{ request()->routeIs(['admin.cases_data','admin.case_tasks','admin.case_payments','admin.case_morfqat']) ? 'active' : '' }} ?>"
                               href="{{ route('admin.cases_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('all_cases')}}</span>
                                <span class="badge badge-danger"
                                      style="order: 1; margin-left: 5px;">{{data_count('tbl_clients_cases')}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.employee_data') ? 'active' : '' }}"
                               href="{{ route('admin.employee_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('ongoing_cases')}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.roles_data') ? 'active' : '' }}"
                               href="{{ route('admin.roles_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('finished_cases')}}</span>
                            </a>

                        </div>

                    </div>
                    <!--end:Menu sub-->
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.index_legal_services') ? 'active' : '' }}"
                       href="{{ route('admin.index_legal_services') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-file-earmark-text text-warning fs-2x"></i>
        </span>
                        <span class="menu-title">{{translate('legal_services')}}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.employee_data') ? 'active' : '' }}"
                       href="{{ route('admin.employee_data') }}">
                            <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                 <i class="bi bi-person-circle text-warning fs-2x"></i>
                            </span>
                        <span class="menu-title">{{translate('employees')}}</span>
                        <span class="badge badge-danger"
                              style="order: 1; margin-left: 5px;">{{data_count('employees')}}</span>
                    </a>
                </div>


                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion {{ request()->routeIs(['admin.employee_data','admin.roles_data','admin.hr_settings']) ? 'show' : '' }}">
                    <span class="menu-link">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<i class="bi bi-people fs-2x"></i>
												</span>
                                                <!--end::Svg Icon-->
											</span>
											<span class="menu-title">{{translate('human_resource')}}</span>
											<span class="menu-arrow"></span>
                     </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->


                    <div
                        class="menu-sub menu-sub-accordion {{ request()->routeIs(['admin.employee_data','admin.roles_data','admin.hr_settings']) ? 'show' : '' }}">
                        <div class="menu-item">

                            <a class="menu-link {{ request()->routeIs('admin.hr_settings') ? 'active' : '' }} ?>"
                               href="{{ route('admin.hr_settings','mokalfat') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('settings')}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.employee_data') ? 'active' : '' }}"
                               href="{{ route('admin.employee_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('all_employees')}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.roles_data') ? 'active' : '' }}"
                               href="{{ route('admin.roles_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('users_roles')}}</span>
                            </a>

                        </div>

                    </div>
                    <!--end:Menu sub-->
                </div>


                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion {{ request()->routeIs(['admin.all_task_data','admin.doing_tasks','admin.done_tasks']) ? 'show' : '' }}">
                    <span class="menu-link">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<i class="bi bi-list-check fs-2x"></i>
												</span>
                                                <!--end::Svg Icon-->
											</span>
											<span class="menu-title">{{translate('employee_tasks')}}</span>
											<span class="menu-arrow"></span>

                     </span>


                    <div
                        class="menu-sub menu-sub-accordion {{ request()->routeIs(['admin.all_task_data']) ? 'show' : '' }}">
                        <div class="menu-item">

                            <a class="menu-link {{ request()->routeIs('admin.all_task_data') ? 'active' : '' }} ?>"
                               href="{{ route('admin.all_task_data') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('all_tasks')}}</span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{0}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.doing_tasks') ? 'active' : '' }}"
                               href="{{ route('admin.doing_tasks') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('doing_tasks')}}</span>
                            </a>

                            <a class="menu-link {{ request()->routeIs('admin.done_tasks') ? 'active' : '' }}"
                               href="{{ route('admin.done_tasks') }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                <span class="menu-title">{{translate('finished_cases')}}</span>
                            </a>

                        </div>

                    </div>
                    <!--end:Menu sub-->
                </div>

                @can('قائمة المستخدمين')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.user_data') ? 'active' : '' }}"
                           href="{{ route('admin.user_data') }}">
                            <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                 <i class="bi bi-person-circle text-warning fs-2x"></i>
                            </span>
                            <span class="menu-title">{{translate('users')}}</span>
                            <span class="badge badge-danger"
                                  style="order: 1; margin-left: 5px;">{{data_count('admins')}}</span>
                        </a>
                    </div>
                @endcan

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.masrofat_data','admin.add_masrofat','admin.edit_masrofat']) ? 'active' : '' }}"
                       href="{{ route('admin.masrofat_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-currency-dollar text-warning fs-2x"></i> <!-- Changed icon class -->
        </span>
                        <span class="menu-title">{{translate('masrofat')}}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.archive_data','admin.add_archive','admin.edit_archive','admin.archive_files']) ? 'active' : '' }}"
                       href="{{ route('admin.archive_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-archive text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('archive') }}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.library_data') ? 'active' : '' }}"
                       href="{{ route('admin.library_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-book text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('library') }}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.agenda_data') ? 'active' : '' }}"
                       href="{{ route('admin.agenda_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-calendar2-check text-warning fs-2x"></i>
            <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('judicial_agenda') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.daily_reports_data') ? 'active' : '' }}"
                       href="{{ route('admin.daily_reports_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-file-text text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('daily_reports') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.add_contract_form','admin.contract_forms_data']) ? 'active' : '' }}"
                       href="{{ route('admin.contract_forms_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-file-text text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('contract_forms') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('') ? 'active' : '' }}"
                       href="{{ route('admin.user_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-gear text-warning fs-2x"></i> <!-- Replace with the desired Bootstrap Icon class -->
        </span>
                        <span class="menu-title">{{ translate('system_settings') }}</span>
                    </a>
                </div>


            </div>
        </div>
    </div>

</div>


