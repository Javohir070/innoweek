<option value="">{{__('-- Tanlang --')}}</option>
@foreach($data as $item)
  <option value="{{$item->id}}">{{$item->name}}</option>
@endforeach