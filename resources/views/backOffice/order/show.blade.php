{{--
    @author: Parada Susuk
    @phone: 0835548554่
    @email: careparadas@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/order/show.css') }}">
      <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
@endsection

@section('body')
<div class="container-back">
  <div class="order">
    <div class="padding">
      <div class="bg shadow radius">
          <div class="header underline">
                <div class="page-name float-left">
                  <div class="icon float-left">
                     <img src="{{ asset('images/backOffice/order/order.png') }}">
                  </div>

                  <div class="text float-left txt">
                    Orders <span>/ OrderID</span>
                  </div>
                </div>


          </div>

<div class="content">
  <div class="row">
    <div class="col-md-12 topic margin">
 <img src="{{ asset('images/backOffice/order/green.png') }}">
  <span> สั่งซื้อของเรียบร้อย</span>

    </div>
  </div>
  <div class="row">
    <div class="col-md-4  ">
      <div class="border box">
        <span>
           คุณ Benjamin Houston
        </span>
      96/187 ซอยคู้บอน 27 แยก 22</br>
      ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน</br>
      กทม 10220
      </div>

    </div>

      <div class="col-md-4  ">
        <div class="border box">
          <span>
             คุณ Benjamin Houston
          </span>
        96/187 ซอยคู้บอน 27 แยก 22</br>
        ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน</br>
        กทม 10220
        </div>

      </div>
        <div class="col-md-4  ">
          <div class="border box">
            <span>
        ที่อยูาในการจัดส่ง
            </span>
          96/187 ซอยคู้บอน 27 แยก 22</br>
          ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน</br>
          กทม 10220
          </div>

        </div>
  </div>
  <div class="row">

    <div class="w100">
      <div class="border">
<div class="top">


      <div class="txt">
        สรุปยอดการสั่งซื้อสำหรับ 34345554 สั่งซื้อสินค้าจำนวน 1 ชิ้น
          </div>
<div class="print">
      <img src="{{ asset('images/backOffice/order/print2.png') }}">
</div>
</div>







<div class="address">
<div class="col-md-5">
<span>คุณ Benjamin Houston</span><br>
44/187 ซอยคู้บอน 27 แยก 22 <br>
ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน<br>
กทม 10220<br>
<span>อีเมล์ยืนยันการสั่งซื้อถูกส่งไปแล้ว</span> ไปที่ phat@gmail.com


</div>
<div class="col-md-7">

</div>
</div>


    <div class="clear">

    </div>
<div class="line"></div>
<div class="book">



    <div class="col-md-6">

      <div class="book-img">
  <img src="{{ asset('images/backOffice/order/book1.png') }}">
      </div>

      <div class="detail">
        <div class="name">
          Space ช่องว่าระหว่างเรา
        </div>
        <div class="count">
            จำนวน 1 เล่ม
        </div>
        <div class="fb">
<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&mobile_iframe=true&width=53&height=20&appId" width="53" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
      </div>
      <div class="clear">

      </div>
    </div>
      <div class="col-md-3">
      <div class="sent">
จัดส่งโดย EMS,
      </div>
      <div class="date">
วันที่ 25 - 27 ส.ค. 2560
      </div>

      </div>
        <div class="col-md-3">
          <div class="print1">
              495 บาท
          </div>
          <div class="print2">
  <strike>1200 บาท</strike>
          </div>
          <div class="print3">
ประหยัด 795 บาท
          </div>
        </div>

        </div>
<div class="line"></div>
    <div class="book black">

    <div class="col-md-5 col-md-offset-7">
      <div class="line1">
        <div class="col-md-6 col-xs-6">
      มูลค่าสินค่า

          </div>
          <div class="col-md-6 col-xs-6 ">
      495 บาท

            </div>
      </div>
      <div class="line2">
        <div class="col-md-6 col-xs-6">
        ค่าธรรทเนียมจัดส่งสินค้า

          </div>
          <div class="col-md-6 col-xs-6">
        จัดส่งทั่วประเทศฟรี

            </div>
      </div>
      <div class="line3">
        <div class="col-md-6 col-xs-6">
      รวมสุทธิ (รวมภาษี)

          </div>
          <div class="col-md-6 col-xs-6 red">
        498 บาท

            </div>
      </div>
      <div class="line4">
        <div class="col-md-6 col-xs-6">
        จ่ายโดย......

          </div>
          <div class="col-md-6 col-xs-6">


            </div>
      </div>
</div>
</div>


  </div>



</div>





</div>



      </div>
    </div>

    </div>

  </div>


</div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/order/show.js') }}"></script>
@endsection
