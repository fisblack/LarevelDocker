<div
        class="group clearfix update-shipping"
        data-billing_address_id="{{ $item->id }}"
        data-type="billing-address"
>

    @if($billing_address_id === $item->id)
        <input type="radio" id="f-option-billing-{{ $item->id }}" name="selector_billing" value="{{ $item->id }}" checked>
    @else
        <input type="radio" id="f-option-billing-{{ $item->id }}" name="selector_billing" value="{{ $item->id }}">
    @endif
    <label for="f-option-billing-{{ $item->id }}">
        {{ $user->full_name }}
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
