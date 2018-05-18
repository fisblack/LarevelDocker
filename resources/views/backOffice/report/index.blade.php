{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <!-- plugin css -->
    <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
    
    <link rel="stylesheet" href="{{ asset('css/backOffice/report/index.css') }}">
	

@endsection

@section('body')       
	<div class="container-fluid page-backoffice-report ">
                
        <div class="row">
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box-header-white clearfix" style="">
                        <div class="header-left clearfix" style=" ">
                            <figure style="">
                                <!--img src="{{asset('images/backOffice/report/report.png')}}" class="w-100" alt=""-->
                            </figure>
                            <a href="#" class="title">
                                Report
                            </a>
                        </div>
                        
                    </div>
                </div>
                
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box-result" style="">
                    <div class="row">
                        <div class="col-md-7 col-center">
                            <form action="" method="POST" class="form-horizontal form-bankacc clearfix" role="form">
                                 
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        Category
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="" id="input" class="form-control" required="required">
                                            <option value="" selected>
                                                Category
                                            </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        สินค้า
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="" id="input" class="form-control" required="required">
                                            <option value="" selected>
                                                เลือกสินค้า
                                            </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        ลูกค้า
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="" id="input" class="form-control" required="required">
                                            <option value="" selected>
                                                เลือกลูกค้า
                                            </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        เริ่มวันที่
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-5" style="padding:0">
                                            <div class="input-group datetime">
                                                <input type="text" class="form-control " name="" data-toggle="datepicker" id="date-start" placeholder="" value="" required="">
                                                <span class="input-group-addon bg-white">
                                                <img src="{{asset('images/backOffice/report/time.png')}}" alt="">
                                                </span>
                                            </div>    
                                        </div>
                                        <div class="col-sm-2 label-time">
                                            <label class="control-labe" for="">ถึง</label>
                                        </div>
                                        <div class="col-sm-5" style="padding:0">
                                            <div class="input-group datetime">
                                                <input type="text" class="form-control" name="" data-toggle="datepicker" id="date-end" placeholder=""  value="" required="">
                                                <span class="input-group-addon bg-white">
                                                <img src="{{asset('images/backOffice/report/time.png')}}" alt="">
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-save">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                            Excel
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>      
@endsection

@section('script')
	<!-- plugin js -->
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.en-US.js"></script>
    
    <script>
        $(function() {

            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-mm-dd'
            });

        });
    </script>
@endsection