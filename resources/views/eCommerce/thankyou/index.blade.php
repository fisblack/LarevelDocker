@extends('layouts.website.template')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/thank.css')}}"/>

@endsection

@section('body')
<div class="page_thank bg-thank">
  <div class="container ">

    <div class="row">
      <div class="container header-title">
        <figure>
          <img src="{{ asset('images/11_thank/logo-thank.png')}}" alt="">
        </figure>
        <div class="header-title-text">
          Thank You
        </div>
      </div>

      <div class="container thank-detail clearfix">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 logo">
            <figure>

              <img src="{{ asset('images/11_thank/thank-list.png')}}" alt="">
            </figure>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 date-order">
            08-04-2017
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 date-time">
            10:12
          </div>
        </div>

        <div class="row list-detail-item">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class=" list-itme" style="    ">
              <table class="table">
                <tbody>
                  <tr>
                    <td class="title">
                      Signo E-Sport GM-930Blk Draco Gaming Mouse(Black)
                    </td>
                    <td class="qty">
                      1
                    </td>
                    <td class="price">
                      280
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row delivery">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <span class="delivery-text">
              ส่งแบบธรรมดา
            </span>
            <p class="delivery-date">
              วันศุกร์, 11 - วันอังคาร, 15 ส.ค 2017
            </p>
          </div>
        </div>

        <div class="row summary">
          <div class="col-xs-6 col-sm-6 col-md-6 ">
            <span class="total-text">
              มูลค่าสินค้า
            </span>
            <p class="point-text">
              ค่าซื้อขั้นต่ำ    ฟรี
            </p>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 ">
            <span class="total">
              280
            </span>
            <p class="point">
              + 1000 Points
            </p>
          </div>
        </div>
      </div>

      <div class="container back-home">

        <div class="bottom-title-text clearfix">
          <a href="/" class="btn btn-back btn-primary">
            กลับหน้าแรก
          </a>
          <a href="/" class="btn btn-print btn-primary">
            ปริ้น
          </a>
        </div>
      </div>

    </div>

  </div>

</div>
@endsection

@section('script')

@endsection
