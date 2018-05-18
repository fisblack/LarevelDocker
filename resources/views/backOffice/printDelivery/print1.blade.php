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
          <div class="panel-heading">
            <div class="panel-title">
              <figure>
                <img src="{{ asset('images/backOffice/printDelivery/icon-print.png') }}"> Print Delivery
              </figure>
            </div>
          </div>
          <div class="panel-body">
            @for($i=0; $i < ($id == 'all' ? 10 : 1); $i++)
              <div class="row">
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
                        <div><strong>คุณ Benjamin Houston</strong></div>
                        <p>
                          96/187 ซอยคู้บอน 27 แยก 22 <br>
                          ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน <br>
                          กทม 10220
                        </p>
                        <figure>
                          <img src="{{ asset('images/backOffice/printDelivery/barcode.png') }}">
                        </figure>
                        <div class="order"><span>Order: </span> #34345554</div>
                      </div>
                    </div>
                    <div class="panel-footer">
                      <div class="title"><strong>ใบส่งสินค้า</strong></div>

                      <div class="detail-content">
                        <div class="detail-container">
                          <div class="row">
                            <div class="col-sm-2 cover">
                              <figure>
                                <img src="{{ asset('images/backOffice/printDelivery/cover-1.png') }}">
                              </figure>
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
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endfor

            <div class="text-center">
              <button class="btn btn-primary btn-print">Print</button>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
@endsection