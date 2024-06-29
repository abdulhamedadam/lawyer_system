<option value="">{{translate('select')}}</option>
@foreach($shelf as $item)
    <option value="{{ $item->id }}" {{ old('desk_id') == $item->id }}>{{ $item->title }}</option>
@endforeach
