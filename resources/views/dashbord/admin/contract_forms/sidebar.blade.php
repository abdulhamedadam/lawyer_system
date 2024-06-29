<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="" style="padding-top: 20px;padding-right: 20px">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class=" nav-icon fa fa-cog fa-fw text-primary"></i>

                    <?=translate('contract_forms')?>

                </h3>
            </div>


            <div class="card-body" style="padding: 10px !important;">
                <div class="row">
                    <div class="col-12 col-sm-12" >
                        <nav class="" style="background-color: lightgoldenrodyellow; border-radius: 5px;">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                @foreach($contracts as $item)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.contract_forms_data',$item->id) }}" class="nav-link @if($item->id == $contract_id) active @endif" style="width: 100%;">
            <span style="display: flex; justify-content: space-between; align-items: center;">
                <span>
                    <i class="bi bi-file-text-fill fs-2 nav-icon text-danger"></i> <!-- Bootstrap Icon for folder -->
                    {{ $item->contract_name }}
                </span>

            </span>
                                        </a>
                                    </li>
                                @endforeach
                                    <hr class="nav-separator">


                            </ul>
                        </nav>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
