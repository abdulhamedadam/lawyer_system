
@if($archive->isNotEmpty() )


    <table class="table table-bordered table-sm table-striped" >
        <tbody>
        <tr style="background: lightgoldenrodyellow">
            <td class="class_label" style="color:blue"><?= translate('desk') ?></td>
            <td class="class_result"><?php echo $archive_data->desk; ?></td>
            <td class="class_label"  style="color:blue"><?= translate('shelf') ?></td>
            <td class="class_result"><?php echo $archive_data->shelf; ?></td>
            <td class="class_label"  style="color:blue"><?= translate('secret_degree') ?></td>
            <td class="class_result"><?php echo $archive_data->secret_degree; ?></td>
            <td class="class_label"  style="color:blue"><?= translate('folder_code') ?></td>
            <td class="class_result">{{ $archive_data->folder_code }}</td>
        </tr>
        </tbody>
    </table>


    <form  method="post" action="{{ route('admin.add_files',$all_data->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="row col-md-12 ">
            <div class="col-md-4" >
                <label for="basic-url"class="form-label">{{translate('attachment_name')}}</label>
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                    <input type="text"  class="form-control " name="file_name"  id="file_name" value="{{old('file_name')}}"  aria-describedby="basic-addon3">
                </div>
                @error('file_name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5" >
                <label for="basic-url"class="form-label">{{translate('attachment')}}</label>
                <input   class="form-control " type="file" name="file[]" id="file" aria-describedby="basic-addon3">
                @if ($errors->has('file.*'))
                    <span class="invalid-feedback d-block" role="alert">{{ $errors->first('file.*') }}</span>
                @endif
            </div>
            <input type="hidden" name="folder_code" id="folder_name" value="{{$archive_data->folder_code}}">
            <input type="hidden" name="archive_id" id="archive_id" value="{{$archive_data->id}}">

            <div class="col-md-3">
                <div class="form-group" style="  margin-top: 30px;">

                    <button type="submit" name="add" value="add" id="add_ezn"  class="btn btn-success btn-flat"><i class="bi bi-save fs-2"></i>
                        <?=translate('SaveButton')?> </button>
                </div>
            </div>
        </div>

    </form>

@else


    <a  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-flat"><i class="bi bi-archive fs-2"></i>
        <?=translate('AddArchiveFolder!')?> </a>
    <div class="modal fade" tabindex="-1" id="myModal">
        <div class="modal-dialog " style="width: 120%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title bg-gray-25">{{translate('add_archive')}}</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>
                <form id="form"  method="post" action="{{ route('admin.client_add_archive',$all_data->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6" style="">
                                <label for="basic-url" class="form-label">{{ translate('archive_type') }}</label>
                                <select class="form-select "  name="type" id="type" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                    <option value="">{{ translate('select') }}</option>
                                    <?php  $types=archive_type(); ?>
                                    @foreach($types as $key=>$value)
                                        <option value="{{ $key }}" @if($key =='clients') selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label">{{ translate('secret_degree') }}</label>

                                <select class="form-select " name="secret_degree" id="secret_degree" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                    <option value="">{{ translate('select') }}</option>
                                    <?php  $types=secret_degree(); ?>
                                    @foreach($types as $key=>$value)
                                        <option value="{{ $key }}" {{ old('secret_degree') == $key }}>{{ $value }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('desk') }}</label>

                                <select class="form-select " onchange="get_shelf(this.value)" name="desk_id" id="desk_id" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                    <option value="">{{ translate('select') }}</option>
                                    @foreach($desk as $item)
                                        <option value="{{ $item->id }}" {{ old('desk_id') == $item->id }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('shelf') }}</label>

                                <select class="form-select "  name="shelf_id" id="shelf_id" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                    <option value="">{{ translate('select') }}</option>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('folder_code') }}</label>
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="form-control" name="folder_code" id="folder_code" value="{{ old('folder_code') }}" aria-describedby="basic-addon3">
                                </div>
                            </div>
                        </div>






                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                            <i class="bi bi-save"></i> {{ translate('SaveButton') }}
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endif

@section('js')
    <script>
        function get_shelf(id)
        {
            $.ajax({
                url: "{{ route('admin.get_shelf', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#shelf_id').html(html);
                },
            });
        }
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Cases\ArchiveCase_R', '#') !!}
@endsection
