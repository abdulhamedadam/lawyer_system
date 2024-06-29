<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px" >
        <div class="card-body" style="padding: 10px">

            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11">
                    <a href="{{ route('admin.morfqat',$all_data->id) }}" class="btn btn-success p-2"> <!-- Changed to green color -->
                        <i class="bi bi-file-earmark fs-2x"></i> <?=translate('Client_attachments')?> <!-- Changed icon to Bootstrap -->
                    </a>

                    <a href="{{ route('admin.relatedCases',$all_data->id) }}" class="btn btn-primary p-2"> <!-- Changed to blue color -->
                        <i class="bi bi-exclamation-triangle  fs-2x"></i> <?=translate('Related_criminal_cases')?> <!-- Changed icon to Bootstrap -->
                    </a>

                    <a href="{{route('admin.payments',$all_data->id)}}" class="btn btn-danger p-2">
                        <i class="bi bi-cash fs-2x"></i> <?=translate('Financial_transactions')?> <!-- Changed icon to Bootstrap -->
                    </a>

                    <a href="{{ route('admin.notes',$all_data->id) }}" class="btn btn-info p-2"> <!-- Changed to light blue color -->
                        <i class="bi bi-sticky  fs-2x"></i> <?=translate('Notes')?> <!-- Changed icon to Bootstrap -->
                    </a>
                </div>

                <div class="col-md-1 text-end">
                    <a class="btn btn-warning p-2" href="{{ route('admin.clients_data') }}"> <!-- Changed to yellow color -->
                        <i class="bi bi-arrow-repeat fs-2x"></i>{{translate('back')}} <!-- Changed icon to Bootstrap -->
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
