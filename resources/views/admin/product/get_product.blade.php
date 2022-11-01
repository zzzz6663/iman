<option  > select produuct   </option>
@foreach($products as $product)
    <option value="{{$product->id}}">{{$product->name}} - {{$product->brand->name}} -({{$product->width }}  * {{$product->height }} * {{$product->unit }})</option>
@endforeach
