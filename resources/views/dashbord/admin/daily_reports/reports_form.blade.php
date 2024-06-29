@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_report') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.daily_reports_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{ translate('back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.save_report') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('related_to_case?') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="related_to_case" id="related_to_case" data-placeholder="{{ translate('select') }}">
                                            <?php
                                              $option=array('no'=>translate('no'),'yes'=>translate('yes'))
                                            ?>
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($option as $index=>$value)
                                                <option value="{{ $index }}" {{ old('related_to_case') == $index ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('fe2a')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('cases') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="case_id" id="case_id" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($cases as $item)
                                                <option value="{{ $item->id }}" {{ old('case_id') == $item->id ? 'selected' : '' }}>{{ $item->case_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('case_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('send_to') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="to_emp_id" id="to_emp_id" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($employees as $item)
                                                <option value="{{ $item->id }}" {{ old('to_emp_id') == $item->id ? 'selected' : '' }}>{{ $item->employee }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('to_emp_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ translate('details') }}</label>
                                <textarea class="form-control" id="details" name="details" rows="3" >{{ old('details') }}</textarea>
                                @error('details')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <br>
                        <div class="row ">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered"  id="mytable"  >
                                    <thead style="background-color: #dddde5">
                                    <tr class="info">
                                        <th style="width: 100px;"> {{translate('m')}} </th>
                                        <th style="width: 100px;"> {{translate('sub_task_name')}} </th>
                                        <th style="width: 150px;">{{trans('date')}}</th>
                                        <th style="width: 200px;"> {{trans('time')}}</th>
                                    </tr>
                                    </thead>

                                    <tbody id="resultTable">
                                    <?php
                                    $y=1;
                                    ?>
                                    <input type="hidden" name="rows[]" value="<?=$y?>" id="rows">
                                    <tr id="<?=$y?>" value="<?=$y?>" name="all_row[]">
                                        <td>
                                            <label>{{$y}}</label>
                                        </td>
                                        <td>
                                            <input style="width: 1500px;" type="text" name="sub_task_name[]" class="form-control testButton "
                                                   id="sub_task_name<?= $y ?>" value=""  data-validation="required"/>
                                        </td>
                                        <td>
                                            <input style="width: 80px;" type="date" name="date[]" class="form-control " id="date<?= $y ?>"  value="" />
                                        </td>
                                        <td>
                                            <input style="width: 80px;" type="time" name="time[]" class="form-control " id="time<?= $y ?>"  value="" />
                                        </td>


                                        <td>

                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center" style="background-color: #fff; ">
                                            <button type="button" onclick="add_row()"
                                                    class="btn btn-success btn-next" style="width: 30px !important;height: 30px !important;"/><i class="fa fa-plus"></i>
                                            </button>
                                        </th>





                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat">
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
        $(document).ready(function(){
            $('#related_to_case').on('change', function(){
                var value = $(this).val();
                if(value == 'yes') {
                    $('#case_id').prop('disabled', false);
                } else {
                    $('#case_id').prop('disabled', true);
                }
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#details'), {
                language: 'ar', // Set the language to Arabic
                // OR
                // contentLanguageDirection: 'rtl', // Set content language direction to RTL
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
