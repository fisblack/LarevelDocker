<div class="thank-detail clearfix">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 logo">
            <figure>

                <img src="{{ asset('images/11_thank/thank-list.png')}}" alt="">
            </figure>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 date-order">
            {{ Carbon\Carbon::now()->format('d-m-Y') }}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 date-time">
            {{ Carbon\Carbon::now()->format('H:i') }}
        </div>
    </div>

    <div class="row list-detail-item">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class=" list-itme" style="    ">
                <table class="table">
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="title">
                                {{ $product->name }}
                            </td>
                            <td class="qty">
                                {{ $product->qty }}
                            </td>
                            <td class="price">
                                {{ number_format($product->total_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row delivery">
        <div class="col-xs-12 col-sm-12 col-md-12">
              <span class="delivery-text">
                  @if(isset($shipping_name))
                      ส่งแบบ {{$shipping_name}}
                  @else
                      โปรดเลือกวิธีการจัดส่ง
                  @endif
              </span>
            <p class="delivery-date">
               {{$shipping_time}}
            </p>
        </div>
    </div>

    <div class="row summary">
        <div class="col-xs-6 col-sm-6 col-md-6 ">
              <span class="total-text">
                มูลค่าสินค้า
              </span>
              <span class="total-text">
                ใช้แต้มแลก
              </span>
              @if(isset($usePromotion[0]['name']))
                <span class="total-text" style="width: 150px;">
                ใช้โปรโมชั่นลด {{$usePromotion[0]['discount_value']}}{{$usePromotion[0]['discount_type'] == 'percent' ? '%':'บาท'}}
                </span>
                @if($usePromotion[0]['discount_type'] == 'percent')
                    <p class="point-text">
                        คิดจาก
                    </p>
                @endif
              @endif
            <span class="total-text">
                มูลค่าสุทธิ
              </span>
            <p class="point-text">
                หมายเหตุ
            </p>
            <p class="point-text">
                ได้รับคะแนน
            </p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 ">
            <?php
            $total = $total_price;
            $dis_point = $discount_price;
            $dis_promotion = 0;
            ?>
              <span class="total">
                {{ number_format($total_price, 2) }}
              </span>
              <span class="total">
                - {{ number_format($discount_price, 2) }}
              </span>
            @if(isset($usePromotion[0]['name']))
                <?php
                if($usePromotion[0]['discount_type'] == 'percent'){
                    ?>
                <span class="total">
                - {{number_format($total_price * $usePromotion[0]['discount_value'] / 100, 2)}}
                    <?php $dis_promotion = $total_price * $usePromotion[0]['discount_value'] / 100;?>
                </span>
                <p class="point">
                    ( {{$total_price}} x {{$usePromotion[0]['discount_value']}} / 100 )
                </p>
                <?php
                }else{
                ?>
                <span class="total">
                - {{ number_format($usePromotion[0]['discount_value'], 2) }}
                    <?php $dis_promotion = $usePromotion[0]['discount_value'];?>
                </span>
                <?php
                }
                ?>
            @endif
                <span class="total">
                {{ number_format($total - $dis_point - $dis_promotion, 2) }}
               </span>
                <p class="point">
                    ไม่รวมภาษีมูลค่าเพิ่ม
                </p>
            <p class="point">
                + {{$total_reward_point}} Points
            </p>
        </div>
    </div>
</div>
