{{--
    @author: Parada Susuk (Care)
    @phone: 0835548554
    @email: careparadas@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/dashboard/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
@endsection

@section('body')
     <div class="order">
   <div class="summary">
     <div class="row max">
  <div class="col-sm-7 col-md-8 col-lg-9">

        <div class="dleft">
           <div class="dhead">สรุปยอดขาย</div>

           <div class="box-graph">
               <div class=" col-xs-12 col-sm-12  col-md-4 col-lg-3">
                   <div class="btn-graph">
                   <a href="{{ route('backOffice.dashboard.index','date=day') }}" class="btn-g g1 @if($date=='day') active @endif">DAY</a>
                    <a href="{{ route('backOffice.dashboard.index','date=week') }}" class="btn-g  g2 @if($date=='week') active @endif">WEEK</a>
                     <a href="{{ route('backOffice.dashboard.index','date=month') }}" class="btn-g  g3 @if($date=='month') active @endif">MONTH</a>
               </div>

               </div>
               <div class=" col-xs-12  col-sm-12   col-md-8 col-lg-9">


                   <div class="graph ">
                 <div class="wrapper">

                       <div id="container"></div>
                 </div>

               </div>
               </div>


           </div>
       </div>
  </div>
  <div class="col-sm-5  col-md-4 col-lg-3">

 <div class="dright">
<ul class="total shadow">
    <!-- <li class="first">จันทร์ : 21 สิงหาคม 2560</li> -->
    <li class="first">{{$head}}</li>
    
    <li class="active">
        <div class="txt">ยอดขายทั้งหมด</div>
        <div class="num">{{$dashboard->sum('total_price')}}</div>
    </li>
    <!-- <li class="active">
        <div class="txt">ยอดขาย(%)</div>
        <div class="num">60%</div>
    </li> -->
    <li class="active">
        <div class="txt">จำนวนใบสั้งซื้อทั้งหมด</div>
        <div class="num">{{$dashboard->count()}}</div>
    </li>
    <li class="active">
        <div class="txt">สินค้าขายดี</div>
        <div class="num">@if($salable){{$salable->product->name}}@endif</div>
    </li>
        <li>
        <div class="txt">Facebook feed analyze</div>
        <div class="num">0:45</div>
    </li>
    <li class="active">
        <div class="txt">หมวดสินค้าที่ขายดีที่สุด</div>
        <div class="num">@if($catagory){{$catagory->name_th}}@endif</div>
    </li>

</ul>
          </div>

  </div>
</div>



   </div>
   <div class="dbox max">
        <div class="col-sm-7 col-md-8 col-lg-9">

        <div class="dleft padding">
          <div class="bg shadow radius">
              <div class="header underline">
                    <div class="page-name float-left">
                      <div class="icon float-left">
                         <img src="{{ asset('images/backOffice/Dashboard/monitor.png') }}">
                      </div>

                      <div class="text float-left">
                        ภาพรวม
                      </div>
                    </div>
                    <!-- <div class="delete btn-action float-right border-left">
                        <a href="#"> <img src="{{ asset('images/backOffice/Dashboard/setting.png') }}"></a>
                    </div> -->

                    <!-- <div class="add btn-action float-right border-left">
                          <a href="/create">  <img src="{{ asset('images/backOffice/Dashboard/undo2.png') }}"></a>
                    </div> -->
                    <div class="box float-right">
                        <!-- <div class="sort btn-action border-left">
                            <a href="/create">  <img src="{{ asset('images/backOffice/Dashboard/sort.png') }}"></a>
                        </div> -->
                        <!-- <div class="list-new">
                            <div class="item-new">
                                test
                            </div>
                            <div class="item-new">
                                test
                            </div>
                            <div class="item-new">
                                test
                            </div>
                        </div> -->
                    </div>

              </div>
              <div class="list underline">
                  <!--start  -->
                @foreach($orders as $order)
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member1.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#{{$order->id}}</div>
                                <div><span>Name</span>{{$order->full_name}}</div>
                              </div>
                              <div class="col col-2 ">
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                @if($order->is_paid)
                                    <span class="yes">ชำระเงินแล้ว</span>
                                @else
                                    <span class="no">ยังไม่ได้ชำระเงิน</span>
                                @endif
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                @if($order->status === 'paid_unshipped' || $order->status === 'unpaid')
                                    <span class="no">ยังไม่ได้จัดส่ง</span>
                                @endif
                                @if($order->status === 'paid_shipping')
                                    <span class="warning">เตรียมการจัดส่ง</span>
                                @endif
                                @if($order->status === 'paid_shipped')
                                    <span class="yes">จัดส่งแล้ว</span>
                                @endif

                              </div>

                          </div>
                        </div>
                    </div>


                    <a href="{{ route('backOffice.order.print', $order->id) }}" class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </a>
                    <!-- <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                        <a href="{{ route('backOffice.order.edit', $order->id) }}" class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                        </a>
                    </div> -->
                              <div class="price float-right">

                       <div class="price-num">
                        {{ number_format($order->total_price, 2) }}
                            บาท
                        </div>
                       <div class="price-txt">
                           @if(intval($order->shipping_fee) > 0)
                           ค่าจัดส่ง </br>{{ number_format($order->shipping_fee, 2) }} บาท
                           @else
                           ฟรีค่าจัดส่ง
                           @endif

                        </div>

                    </div>

                </li>
                @endforeach
                <!--end  -->
                <!-- <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member1.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#34345554</div>
                                <div><span>Name</span>Benjamin Houston</div>
                              </div>
                              <div class="col col-2 ">
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="no">ยังไม่ได้ชำระเงิน</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="no">ยังไม่ได้จัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>


                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                              <div class="price float-right">

                       <div class="price-num">250.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member2.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#32345456</div>
                                <div><span>Name</span>Adeline Burgess</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">เตรียมการจัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">450.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member3.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#128584343</div>
                                <div><span>Name</span>Melvin Hampton</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">เตรียมการจัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">1,250.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>

                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member4.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#34345554</div>
                                <div><span>Name</span>Juan Wise</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box payment ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">จัดส่งแล้ว</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">2,350.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member1.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#34345554</div>
                                <div><span>Name</span>Benjamin Houston</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="no">ยังไม่ได้ชำระเงิน</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="no">ยังไม่ได้จัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>


                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                              <div class="price float-right">

                       <div class="price-num">250.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member2.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#32345456</div>
                                <div><span>Name</span>Adeline Burgess</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">เตรียมการจัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">450.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member3.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#128584343</div>
                                <div><span>Name</span>Melvin Hampton</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box sent ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">เตรียมการจัดส่ง</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">1,250.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li>

                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="image-cropper">
                            <img src="{{ asset('images/backOffice/Dashboard/member4.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div><span>Order</span>#34345554</div>
                                <div><span>Name</span>Juan Wise</div>
                              </div>
                              <div class="col col-2 ">
                               <div><span>Date</span>25/08/2060</div>
                              </div>

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment">
                                <div class="topic">การชำระเงิน</div>
                                <span class="yes">ชำระเงินแล้ว</span>
                              </div>
                              <div class="box payment ">
                                <div class="topic">การจัดส่ง</div>
                                <span class="yes">จัดส่งแล้ว</span>
                              </div>

                          </div>
                        </div>
                    </div>
                    <div class="print float-right">
                      <img class="btn-print"` src="{{ asset('images/backOffice/Dashboard/detail.png') }}">

                    </div>
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/Dashboard/print3.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/Dashboard/edit.png') }}">
                      </div>
                    </div>
                                    <div class="price float-right">

                       <div class="price-num">2,350.00 บาท</div>
                       <div class="price-txt">ฟรีค่าจัดส่ง</div>

                    </div>

                </li> -->

<!-- frezz -->




              </div>


          </div>
       </div>
  </div>
  <div class="col-sm-5  col-md-4 col-lg-3">
         <div class="dright">
         <ul class="user shadow">
    <li class="first">




                      <div class="icon float-left">
                         <img src="{{ asset('images/backOffice/Dashboard/user.png') }}">
                      </div>

                      <div class="text float-left">
                        Member
                      </div>

                      <div class="view-more float-right">
                       <a href="{{ route('backOffice.member.index') }}">View All</a>
                      </div>



    </li>
    @foreach($users as $index => $user)
    <li>
        <div class="txt">
              <div class="profile-img float-left">
                          <div class="image-cropper">
                            @if($user->image)
                                <img src="{{ getImage($user->image) }}">
                            @else
                                <img src="{{ asset('images/backOffice/member/user.png') }}">
                            @endif
                          </div>
                        </div>

                          <div class="detail">

                                <div class="txt3">{{ $user->full_name }}</div>
                                <!-- <div class="txt2"><div class="online"></div><div class="txt4">online</div></div> -->
                                <!-- <div class="txt2"><div class="offline"></div><div class="txt4">Offline</div></div> -->


                            </div>
        </div>
         <div class="num">
            <a href="{{ route('backOffice.member.edit',  $user->id) }}">
                View Profile
            </a>
         </div>
    </li>
    @endforeach


</ul>

      <ul class="last shadow1">
    <li class="first">

                      <div class="icon float-left">
                         <img src="{{ asset('images/backOffice/Dashboard/order.png') }}">
                      </div>

                      <div class="text float-left">
                        Lasted Order
                      </div>

                      <div class="view-more float-right">
                       <a href="{{ route('backOffice.order.index') }}">View All</a>
                      </div>

    </li>
    <!-- <li>
        <div class="txt">


                          <div class="detail">

                                <div class="txt3">Order: #12345445</div>
                                <div class="txt2"><a href="">รายละเอียด</a></div>


                            </div>
        </div>
        <div class="num "><span class="label-gray">รอชำระเงิน</span></div>
    </li>
    <li>
        <div class="txt">


                          <div class="detail">

                                 <div class="txt3">Order: #12345445</div>
                                <div class="txt2"><a href="">รายละเอียด</a></div>


                            </div>
        </div>
         <div class="num "><span class="label-yellow">เตรียมการจัดส่ง</span></div>
    </li>
    <li>
        <div class="txt">


                          <div class="detail">

                                 <div class="txt3">Order: #12345445</div>
                                <div class="txt2"><a href="">รายละเอียด</a></div>


                            </div>
        </div>
        <div class="num "><span class="label-green">จัดส่ง</span></div>
    </li> -->
    @foreach($orders as $order)
        <li>
            <div class="txt">


                            <div class="detail">

                                    <div class="txt3">Order: #{{$order->id}}</div>
                                    <div class="txt2"><a href="{{ route('backOffice.order.print', $order->id) }}">รายละเอียด</a></div>


                                </div>
            </div>
            <div class="num">
                    @if($order->status === 'paid_unshipped' || $order->status === 'unpaid')
                        <span class="label-gray">ยังไม่ได้จัดส่ง</span>
                    @endif
                    @if($order->status === 'paid_shipping')
                        <span class="label-warning">เตรียมการจัดส่ง</span>
                    @endif
                    @if($order->status === 'paid_shipped')
                        <span class="label-green">จัดส่งแล้ว</span>
                    @endif
            </div>
        </li>
    @endforeach


</ul>
       </div>
       </div>
   </div>





    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
        $(function () {
    Highcharts.setOptions({
    colors: ['#980f0e']
});
var car_week = [ 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์','อาทิตย์'];
var car_month = ['1','2','3','4','5','6','7','8','9','10','11','12'];
var date = [];
var data = [];
@if($date=='day') 
 date = ["{{$day}}"];
 data = JSON.parse("{{ $data }}")
@elseif($date=='week')
date = car_week;
data = JSON.parse("{{ $data }}")
@elseif($date=='month')
date = car_month;
data = JSON.parse("{{ $data }}")

@endif
 
console.log(date)
console.log(data)
Highcharts.chart('container', {
chart: {
         backgroundColor: 'transparent',
     polar: true,
     type: 'line',

  },

    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: 'Number of Employees',
        enabled:false
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        enabled:false
    },
    xAxis: {
        categories: date
    },
    series: [{
        data: data,
        zoneAxis: 'x',
        zones: [{
            value: 8
        }, {
            dashStyle: 'dot'
        }]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});




    $(window).resize(function(){
         $('#container').height(280);
        var chart = $('#container').highcharts();

        console.log('redraw');
        var w = $('#container').closest(".wrapper").width();
          var h = $('#container').closest(".wrapper").height();
        // setsize will trigger the graph redraw
        chart.setSize(
            w,undefined,false
        );


     });

});
</script>
@endsection
