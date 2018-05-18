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
                        <img src="{{ asset('images/backOffice/general/icon-general-BOF.png')}}" alt="">
                        <span>General</span>
                    </div>
                    <form action="" method="" id="" class="">
                        <div class="wrapper-inside">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Maintenance</h2>
                                            <div class="wrap-switch">
                                                <a href="javascript:;" class="btn-switch"></a>
                                                <span>Maintenance</span>
                                            </div>
                                            <div class="browse-img gap-inline-form">
                                                <label>Image</label>
                                                <div class="group-browse-file">
                                                    <a href="javascript:;" class="btn-browse">main.png</a>
                                                    <input type="file" name="" value="" placeholder="" class="hidden">
                                                </div>
                                                <div class="show-img">
                                                    <span>My Image:</span>
                                                    <img src="{{ asset('images/backOffice/general/test-upload-img.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="wrap-remark gap-inline-form">
                                                <label>สาเหตุ</label>
                                                <textarea name="" id="" cols="30" rows="4" placeholder="สาเหตุเพราะ..." class=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Closed Shop</h2>
                                            <div class="wrap-switch">
                                                <a href="javascript:;" class="btn-switch"></a>
                                                <span>Closed Shop</span>
                                            </div>
                                            <div class="browse-img gap-inline-form">
                                                <label>Logo</label>
                                                <div class="group-browse-file">
                                                    <a href="javascript:;" class="btn-browse">logo.png</a>
                                                    <input type="file" name="" value="" placeholder="" class="hidden">
                                                </div>
                                                <div class="show-img">
                                                    <span>My Image:</span>
                                                    <img src="{{ asset('images/backOffice/general/test-upload-img-2.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    <div class="wrapper-inside">
                        <form action="" method="" id="" class="">
                            <div class="group-form-inside no-border">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="line-section">Footer</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="browse-img gap-inline-form">
                                                    <label>วิธีการสั่ง</label>
                                                    <div class="group-browse-file">
                                                        <a href="javascript:;" class="btn-browse">Howto.png</a>
                                                        <input type="file" name="" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <img src="{{ asset('images/backOffice/general/test-upload-img-3.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="browse-img gap-inline-form">
                                                    <label>ชำระเงิน</label>
                                                    <div class="group-browse-file">
                                                        <a href="javascript:;" class="btn-browse">payment.png</a>
                                                        <input type="file" name="" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <img src="{{ asset('images/backOffice/general/test-upload-img-4.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="browse-img gap-inline-form">
                                                    <label>วิธีการส่ง</label>
                                                    <div class="group-browse-file">
                                                        <a href="javascript:;" class="btn-browse">sending.png</a>
                                                        <input type="file" name="" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <img src="{{ asset('images/backOffice/general/test-upload-img-5.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="browse-img gap-inline-form">
                                                    <label>สะสม</label>
                                                    <div class="group-browse-file">
                                                        <a href="javascript:;" class="btn-browse"></a>
                                                        <input type="file" name="" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <img src="{{ asset('images/backOffice/general/test-upload-img-6.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="browse-img gap-inline-form">
                                                    <label>วิธีคืนสินค้า</label>
                                                    <div class="group-browse-file">
                                                        <a href="javascript:;" class="btn-browse">product.png</a>
                                                        <input type="file" name="" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <img src="{{ asset('images/backOffice/general/test-upload-img-7.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <button type="" class="btn btn-md btn-primary btn-gap">Save</button>
                                    <button type="" class="btn btn-md btn-cancel btn-gap">Cancel</button>
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
    <!-- <script src="{{ asset('js/backOffice/project_name/create.js') }}"></script> -->
    <script>
        $(document).ready(function(){
            $('a.btn-switch').on('click',function(){
                $(this).toggleClass('active');
            });
            $('a.btn-browse').on('click',function(){
                $(this).parent('.group-browse-file').find('input[type="file"]').trigger('click');
            });

            

            

        });
    </script>
@endsection