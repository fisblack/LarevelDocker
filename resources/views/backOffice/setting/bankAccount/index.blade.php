{{-- 
    @author: thananan
    @phone: 085-0385762
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/bankAccount/index.css') }}">
@endsection

@section('body')   

    <div class="container-fluid page-backoffice-bankacc">
        
        <div class="row">
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box-header-white clearfix" style="">
                        <div class="header-left clearfix" style=" ">
                            <figure style="">

                                <img src="{{asset('images/backOffice/bankAcc/bankacc.png')}}" class="w-100" alt="">
                            </figure>
                            <span class="title">
                                Bank Account
                            </span>
                        </div>
                        <div class="header-right clearfix" style=" ">
                            
                            <ul class="nav navbar-top-links navbar-right  ">
                                <li class="m-r-20">
                                    <form action="{{action('BackOffice\Setting\BankAccountController@index')}}" role="search" class="app-search ">
                                        <input name="search" type="text" placeholder="Search..." class="form-control" value="{{ $search ? $search : old('search')}}"> 
                                        <a href="javascript:;">
                                            <button type="submit" class="btn-clear">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </a>
                                    </form>
                                </li>
                                <li class="add" style="">
                                    <a href="{{action('BackOffice\Setting\BankAccountController@create')}}">
                                        <img  src="{{asset('images/backOffice/bankAcc/btn-add.png')}}" alt="Add">
                                    </a>
                                </li>
                                <li class="del">
                                    <a href="javascript:;">                                  
                                        <form id="form_delete_all" action="{{action('BackOffice\Setting\BankAccountController@destroyAll')}}" method="POST">

                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}

                                            <input type="hidden" name="id" value="" />
                                            
                                            <button id="delete_all_button" type="submit" class="btn-clear delete_all_button">
                                            <img src="{{asset('images/backOffice/bankAcc/btn-del.png')}}" alt="Delete">
                                            </button>
                                            
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box-result" style="">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            
                            <tbody>

                                @foreach($banks as $bank)
                                <tr class="{{$bank->trashed() ? 'trashed' : ''}}">
                                    <td class="first" >
                                        <input type="checkbox" name="select" value="{{$bank->id}}" id="bank_{{$bank->id}}">
                                    </td>
                                    <td class="second">
                                        <figure>
                                                
                                            <img src="{{asset($bank->factBankAccount->first()->logo)}}" class="bank-image" alt="">
                                            
                                        </figure>
                                        <ul class="list-unstyled" >
                                            <li>
                                                <strong>ธนาคาร</strong>
                                                <span>: {{$bank->factBankAccount->first()->name}}</span>
                                            </li>
                                            <li>

                                                <strong>ชื่อบัญชี</strong>
                                                <span>: {{$bank->name}}</span>

                                                <span class="space-r-15"></span>
                                                
                                                <strong>สาขา</strong>
                                                <span>: {{$bank->branch}}</span>
                                                
                                                <span class="space-r-15"></span>

                                                <strong>ประเภท</strong>
                                                <span>: {{$bank->account_type}}</span>
                                                
                                            </li>
                                            <li>
                                                <strong>เลขบัญชี</strong>
                                                <span>: {{$bank->account_no}}</span>
                                            </li>
                                        </ul>
                                    </td>
    <td class="three">
        <ul class="list-unstyled">
            @if(!$bank->trashed())
            <li>
                <a href="{{action('BackOffice\Setting\BankAccountController@edit', ['id' => $bank->id])}}">
                    <img style="" src="{{asset('images/backOffice/bankAcc/edit.png')}}" alt="Edit">
                </a>
            </li>
            <li>
                <a href="javascript:;">                                            
                    <form action="{{ route('backOffice.setting.bank-account.destroy', $bank->id) }}" method="post" id="form_soft_delete_{{ $bank->id }}" data-is-trashed="{{ $bank->trashed() ? 'true' : 'false' }}">

                        {!! csrf_field() !!}
                        {!! method_field('delete') !!}

                        <button type="submit" value="Delete" class="btn-clear btn-soft-delete" data-index="{{ $bank->id }}">
                            <img style="" src="{{asset('images/backOffice/bankAcc/bin.png')}}" alt="Delete">
                        </button>

                    </form>
                </a>                                
            </li>
            @else
            <li>
                <form action="{{ action('BackOffice\Setting\BankAccountController@restore', $bank->id) }}" method="post">

                {!! csrf_field() !!}
                {!! method_field('patch') !!}

                <button type="submit" class="btn-clear m-auto">
                    <img width="20" src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Refresh">
                </form>
                
            </li>
            <li>

                <a href="javascript:;">                                            
                    <form action="{{ route('backOffice.setting.bank-account.destroy', ['id' => $bank->id]) }}" method="post" id="form_force_delete_{{ $bank->id }}" data-is-trashed="{{ $bank->trashed() ? 'true' : 'false' }}">

                        {!! csrf_field() !!}
                        {!! method_field('delete') !!}

                        <input type="hidden" name="force" value="true">

                        <button type="submit" value="Delete" class="btn-clear m-auto btn-force-delete" data-index="{{ $bank->id }}">
                            <img width="20" src="{{asset('images/backOffice/bankAcc/bin.png')}}" alt="Delete">
                        </button>

                    </form>
                </a>

            </li>
            @endif
        </ul>
        
    </td>
</tr>
@endforeach
                                                               
                                
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="pagination-detail clearfix">
                        
                        <div class="col-xs-12 col-sm-4 left">
                            <p style="">
                                ทั้งหมด {{$banks->total()}} รายการ
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-8 right">
                            <nav>
                                @if ($banks->total() <= $banks->perPage())
                                    <ul class="pagination">
                                        <li class="disabled"><span>«</span></li>
                                        <li class="active"><span>1</span></li>
                                        <li class="disabled"><span>»</span></li>
                                    </ul>
                                @else
                                    {!! str_replace('/?','?',$banks->render()) !!}
                                @endif
                            </nav>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        
    </div>  
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/setting/bankAccount/index.js') }}"></script>
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