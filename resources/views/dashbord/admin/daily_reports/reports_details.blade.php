<div class="col-md-12" style="margin-top: 10px">
    <div class="mb-3">
        <label for="details1" class="form-label">{{ translate('details') }}</label>
        <textarea class="form-control" id="details1" name="details1" rows="3" readonly>{{ old('details',$all_data->details) }}</textarea>
        @error('details')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>


