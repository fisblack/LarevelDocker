@extends('layouts.website.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/reportPayment/index.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core_boostrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('body')
    <div id="app" class="container-fluid">
        <div class="container reportPayment">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 ">
                    <h1>แจ้งชำระเงิน</h1>
                    <h2>รายละเอียดการโอนเงิน</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-sm-6 col-md-6 col-lg-6 no-padding-left">
                    <div class="padding gradient radius border fbox fmbox">
                        <div class="box-bank">
                            <ul id="bk-list" class="dropdown-bank in-box-bank" >
                                @php $i=1; @endphp  
                                @foreach($banks as $bank)
                                    <li class="list-bank gradient radius {{$i== $bank->id ? 'selected' : ''}}" index="{{ $bank->id }}" style="font-weight: bold;">
                                        <img style="margin-top: 10px;" src="{{$bank->logo}}" alt="">
                                        <ul class="bank-detail">
                                            <li><span>ธนาคาร</span> {{$bank->name}}</li>
                                            <li><span>ชื่อบัญชี</span>{{$bank->name}}</li>
                                            <li style="display: inline-flex;">
                                                <div style="width: 125px;">
                                                    <span class="">สาขา</span>{{$bank->branch}}
                                                </div>
                                                <div >
                                                    <span class="padding-left">ประเภท</span>{{$bank->account_type}}
                                                </div>                                            
                                            </li>
                                            <li><span>เลขบัญชีธนาคาร</span><div class="bank-number">{{$bank->account_no}}</div></li>
                                        </ul>
                                        <div class="arrow">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                @php $i++; @endphp
                                @endforeach
                            </ul>
                        </div>
                        
                        <form class="form-report-payment"
                              method="post"
                              action="{{ route('report-payment.store') }}"
                              enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <!-- Set ค่า default ให้ Dropdown-->
                            <input id="bank_acc" type="hidden" value="1" name="bank">
        
                            <div class="red">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col1 col-form-label">Order id:</label>
                                    <div class="col2">
                                        <select name="order_id" class="form-control" id="sel1" style="
                                            color:  black;
                                            font-weight:  bold;
                                        ">
                                            @if(isset($orders)) 
                                                @foreach($orders as $order) 
                                                <option value="{{ $order }}">{{ $order }}</option>
                                                @endforeach
                                            @else
                                                <option>ไม่พบรายการสั่งซื้อ</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col3 arrow">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col1 col-form-label">วันที่:</label>
                                    <div class="col2">
                                        <input type="text"
                                                data-date-format="dd/mm/yyyy"
                                                class="form-control datepicker"
                                                name="date_pick"
                                                id="inputEmail3"
                                                placeholder="ระบุวันที่"
                                                style=" color:  black;font-weight:  bold;">
                                    </div>
                                    <div class="col3 calendar">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col1 col-form-label">เวลา:</label>
                                    <div class="col2">
                                        <div class="col-three-1">
                                            <input type="text" class="form-control" id="hour" placeholder="ชั่วโมง" name ="hour" value ="" style=" color:  black;font-weight:  bold;">
                                        </div>
                                        <div class="col-three-2">
                                           :
                                        </div>
                                        <div class="col-three-1">
                                            <input type="text" class="form-control" id="mimute" placeholder="นาที" name="minute" value ="" style=" color:  black;font-weight:  bold;">
                                        </div>
                                    </div>
                                    <div class="col3 ">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col1 col-form-label">จำนวนเงิน</label>
                                    <div class="col2">
                                        <input type="text"
                                               class="form-control"
                                               id="inputEmail3"
                                               placeholder="ระบุจำนวนเงิน"
                                               name="total_amount" 
                                               style=" color:  black; font-weight:  bold;"
                                               >
                                    </div>
                                    <div class="col3">
                                        บาท
                                    </div>
                                </div>
                                
                            </div>
                         
                            <div class="form-group ">
                                <label for="comment" class="black">รายละเอียดเพิ่มเติ่ม</label>
                                <textarea class="form-control radius"
                                        rows="5"
                                        id="comment"
                                        name="desc"
                                        style=" color:  black;font-weight:  bold;"
                                ></textarea>
                            </div>
            
                            <div class="row">
                                <div class="col-xl-3 col-sm-4 col-md-4 col-lg-4 "></div>
                                <div class="col-xl-6 col-sm-4 col-md-4 col-lg-4 btn-padding">
                                    <button onclick="toastr['success']('ทำรายการเสร็จสิ้น');" type="submit" class="btn-red btn-radius" value="Submit">Save</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
    
                    <div class="space show-on-mobile"></div>
                    <div class="col-xl-12 col-sm-6 col-md-6 col-lg-6 no-padding-right">
                        <div class="border-custom">
                            <div class="padding gradient radius border box-payment">
                                <center>
                                    <a class="img-pay btnUpload" id="">
                                        <img id="blah" src="" alt="">
                                    </a>
                                </center>
                                <input id="fileUpload" class="file-upload__input" type="file" name="file_upload">
                                <a class="round-button btnUpload" id=""> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="margin-bottom"></div>
    </div>

@endsection

@section('script')
<script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js') }}"></script>
<script src="{{ asset('js/website/reportPayment/index.js') }}"></script>
<script>


    var _face_bank = {!! json_encode($factbankaccount) !!};
    var _bank = {!! json_encode($banks) !!};
    function readURL(input) {

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileUpload").change(function() {
        console.log('hereer');
        readURL(this);
    });
</script>

@endsection
