<option value="">{{translate('select')}}</option>

@if($id==1)
        @foreach($all_data as $item)
            <option value="{{ $item->id }}">
                {{ $item->case_name }}---{{$item->client_name}}
            </option>
        @endforeach
@elseif($id==2)
    @foreach($all_data as $item)
        <option value="{{ $item->id }}" >{{ $item->employee }}</option>
    @endforeach
@elseif($id==3)
    @foreach($all_data as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
@endif
