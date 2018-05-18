{{-- 
    @author: MR.SOMPOB MOONSRI (Nick)
    @phone: 0811129499
    @email: eslidiingz@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/printDelivery/show.css') }}">
@endsection

@section('body')       
    <div class="container-fluid">
      <div class="wrapper">
        <div class="panel panel-default panel-container">
          <div class="panel-heading hidden-print">
            <div class="panel-title">
              <figure>
                <img src="{{ asset('images/backOffice/printDelivery/icon-print.png') }}"> Print Delivery
              </figure>
            </div>
          </div>
          
          <div class="panel-body">
            @foreach($orders as $key => $order)
              <div class="row @if($key!=$orders->keys()->last()) p-b-a @endif">
                <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default panel-form">
                    <div class="panel-heading">
                      <div class="text-right">
                        <figure>
                          <img src="{{ asset('images/backOffice/printDelivery/logo.png') }}">
                        </figure>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="title"><strong>กรุณาส่ง</strong></div>
                      <div class="panel-body shipping">
                        <div><strong>คุณ {{$order->full_name}}</strong></div>
                        <p>
                        {{ $order->shipping_address_line_1 }} {{ $order->shipping_address_line_2 }} </br>
                         {{ $order->shippingSubDistrict->name }} {{ $order->shippingDistrict->name }} </br>
                         {{ $order->shippingProvince->name }} {{ $order->shippingPostCode->code}}
                          <!-- 96/187 ซอยคู้บอน 27 แยก 22 <br>
                          ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน <br>
                          กทม 10220 -->
                        </p>
                        <p>
                        เบอร์โทรศัพท์: {{ $order->phone }}
                        </p>
                        <img src="{{'data:image/png;base64,'.DNS1D::getBarcodePNG($order->id, 'C128','3','50')}}" alt="barcode"   />
                        <!-- <figure>
                          <img src="{{ asset('images/backOffice/printDelivery/barcode.png') }}">
                        </figure> -->
                        <div class="order"><span>Order: </span> #{{$order->id}}</div>
                      </div>
                    </div>
                    <div class="panel-footer">
                      <div class="title"><strong>ใบส่งสินค้า</strong></div>

                      <div class="detail-content">
                        @foreach($order->items as $item)
                        <div class="detail-container">
                          <div class="row">
                            <div class="col-sm-2 cover">
                              <div>
                                <img src="@if(isset($item->product->imageCover)) {{ getImage($item->product->imageCover->image) }} @else {{ asset('images/backOffice/printDelivery/cover-1.png') }} @endif">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="subject">{{ $item->product->name }}</div>
                              <div class="quantity">จำนวน  {{ $item->quantity }}  เล่ม</div>
                              <div class="point-reward">PTS {{ number_format($item->point_per_unit, 0) }} คะแนนสะสม</div>
                            </div>
                            
                            <div class="col-sm-4">
                              <div class="price">
                                <label>ราคา</label>
                                {{ number_format($item->price_per_unit, 2) }} บาท
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <!-- <div class="detail-container">
                          <div class="row">
                            <div class="col-sm-2 cover">
                              <div>
                                <img src="{{ asset('images/backOffice/printDelivery/cover-1.png') }}">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="subject">Space ช่องว่างระหว่างเรา</div>
                              <div class="quantity">จำนวน  1  เล่ม</div>
                              <div class="point-reward">PTS 100 คะแนนสะสม</div>
                            </div>
                            
                            <div class="col-sm-4">
                              <div class="price">
                                <label>ราคา</label>
                                359.00 บาท
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="detail-container">
                          <div class="row">
                            <div class="col-sm-2 cover">
                              <figure>
                                <img src="{{ asset('images/backOffice/printDelivery/cover-2.png') }}">
                              </figure>
                            </div>
                            <div class="col-sm-6">
                              <div class="subject">Perhaps Love ทดลองรัก</div>
                              <div class="quantity">จำนวน  1  เล่ม</div>
                              <div class="point-reward">PTS 100 คะแนนสะสม</div>
                            </div>
                            <div class="col-sm-4">
                              <div class="price">
                                <label>ราคา</label>
                                209.00 บาท
                              </div>
                            </div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            <div class="form-group text-center hidden-print">
              <button class="btn btn-primary" onclick="myFunction()">Print</button>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script>
  function myFunction() {
    window.print();
}
</script>
  
@endsection