@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('add_to_archive')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.archive_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form  action="{{ route('admin.update_archive',$all_data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-4" style="">
                                <label for="basic-url" class="form-label">{{ translate('archive_type') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-archive"></i></span>
                                    <select class="form-select "  name="type_id" id="type_id" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($types as $item)
                                            <option value="{{ $item->id }}"  @if(old('type_id',$all_data->type_id) == $item->id) selected @endif >{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('related_folders') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-folder"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select " onchange="get_related_data(this.value)"  name="related_folder" id="related_folder" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            <?php $type_arr = array(1 => translate('casses'), 2 => translate('employees'), 3 => translate('clients'),4 => translate('not_related')) ?>
                                            @foreach($type_arr as $key=>$value)
                                                <option value="{{ $key }}" @if (old('user_role',$all_data->related_folder) == $key) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('related_folder')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="basic-url" class="form-label">{{ translate('related_entity') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select "  name="related_entity_id" id="related_entity_id" data-control="select2"  data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('related_entity_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('secret_degree') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-lock"></i></span>
                                    <select class="form-select " name="secret_degree" id="secret_degree" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($secret_degree as $item)
                                            <option value="{{ $item->id }}" @if (old('desk_id',$all_data->secret_degree) == $item->id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('secret_degree')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('desk') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-desk"></i></span>
                                    <select class="form-select " onchange="get_shelf(this.value)" name="desk_id" id="desk_id" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($desk as $item)
                                            <option value="{{ $item->id }}" @if (old('desk_id',$all_data->desk_id) == $item->id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('desk_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('shelf') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-bookshelf"></i></span>
                                    <select class="form-select "  name="shelf_id" id="shelf_id" data-control="select2" data-show-subtext="true" data-live-search="true" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                    </select>
                                </div>
                                @error('shelf_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('folder_code') }}</label>
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="form-control" name="folder_code" id="folder_code" value="{{ old('folder_code',$all_data->folder_code) }}" aria-describedby="basic-addon3">
                                </div>
                                @error('folder_code')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                                    <i class="bi bi-save"></i> {{ translate('SaveButton') }}
                                </button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>








@endsection

@section('js')


    @notifyJs

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#related_folder").trigger("change");
                $("#desk_id").trigger("change");
            }, 300);
        });
    </script>


    <script>
        function get_shelf(id)
        {
            $.ajax({
                url: "{{ route('admin.get_shelf', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#shelf_id').html(html);
                    $('#shelf_id').val(<?=$all_data->shelf_id?>);
                },
            });
        }
    </script>
    <script>
        function get_related_data(id)
        {
            $.ajax({
                url: "{{ route('admin.get_related_data', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#related_entity_id').html(html);
                    $('#related_entity_id').val(<?=$all_data->related_entity_id?>);
                },
            });
        }
    </script>
@endsection



