{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/bankAccount/create.css') }}">
@endsection

@section('body')       
	<div class="container-fluid page-backoffice-bankacc-create">
                
        <div class="row">
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box-header-white clearfix">
                        <div class="header-left clearfix" style=" ">
                            <figure>
                                <img src="{{asset('images/backOffice/bankAcc/bankacc.png')}}" class="w-100" alt="">
                            </figure>
                            <a href="{{action('BackOffice\Setting\BankAccountController@index')}}" class="title">
                                Bank Account 
                            </a>
                            <a class="title active">
                                / Edit
                            </a>
                        </div>
                        
                    </div>
                </div>
                
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box-result">
                    <div class="row">
                        <div class="col-md-6 col-center">

                            <form action="{{ route('backOffice.setting.bank-account.update', $bank->id) }}" method="POST" class="form-horizontal form-bankacc clearfix" role="form" enctype="multipart/form-data">
                                
                                {!! csrf_field() !!}
                                {!! method_field('patch') !!}

                                <input type="hidden" class="other-bank" name="other_bank" value="0" />

                                <div class="old-bank form-group">

                                    <label for="input" class="col-sm-3 control-label">
                                        ชื่อธนาคาร
                                    </label>

                                    <div class="col-sm-9">
                                        
                                        <select name="bank_id" class="form-control" id="bankacc">
                                            
                                            @foreach($fact_banks as $fact_bank)
                                            <option value="{{$fact_bank->id}}" data-imagesrc="{{asset($fact_bank->logo)}}" data-description="{{$fact_bank->name}}" {{$fact_bank->id == $bank->bank_id ? 'selected' : ''}}></option>
                                            @endforeach

                                            <option value="other_bank" data-description="ธนาคารอื่น"></option>
             
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="new-bank hidden">
                                    <div class="form-group">
                                        <label for="bank_logo_plus" class="col-sm-3 control-label">
                                                ใส่โลโก้ธนาคาร
                                        </label>

                                        <div class="col-sm-9">
                                            
                                            <div class="input-file">
                                                <a href="#bank-logo">
                                                    <img class="img-responsive hidden"  src="" alt="" />
                                                </a>
                                                <input type="file" name="bank_logo" id="bank-logo" class="form-control" />
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bank_name_plus" class="col-sm-3 control-label">
                                            กรอกชื่อธนาคาร
                                        </label>

                                        <div class="col-sm-9">
                                            
                                            <input type="text" class="form-control" id="bank_name_plus" name="bank_name" placeholder="กรอกชื่อธนาคาร" value="{{ old('bank_name') }}">
                                            
                                        </div>
                                    </div>


                                </div>
                                
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        ประเภทบัญชี
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="account_type" class="form-control" required="required">
                                            <option value="">เลือกประเภทบัญชี</option>

                                            @foreach($accounts as $type)
                                            <option value="{{ $type }}" @if( old('account_type', $bank->account_type) === $type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        ชื่อบัญชีธนาคาร
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="ชื่อบัญชีธนาคาร" class="form-control"  required="required" value="{{$bank->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        เลขบัญชีธนาคาร
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="account_no" placeholder="เลขบัญชีธนาคาร" class="form-control"  required="required" value="{{$bank->account_no}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        สาขา
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="branch" class="form-control"  required="required" placeholder="สาขา" value="{{$bank->branch}}">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-save">save</button>
                                        <a href="{{action('BackOffice\Setting\BankAccountController@index')}}" class="btn btn-cancel">cancel</a>
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
    
    <script src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
    <script src="{{ asset('js/backOffice/setting/bankAccount/show.js') }}"></script>
    <script>
        $(function() {
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
                {{session()->forget('success')}}
            @elseif(session()->has('warning'))
                toastr["warning"]("{{ session()->get('warning') }}", "Warning");
                {{session()->forget('warning')}}
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr["error"]("{{ $error }}", "Error");
                @endforeach
            @endif
    
        });
    </script>

@endsection