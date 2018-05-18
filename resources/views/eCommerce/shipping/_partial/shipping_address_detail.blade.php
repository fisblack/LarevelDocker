<div
        class="group clearfix update-shipping"
        data-shipping_address_id="{{ $item->id }}"
        data-type="shipping-address"
>
    @if($shipping_address_id === $item->id)
        <input type="radio" id="f-option-{{ $item->id }}" name="selector_shipping" value="{{ $item->id }}" checked>
    @else
        <input type="radio" id="f-option-{{ $item->id }}" name="selector_shipping" value="{{ $item->id }}">
    @endif
    <label for="f-option-{{ $item->id }}">
        {{ $item->full_name }}
    </label>
    <div class="check"></div>

    <address>
        {{ $item->address }} <br />
        โทรศัพท์: <span class="red">{{ $user->phone }}</span>
    </address>

    <a href="#" class="bin">
        <img src="{{ asset('images/09_shipping/bin.png')}}" alt="">
    </a>

</div>
