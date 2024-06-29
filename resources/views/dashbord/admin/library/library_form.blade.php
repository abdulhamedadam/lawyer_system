@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_book') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.library_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{ translate('back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.save_book') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tasnef_books') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="fe2a" id="fe2a" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($fe2at as $item)
                                                <option value="{{ $item->id }}" {{ old('fe2a') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('fe2a')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('book_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-address-card fs-2"></i></span>
                                    <input type="text" class="form-control " name="book_name" id="book_name" value="" aria-describedby="basic-addon3" >
                                </div>
                                @error('book_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
@endsection
