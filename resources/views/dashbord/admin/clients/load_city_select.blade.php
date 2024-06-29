<option value="">{{translate('select')}}</option>
@foreach($all_data as $item)
    <option value="{{$item->id}}">{{$item->title}}</option>
@endforeach
