@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div class="row col-md-12">
            <div class="col-md-3">
                @include('dashbord.admin.library.sidebar')
            </div>
            <div class="col-md-9">
                <div id="kt_app_content" class="app-content flex-column-fluid" >
                    <div id="kt_app_content_container" class="" style="padding-top: 20px" >
                        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                            <div class="card-header">
                                <h3 class="card-title">{{ translate('books_data') }}</h3>
                                <div class="card-toolbar">
                                    <div class="text-center">
                                        @if($fe2a_id == null )
                                            <a class="btn btn-primary" href="{{ route('admin.add_book') }}">
                                                <i class="bi bi-plus fs-1"></i> {{ translate('add_book') }}
                                            </a>
                                        @else
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalsettings" >
                                                <i class="bi bi-plus fs-1"></i> {{ translate('add_book') }}
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive" >
                                    <table id="table1" class="table table-bordered">
                                        <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th style="width: 5%"{{translate('m')}}<</th>
                                            <th style="text-align: center"> {{translate('book_name')}}</th>
                                            <th style="text-align: center"> {{translate('author')}}</th>
                                            <th style="text-align: center"> {{translate('description')}}</th>
                                            <th style="text-align: center"> {{translate('read_number')}}</th>
                                            <th style="text-align: center"> {{translate('size')}}</th>
                                            <th style="text-align: center"> {{translate('type')}}</th>
                                            <th style="text-align: center"> {{translate('book')}}</th>
                                            <th style="width: 20%; text-align: center"> {{translate('actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for PDF Viewer -->
    <div class="modal fade" id="myModal-pdf" tabindex="-1" aria-labelledby="myModal-pdf-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModal-pdf-label">PDF Viewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdf-viewer" src="" width="100%" height="500px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="modalsettings">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?=translate('add_general_settings')?></h3>


                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>
                <div class="modal-body">
                <form method="post" action="{{route('admin.save_book')}}" enctype="multipart/form-data" id="form">
                    @csrf
                    <input type="hidden" name="fe2a" id="fe2a" value="{{$fe2a_id}}">
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            <label for="basic-url" class="form-label">{{ translate('tasnef_books') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="form-select rounded-start-0" name="fe2a1" id="fe2a1" data-placeholder="{{ translate('select') }}" disabled>
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($fe2at as $item)
                                            <option value="{{ $item->id }}" {{ (old('fe2a',$fe2a_id) == $item->id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('fe2a')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="basic-url" class="form-label">{{ translate('book_name') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3"><i class="bi bi-address-card fs-2"></i></span>
                                <input type="text" class="form-control " name="book_name" id="book_name" value="" aria-describedby="basic-addon3" >
                            </div>
                            @error('book_name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <label for="basic-url" class="form-label">{{ translate('author') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="form-select rounded-start-0" name="author" id="author" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($author as $item)
                                            <option value="{{ $item->id }}" {{ old('author') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('author')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="basic-url" class="form-label">{{ translate('book') }}</label>
                            <input type="file" class="form-control " name="book" id="book" value="" aria-describedby="basic-addon3" readonly>
                            @error('book')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ translate('description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="modal-footer" style="margin-top: 10px">
                        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                    </div>
                </form>
                </div>


            </div>
        </div>
    </div>


@endsection
@section('js')


    "use strict";
    <script type="text/javascript">
        var save_method; // For the save method string
        var table;
        var dt;

    </script>


    <script>
        "use strict";
        var KTDatatablesServerSide = function () {

            var initDatatable = function () {
                table = $("#table1").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [[1, 'desc']],
                    stateSave: true,
                    language: {
                        url: "{{ asset('assets/Arabic.json') }}" // Assuming the file is placed in the public directory
                    },
                    ajax: {
                        url: "{{ route('admin.get_ajax_books',$fe2a_id) }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'book_name', className: 'text-center' },
                        { data: 'author', className: 'text-center' },
                        { data: 'description', className: 'text-center' },
                        { data: 'read_number', className: 'text-center' },
                        { data: 'size', className: 'text-center' },
                        { data: 'type', className: 'text-center' },
                        { data: 'book', className: 'text-center' },
                        { data: 'action', className: 'text-center' },
                    ],

                    columnDefs: [

                        {
                            "targets": [1],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': '#6610f2',

                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [3,2],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                });
                            }
                        },



                    ],

                });
            };

            return {
                init: function () {
                    initDatatable();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
    </script>


    <script>
        $(document).on('click', '.btn-open-pdf-modal', function() {
            var pdfUrl = $(this).data('book-url');
            $('#myModal-pdf iframe').attr('src', pdfUrl); // Set PDF URL to iframe src
            $('#myModal-pdf').modal('show'); // Open the modal
        });

    </script>


    <script>
        function update_seen(id)
        {
            $.ajax({
                url: "{{ route('admin.update_seen', ['id' => '__id__']) }}".replace('__id__', id),
                type: "POST",
                dataType: "json",
                success: function (data) {
                    table.ajax.reload(null, false);
                },
                error: function (xhr, status, error) {
                    table.ajax.reload(null, false);
                }
            });
        }
    </script>










    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Cases\CaseSettings', '#form') !!}
@endsection
