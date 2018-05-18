{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/backOffice/scanPO/index.css') }}">
@endsection

@section('body')       
    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-md-11 pt-2">

                <form action="" method="POST">

                    {!! csrf_field() !!} 

                    <!-- START panel-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>
                                        <img src="{{asset('images/backOffice/scanPO/icon-heading.png')}}" alt="" />Scan Po
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body ">
                        <form action="{{ route('backOffice.scan-po.store') }}" method="POST" role="form">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-auto">

                                    <div class="panel-body__block">

                                        <fieldset>

                                            <div class="form-group form-group--inline">
                                                <label class="control-label">เลข PO</label>
                                                <input type="text" class="form-control" name="po_number" id="po_number" placeholder="เลข Po" value="{{ old('po_number') }}" required>
                                            </div>
                                        </fieldset>


                                        <fieldset>

                                            <div class="form-group form-group--inline">
                                                <label class="control-label">เลข Tracking</label>
                                                <input type="text" class="form-control" name="ems_number" id="ems_number" placeholder="เลข Tracking" value="{{ old('ems_number') }}" required>
                                            </div>
                                        </fieldset>

                                        <fieldset class="text-center">
                                            <button class="btn btn-primary btn-md" type="submit" name="save">Save</button>
                                        </fieldset>

                                    
                                    </div>

                                </div>
                            </div>
                        </form>
                        </div>

                        {{--  <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-4">
                                    
                                </div>
                            </div>
                        </div>  --}}

                    </div>
                    <!-- END panel-->

                </form>

            </div>

        </div>




    </div>      
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/scanPO/index.js') }}"></script>
    <script>
    $(document).ready(function () {

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        <!-- MESSAGES -->
        @if(session()->has('success'))
        toastr["success"]("{{session()->get('success')}}");
        @elseif(session()->has('error'))
        toastr["error"]("{{session()->get('error')}}");
        @endif

        });

    </script>
@endsection