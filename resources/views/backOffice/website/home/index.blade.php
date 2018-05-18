{{-- 
    @author: สันติกร สุธาอรรถ
    @phone: 0873569769
    @email: santikorn12@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/home/create.css') }}">
@endsection

@section('body')       
    <div class="container-fluid fit-gap-M">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper-page-backoffice">
                    <div class="sec-head">
                        <img src="{{ asset('images/backOffice/home/icon-home-BOF.png')}}" alt="">
                        <span>Home</span>
                    </div>
                    <div class="wrapper-inside">
                        <form action="{{ route('backOffice.website.home.store') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="group-form-inside">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>หนังสือขายดี</h2>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($data['best_seller'] as $key => $bestSeller)
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-inline flex-form">
                                        <label for="">เล่มที่ {{ $key+1 }}</label>
                                        <select name="home[{{ $bestSeller->id }}]" id="best_seller-{{ $key }}" class="form-control">
                                            <option value="">กรุณาเลือกสินค้า</option>
                                            @foreach($data['data_best_seller'] as $dataBestSeller)
                                            <option value="{{$dataBestSeller->id}}">{{ $dataBestSeller->name }}</option>
                                            @endforeach
                                            @if(!empty($bestSeller->product_id) && !empty($bestSeller->product->id))
                                            <option value="{{$bestSeller->product_id}}" selected="selected">{{ $bestSeller->product->name }}</option>
                                            @endif
                                        </select>
                                        <button type="button" class="btn btn-md btn-primary calculate" data-type="best_seller" data-index="{{ $key }}">คำนวณจากระบบ</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="group-form-inside">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>หนังสือออกใหม่</h2>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($data['new_release'] as $key => $newRelease)
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-inline flex-form">
                                        <label for="">เล่มที่ {{ $key+1 }}</label>
                                        <select name="home[{{ $newRelease->id }}]" id="new_release-{{ $key }}" class="form-control">
                                            <option value="">กรุณาเลือกสินค้า</option>
                                            @foreach($data['data_new_release'] as $dataNewRelease)
                                            <option value="{{$dataNewRelease->id}}">{{ $dataNewRelease->name }}</option>
                                            @endforeach
                                            @if(!empty($newRelease->product_id) && !empty($newRelease->product->id))
                                            <option value="{{$newRelease->product_id}}" selected="selected">{{ $newRelease->product->name }}</option>
                                            @endif
                                        </select>
                                        <button type="button"  class="btn btn-md btn-primary calculate" data-type="new_release" data-index="{{ $key }}">คำนวณจากระบบ</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="group-form-inside">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>หนังสือเร็วๆนี้</h2>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($data['coming_soon'] as $key => $comingSoon)
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-inline flex-form">
                                        <label for="">เล่มที่ {{ $key+1 }}</label>
                                        <select name="home[{{ $comingSoon->id }}]" id="coming_soon-{{ $key }}" class="form-control">
                                            <option value="">กรุณาเลือกสินค้า</option>
                                            @foreach($data['data_coming_soon'] as $dataComingSoon)
                                            <option value="{{$dataComingSoon->id}}">{{ $dataComingSoon->name }}</option>
                                            @endforeach
                                            @if(!empty($comingSoon->product_id) && !empty($comingSoon->product->id))
                                            <option value="{{$comingSoon->product_id}}" selected="selected">{{ $comingSoon->product->name }}</option>
                                            @endif
                                        </select>
                                        <button type="button" class="btn btn-md btn-primary calculate" data-type="coming_soon" data-index="{{ $key }}">คำนวณจากระบบ</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="group-form-inside">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>Official Goods</h2>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($data['official_goods'] as $key => $official)
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-inline flex-form">
                                        <label for="">เล่มที่ {{ $key+1 }}</label>
                                        <select name="home[{{ $official->id }}]" id="official_goods-{{ $key }}" class="form-control">
                                            <option value="">กรุณาเลือกสินค้า</option>
                                            @foreach($data['data_official_goods'] as $dataOfficialGoods)
                                            <option value="{{$dataOfficialGoods->id}}">{{ $dataOfficialGoods->name }}</option>
                                            @endforeach
                                            @if(!empty($official->product_id) && !empty($official->product->id))
                                            <option value="{{$official->product_id}}" selected="selected">{{ $official->product->name }}</option>
                                            @endif
                                        </select>
                                        <button type="button" class="btn btn-md btn-primary calculate" data-type="official_goods" data-index="{{ $key }}">คำนวณจากระบบ</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-md btn-primary btn-gap">Save</button>
                                <button type="reset" id="resetBtn" class="btn btn-md btn-cancel btn-gap">Cancel</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection

@section('script')
    <script>
    $(document).ready(function(){
        $('.calculate').on('click', function(ev){
            const productType = $(this).attr('data-type');
            const formIndex = $(this).attr('data-index');

            $.ajax({
              url: "{{ url('api/product/calculate') }}",
              type: "get",
              data: { 
                type: productType,
              },
              success: function(response) {
                let template = '<option value="">กรุณาเลือกสินค้า</option>';
                if (response.status == 200) {
                    $.each(response.data, function(key, data) {
                        if (key == 0 ) {
                            template = template.concat('<option value="'+ data.id +'" selected="selected">'+ data.name +'</option>')
                        } else {
                            template = template.concat('<option value="'+ data.id +'">'+ data.name +'</option>')
                        }
                    })
                    $('#' + productType + '-' + formIndex).html(template)
                }
              }
            });
        })

        $('#resetBtn').on('click', function(){
            location.reload();
        })

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if(session()->has('success'))
            toastr["success"]("{{ session()->get('success') }}", "Success");
        @elseif(session()->has('failure'))
            toastr["warning"]("{{ session()->get('failure') }}", "Warning");
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]("{{ $error }}", "Error");
            @endforeach
        @endif
    });
    </script>
@endsection