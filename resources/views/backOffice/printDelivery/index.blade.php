{{-- 
    @author: MR.SOMPOB MOONSRI (Nick)
    @phone: 0811129499
    @email: eslidiingz@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/printDelivery/index.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
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
            <form action="{{ route('backOffice.print-delivery.show', 1) }}" >
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default panel-form">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-4 col-lg-3 col-lg-offset-1">
                          <div class="form-group">
                            <label for="calendar-addon" class="label-control">วันที่จัดส่งสินค้า</label>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group">
                            <div class="input-group datepicker">
                              <input type="text" class="form-control" placeholder="{{$date_now->format('d/m/Y')}}"
                               aria-describedby="calendar-addon" id="calendar-addon" 
                               name="date" 
                              >
                              <span class="input-group-addon" id="calendar-group-addon">
                                <figure>
                                  <img src="{{ asset('images/backOffice/printDelivery/icon-calendar.png') }}">
                                </figure>
                              </span>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-10 col-sm-offset-1">
                          <div class="form-group">
                            <div class="checkbox">
                              <input type="checkbox" name="check" id="check">
                              รวม Order ค้างส่ง
                              <label for="check">
                              </label>
                            </div>
                          </div>

                          <div class="form-group text-center">
                            <!-- <a href="{{ route('backOffice.print-delivery.show', 1) }}" class="btn btn-primary form-group">พิมพ์</a> -->
                            <button type="submit" class="btn btn-primary form-group">พิมพ์</button>
                            
                            <a href="{{ route('backOffice.print-delivery.show', 'all') }}" class="btn btn-default form-group">พิมพ์ทั้งหมดที่ค้างส่ง</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/backOffice/printDelivery/index.js') }}"></script>
    <script>
    //   $('#calendar-addon').datepicker({
    //     format: 'mm/dd/yyyy',
    // });
    </script>
@endsection