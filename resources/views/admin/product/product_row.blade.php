

  <tr class="par">
    @if (isset($loop))
    <td>{{ $loop->iteration }}</td>
    @else
    <td>---</td>
    @endif
    <td>{{ $product ->name }}</td>
    <td>{{ $product ->barcode }}</td>
    <td>{{ $product ->price }}</td>
    <td>{{ $product ->south_code }}</td>
    <td>{{ $product ->euro_number }}</td>
    <td>
        {{ $user->product_traffic_code($product) }}
      </td>
    <td class="">
      <div class="form-selectgroup">
        {{-- <label class="form-check par">
            @php
                 $checked=false;
                 $status= 'Ready To Added';
                $is_exist=  $user->branch_products()->where('product_id', $product->id)->first();
                if($is_exist && $is_exist->pivot->show){
                  $checked=true;
                  $status= 'Added';
                }
            @endphp

            <input  data-u="{{ $user->id }}"  data-p="{{ $product->id }}" {{ $checked?'checked':'' }} class="form-check-input checkzoom m check_code " type="checkbox">
            <span  class="form-check-label ml-3 word">
                {{ $status }}
            </span>
          </label> --}}
          <span data-branch="{{ $user->id }}"  data-product="{{ $product->id }}"  class="btn remove_product btn-danger btn-square w-100">
            Rmove
          </span>
        {{-- <label class="form-selectgroup-item">
          <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
          <span class="form-selectgroup-label check_code">Add</span>
        </label> --}}
      </div>
    </td>
  </tr>
