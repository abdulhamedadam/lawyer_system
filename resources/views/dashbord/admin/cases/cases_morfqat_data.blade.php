

<div class="" style="margin-top: 30px">
    @if(!empty($files_data) && $files_data->isNotEmpty())
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="100%">
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{translate('hash') }}</th>
                <th>{{ translate('file_name') }}</th>
                <th>{{ translate('file_type') }}</th>
                <th>{{ translate('attachment') }}</th>
                <th>{{ translate('file_size') }}</th>
                <th>{{ translate('publisher') }}</th>
                <th>{{ translate('added_date') }}</th>
                <th>{{ translate('added_time') }}</th>
                <th>{{ translate('actions') }}</th>

            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
                $image = ['gif', 'Gif', 'ico', 'ICO', 'jpg', 'JPG', 'jpeg', 'JPEG', 'BNG', 'png', 'PNG', 'bmp', 'BMP'];
                $file = ['pdf', 'PDF', 'xls', 'xlsx', ',doc', 'docx', 'txt'];
            @endphp
            @foreach ($files_data as $morfaq)
                @php
                    $ext = pathinfo($morfaq->file, PATHINFO_EXTENSION);
                    $folder = Storage::disk('files');
                    $Destination = $folder->path($morfaq->file);
                    if(file_exists($Destination)) {
                                               $size= formatFileSize($Destination);
                                                }else{
                                                $size =0;
                                                }

                @endphp
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $morfaq->file_name }}</td>
                    <td>
                        @php
                            $f_title = $morfaq->file_name ?? 'غير محدد';
                        @endphp
                        @if (in_array($ext, $image))
                            <i class="bi bi-image fs-2" aria-hidden="true" title="{{ $f_title }}"></i>
                        @elseif (in_array($ext, $file))
                            <i class="bi bi-file-pdf fs-2" aria-hidden="true" title="{{ $f_title }}"></i>
                        @endif
                    </td>
                    <td>
                        @if (in_array($ext, $image))
                            <a data-bs-toggle="modal" data-bs-target="#myModal-view-{{ $morfaq->id }}">
                                <i class="bi bi-eye fs-2" title="{{ __('view_file') }}"></i>
                            </a>

                            <div class="modal fade" tabindex="-1" id="myModal-view-{{ $morfaq->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Modal title</h3>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1">&times;</i>
                                            </div>

                                        </div>

                                        <div class="modal-body">
                                            <img src="{{ asset(Storage::disk('files')->url($morfaq->file)) }}" width="100%" alt="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @elseif (in_array($ext, $file))
                            <a data-bs-toggle="modal" data-bs-target="#myModal-pdf-{{ $morfaq->id }}">
                                <i class="bi bi-eye fs-2" title="{{ __('view_file') }}"></i>
                            </a>

                            <div class="modal fade" tabindex="-1" id="myModal-pdf-{{ $morfaq->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Modal title</h3>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1">&times;</i>
                                            </div>

                                        </div>

                                        <div class="modal-body">
                                            <iframe src="{{ route('admin.case_read_file',$morfaq->id) }}" style="width: 100%; height: 640px;" frameborder="0"></iframe>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </td>
                    <td class="fnt_center_blue">
                        {{ $size }}
                    </td>
                    <td class="fnt_center_blue">{{ $morfaq->publisher_n }}</td>
                    <td class="fnt_center_black">{{ \Illuminate\Support\Carbon::parse($morfaq->created_at)->format('Y-m-d') }}</td>
                    <td class="fnt_center_red">{{ \Illuminate\Support\Carbon::parse($morfaq->created_at)->format('H:i:s') }}</td>


                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.archive_download_file', $morfaq->id) }}" class="btn btn-sm btn-primary" title="{{ translate('download') }}">
                                <i class="bi bi-download"></i>
                            </a>
                            <a href="{{ route('admin.archive_delete_file', $morfaq->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    @endif
</div>





