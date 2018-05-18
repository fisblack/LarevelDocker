{{--
    @author: สันติกร สุธาอรรถ
    @phone: 0873569769
    @email: santikorn12@gmail.com
--}}


@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/home/create.css') }}">
    <style>
    .browse-img .group-browse-file a{
        white-space: nowrap;
        width: 0em;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .show-img img{
        width: 168px;
        height: 124px;
    }

    </style>
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
                    <form action="{{ route('backOffice.website.general.store') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" id="id" name="id" value="{{ $request->old('id',$General->id) }}" >
                        <div class="wrapper-inside">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Maintenance</h2>
                                            <div class="wrap-switch">
                                                <a href="javascript:;" data-target="is_maintenance" class="btn-switch"></a>
                                                <input type="checkbox" id="is_maintenance" name="is_maintenance" class="hidden"
                                                @if($request->old('is_maintenance',$General->is_maintenance)=='1') checked @endif
                                                 >
                                                <span>Maintenance</span>
                                            </div>
                                            <div class="browse-img gap-inline-form">
                                                <label>Image</label>
                                                <div class="group-browse-file">
                                                    <a id="text_maintenance" href="javascript:;" class="btn-browse">
                                                    <?php
                                                    $name_image = $request->old('maintenance_image',$General->maintenance_image);
                                                    $name_image = explode("/", $name_image);
                                                    if(count($name_image)>1){
                                                        $name_image = $name_image[count($name_image)-1];
                                                    }else{
                                                        $name_image = 'main.png';
                                                    }
                                                    $maintenance_name = $name_image;
                                                    ?>
                                                    {{ $maintenance_name }}
                                                   </a>
                                                    <input id="btn_maintenance" data-target="maintenance" accept="image/jpeg, image/png" type="file" name="maintenance_image" value="" placeholder="" class="hidden">
                                                </div>
                                                <div class="show-img">
                                                    <span>My Image:</span>
                                                    <?php
                                                        if(!empty($request->old('maintenance_image',$General->maintenance_image))  &&file_exists( storage_path($request->old('maintenance_image',$General->maintenance_image) ) )){
                                                            $maintenance_image = getImage($request->old('maintenance_image',$General->maintenance_image));
                                                        }else{
                                                            // asset('images/backOffice/general/test-upload-img.png')
                                                           $maintenance_image = getImage('images/backOffice/general/test-upload-img.png');
                                                        }
                                                        // $maintenance_image = '';
                                                    ?>
                                                    <img id="img_maintenance"
                                                    src="{{$maintenance_image}}"
                                                    alt="">
                                                </div>
                                            </div>
                                            <div class="wrap-remark gap-inline-form">
                                                <label>สาเหตุ</label>
                                                <textarea name="maintenanace_cause" id="" cols="30" rows="4" placeholder="สาเหตุเพราะ..." class="" >{{ $request->old('maintenanace_cause',$General->maintenanace_cause) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Closed Shop</h2>
                                            <div class="wrap-switch">
                                                <a href="javascript:;" data-target="is_close" class="btn-switch"></a>
                                                <input type="checkbox" id="is_close" name="is_close" class="hidden"
                                                @if($request->old('is_close',$General->is_close)=='1') checked @endif >
                                                <span>Closed Shop</span>
                                            </div>
                                            <div class="browse-img gap-inline-form">
                                                <label>Logo</label>
                                                <div class="group-browse-file">
                                                    <a id="text_logo" href="javascript:;" class="btn-browse">
                                                    <?php
                                                    $name_image = $request->old('close_image',$General->close_image);
                                                    $name_image = explode("/", $name_image);
                                                    if(count($name_image)>1){
                                                        $close_name = $name_image[count($name_image)-1];
                                                    }else{
                                                        $close_name = 'logo.png';
                                                    }
                                                    ?>
                                                    {{ $close_name }}
                                                    </a>
                                                    <input id="btn_logo" data-target="logo" accept="image/jpeg, image/png" type="file" name="close_image" value="" placeholder="" class="hidden">
                                                </div>
                                                <div class="show-img">
                                                    <span>My Image:</span>
                                                    <?php
                                                        $name_name = 'close_image';
                                                        if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                            $close_image = getImage($request->old($name_name,$General->$name_name));
                                                        }else{
                                                            // asset('images/backOffice/general/test-upload-img.png')
                                                           $close_image = getImage('images/backOffice/general/test-upload-img-2.png');
                                                        }
                                                        // $maintenance_image = '';
                                                    ?>
                                                    <img id="img_logo"
                                                    src="{{$close_image}}"
                                                    alt="">
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
                                                        <a id="text_howto" href="javascript:;" class="btn-browse">
                                                        <?php
                                                        $name_image = $request->old('order_image',$General->order_image);
                                                        $name_image = explode("/", $name_image);
                                                        if(count($name_image)>1){
                                                            $order_name = $name_image[count($name_image)-1];
                                                        }else{
                                                            $order_name = 'Howto.png';
                                                        }
                                                        ?>
                                                        {{ $order_name }}
                                                        </a>
                                                        <input id="btn_howto" data-target="howto" accept="image/jpeg, image/png" type="file" name="order_image" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <?php
                                                            $name_name = 'order_image';
                                                            if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                                $order_image = getImage($request->old($name_name,$General->$name_name));
                                                            }else{
                                                            $order_image = getImage('images/backOffice/general/test-upload-img-3.png');
                                                            }
                                                        ?>
                                                        <img id="img_howto"
                                                        src="{{$order_image}}"
                                                        alt="">
                                                        <!-- <img id="img_howto" src="{{ asset('images/backOffice/general/test-upload-img-3.png')}}" alt=""> -->
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
                                                        <a id="text_payment" href="javascript:;" class="btn-browse">
                                                        <?php
                                                        $name_image = $request->old('payment_image',$General->payment_image);
                                                        $name_image = explode("/", $name_image);
                                                        if(count($name_image)>1){
                                                            $payment_name = $name_image[count($name_image)-1];
                                                        }else{
                                                            $payment_name = 'payment.png';
                                                        }
                                                        ?>
                                                        {{ $payment_name }}
                                                        </a>
                                                        <input id="btn_payment" data-target="payment" accept="image/jpeg, image/png" type="file" name="payment_image" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <?php
                                                            $name_name = 'payment_image';
                                                            if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                                $payment_image = getImage($request->old($name_name,$General->$name_name));
                                                            }else{
                                                            $payment_image = getImage('images/backOffice/general/test-upload-img-4.png');
                                                            }
                                                        ?>
                                                        <img id="img_payment"
                                                        src="{{$payment_image}}"
                                                        alt="">
                                                        <!-- <img id="img_payment" src="{{ asset('images/backOffice/general/test-upload-img-4.png')}}" alt=""> -->
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
                                                        <a id="text_sending" href="javascript:;" class="btn-browse">
                                                        <?php
                                                        $name_image = $request->old('shipment_image',$General->shipment_image);
                                                        $name_image = explode("/", $name_image);
                                                        if(count($name_image)>1){
                                                            $shipment_name = $name_image[count($name_image)-1];
                                                        }else{
                                                            $shipment_name = 'sending.png';
                                                        }
                                                        ?>
                                                        {{ $shipment_name }}

                                                        </a>
                                                        <input id="btn_sending" data-target="sending" accept="image/jpeg, image/png" type="file" name="shipment_image" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <?php
                                                            $name_name = 'shipment_image';
                                                            if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                                $shipment_image = getImage($request->old($name_name,$General->$name_name) );
                                                            }else{
                                                            $shipment_image = getImage('images/backOffice/general/test-upload-img-5.png');
                                                            }
                                                        ?>
                                                        <img id="img_sending"
                                                        src="{{$shipment_image}}"
                                                        alt="">
                                                        <!-- <img id="img_sending" src="{{ asset('images/backOffice/general/test-upload-img-5.png')}}" alt=""> -->
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
                                                        <a id="text_point" href="javascript:;" class="btn-browse">
                                                        <?php
                                                        $name_image = $request->old('point_image',$General->point_image);
                                                        $name_image = explode("/", $name_image);
                                                        if(count($name_image)>1){
                                                            $point_name = $name_image[count($name_image)-1];
                                                        }else{
                                                            $point_name = '';
                                                        }
                                                        ?>
                                                        {{ $point_name }}
                                                        </a>
                                                        <input id="btn_point" data-target="point" accept="image/jpeg, image/png" type="file" name="point_image" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <?php
                                                            $name_name = 'point_image';
                                                            if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                                $point_image = getImage($request->old($name_name,$General->$name_name));
                                                            }else{
                                                                $point_image = getImage('images/backOffice/general/test-upload-img-6.png');
                                                            }
                                                        ?>
                                                        <img id="img_point"
                                                        src="{{$point_image}}"
                                                        alt="">
                                                        <!-- <img id="img_point" src="{{ asset('images/backOffice/general/test-upload-img-6.png')}}" alt=""> -->
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
                                                        <a id="text_return" href="javascript:;" class="btn-browse">

                                                        <?php
                                                        $name_image = $request->old('return_image',$General->return_image);
                                                        $name_image = explode("/", $name_image);
                                                        if(count($name_image)>1){
                                                            $return_name = $name_image[count($name_image)-1];
                                                        }else{
                                                            $return_name = 'product.png';
                                                        }
                                                        ?>
                                                        {{ $return_name }}
                                                        </a>
                                                        <input id="btn_return" data-target="return" accept="image/jpeg, image/png" type="file" name="return_image" value="" placeholder="" class="hidden">
                                                    </div>
                                                    <div class="show-img">
                                                        <span>My Image:</span>
                                                        <?php
                                                            $name_name = 'return_image';
                                                            if(!empty($request->old($name_name,$General->$name_name))  &&file_exists( storage_path($request->old($name_name,$General->$name_name) ) )){
                                                                $return_image = getImage($request->old($name_name,$General->$name_name));
                                                            }else{
                                                            $return_image = getImage('images/backOffice/general/test-upload-img-7.png');
                                                            }
                                                        ?>
                                                        <img id="img_return"
                                                        src="{{$return_image}}"
                                                        alt="">
                                                        <!-- <img id="img_return" src="{{ asset('images/backOffice/general/test-upload-img-7.png')}}" alt=""> -->
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
        var url ="{{ url()->to('/') }}"
        var maintenance_image = '{{ $maintenance_image }}'
        var maintenance_name = '{{ $maintenance_name }}'
        var close_image = '{{ $close_image }}'
        var close_name = '{{ $close_name }}'
        var order_image = '{{ $order_image }}'
        var order_name = '{{ $order_name }}'
        var shipment_image = '{{ $shipment_image }}'
        var shipment_name = '{{ $shipment_name }}'

        var return_image = '{{ $return_image }}'
        var return_name = '{{ $return_name }}'
        var payment_image = '{{ $payment_image }}'
        var payment_name = '{{ $payment_name }}'
        var point_image = '{{ $point_image }}'
        var point_name = '{{ $point_name }}'
        // torstor
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
            var error = ""
            @if(session()->has('success'))
                toastr["success"]("{{ session()->get('success') }}", "Success");
            @elseif(session()->has('error'))
                error = "{{ session()->get('error') }}";
                toastr["error"](error, "Error");
            @endif
        $(document).ready(function(){
            // if($("#is_maintenance").is(':checked')){
            //     $("#is_maintenance").toggleClass('active')
            // }
            
                    

            $('a.btn-switch').each(function() {
                let target = $(this).data('target')
                // console.log($("#"+target).is(':checked'),target)
                if($("#"+target).is(':checked')){
                    // $("#"+target).toggleClass('active');
                    $(this).toggleClass('active');
                }

            })

            $('a.btn-switch').on('click',function(){
                let target = $(this).data('target')


                $(this).toggleClass('active');
                if($(this).hasClass('active')){
                    $("#"+target).prop('checked', true);
                    $('a.btn-switch').each(function() {
                        let target1 = $(this).data('target')
                        if(target!=target1){

                            if($(this).hasClass('active')){
                                $(this).toggleClass('active');
                                $("#"+target1).prop('checked', false);
                            }
                        }
                        console.log(target,target1)
                    })
                }else{
                    $("#"+target).prop('checked', false);
                }

            });
            $('a.btn-browse').on('click',function(){
                $(this).parent('.group-browse-file').find('input[type="file"]').trigger('click');
            });

            $('[type=file]').change((e)=>upload_image(e));


            function upload_image(e){
                const file = e.target.files[0];
                const reader = new FileReader();
                const name_input = $(e.target).data('target');
                // const img = $('<img class="show-image">');
                console.log(file,name_input);
                if (file) {
                    $('#text_'+name_input).text(file.name);
                    reader.onload = function(e) {
                    // console.log(e.target.result)
                    $('#img_'+name_input).attr('src', e.target.result);
                    // img.attr('src', e.target.result);
                    // img.appendTo($(targetId));
                    }
                    reader.readAsDataURL(file);
                }else{

                    // console.log("false",url)
                    if(name_input==='logo'){
                        $('#text_'+name_input).text(close_name);
                        $('#img_'+name_input).attr('src', close_image);
                    }else if(name_input==='howto'){
                        $('#text_'+name_input).text(order_name);
                        $('#img_'+name_input).attr('src', order_image);
                    }
                    else if(name_input==='payment'){
                        $('#text_'+name_input).text(payment_name);
                        $('#img_'+name_input).attr('src', payment_image);
                    }
                    else if(name_input==='sending'){
                        $('#text_'+name_input).text(shipment_name);
                        $('#img_'+name_input).attr('src', shipment_image);
                    }
                    else if(name_input==='point'){
                        $('#text_'+name_input).text(point_name);
                        $('#img_'+name_input).attr('src', point_image);
                    }
                    else if(name_input==='return'){
                        $('#text_'+name_input).text(return_name);
                        $('#img_'+name_input).attr('src', return_image);
                    }
                    else{
                        $('#text_'+name_input).text(maintenance_name);
                        $('#img_'+name_input).attr('src',maintenance_image);
                    }
                }
            }

        });
    </script>
@endsection
