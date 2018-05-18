<div class="deliver-table">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>

            </th>
            <th>
                วิธีการจัดส่ง
            </th>
            <th>
                price
            </th>
            <th>
                point
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($shippings as $shipping)
            @foreach($shipping->items as $item)
                <?php
                if(is_null($item->maximum_weight)){
                    $item->maximum_weight = PHP_INT_MAX;
                }
                ?>
                @if($item->minimum_weight <= $total_weight
                    && $item->maximum_weight >= $total_weight
                )
                <tr>
                    <td>
                        <input type="radio" id="shipping-type-id-{{ $item->id }}" name="shipping_type_id"
                               onclick="choose_this_type_all('type', '{{ $item->id }}' ,'{{ $shipping->name }}')"
                               value="{{ $item->id }}">
                    </td>
                    <td>
                        {{ $shipping->name }}
                    </td>
                    <td>
                        <input type="radio" id="shipping-price-choose-{{ $item->id }}" name="shipping_price_point_choose"
                               onclick="choose_this_type_all('price',{{ $item->id }} ,'{{ $shipping->name }}')"
                               value="price">
                        {{ number_format($item->amount) }}
                    </td>
                    <td>
                        <input type="radio" id="shipping-point-choose-{{ $item->id }}" name="shipping_price_point_choose"
                               @if($user->points_balance - $discount_point < $item->point_redemption)
                               disable
                               @endif
                               onclick="choose_this_type_all('point',{{ $item->id }} ,'{{ $shipping->name }}')"
                               value="point">
                        {{ number_format($item->point_redemption) }}
                    </td>
                </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
