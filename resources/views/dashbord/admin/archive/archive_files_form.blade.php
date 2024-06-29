<form method="post" action="{{ route('admin.add_archive_files',$all_data->id) }}" enctype="multipart/form-data">
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
            <input   class="form-control " type="file" name="file" id="file" aria-describedby="basic-addon3">

        </div>

        <div class="col-md-3">
            <div class="form-group" style="  margin-top: 27px;">
                <button type="submit" name="add" value="add" id="add_ezn"  class="btn btn-success btn-flat"><i class="bi bi-save"></i>
                    <?=translate('SaveButton')?> </button>
            </div>
        </div>
    </div>

</form>
