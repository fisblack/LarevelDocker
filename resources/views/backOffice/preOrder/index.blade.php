@extends('layouts.backOffice.template')
@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/order/index.css') }}">
@endsection
@section('body')
    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-md-11 pt-2">

                <!-- START panel-->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading--action">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>
                                    <img src="{{asset('images/backOffice/preOrder/icon-heading.png')}}" alt="" />Pre Order
                                </h4>

                                <div class="panel-heading__delete">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('images/backOffice/preOrder/icon-delete-lg.png')}}" alt="Delete" /></a>
                                </div>
                                <div class="panel-heading__add">
                                    <a href="{{ route('backOffice.pre-order.create') }}">
                                        <img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="Add" /></a>
                                </div>
                                <div class="panel-heading__search">
                                    <form action="{{ route('backOffice.pre-order.index') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Search..." @if(isset($_GET['search'])) value="{{$_GET['search']}}"@endif>
                                            <div class="input-group-addon">
                                                <button class="btn btn-default" type="submit">
                                                    <img src="{{asset('images/backOffice/preOrder/icon-search.png')}}" alt="" />
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-12">

                                <div class="records table-responsive">
                                    @foreach($pre_orders as $order)
                                        @include('backOffice.preOrder._partial.detail_order')
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <p class="total">
                                    ทั้งหมด {{ $pre_orders->total() }} รายการ
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-8 text-right">
                                {{--<nav>
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&lt;</span></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">10</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&gt;</span>
                                            </a>
                                        </li>

                                    </ul>
                                </nav>--}}
                                @if(request()->get('search'))
                                    {{ $pre_orders->appends(['search' => request()->get('search')])->links('paginations.sensebook') }}
                                @else
                                    {{ $pre_orders->links('paginations.sensebook') }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END panel-->

            </div>

        </div>




    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/preOrder/index.js') }}"></script>
    <script type="text/javascript">
        $(function () {
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
            };

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
