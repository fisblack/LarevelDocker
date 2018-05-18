{{-- 
    @author: MR.SOMPOB MOONSRI (Nick)
    @phone: 0811129499
    @email: eslidiingz@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/pos/create.css') }}">
@endsection

@section('body')       
    <div class="container-fluid">
      <div class="wrapper">
        <div class="panel panel-default panel-container">
          <div class="panel-heading">
            <div class="panel-title">
              <figure>
                <img src="{{ asset('images/backOffice/pos/icon-pos.png') }}"> <span>POS</span> / Add
              </figure>
            </div>
          </div>
          <div class="panel-body">
            <form action="{{ route('backOffice.pos.update', $pos->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default panel-form">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-4 col-lg-3 col-lg-offset-1">
                          <div class="form-group">
                            <label for="calendar-addon" class="label-control">ค้นหา</label>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group @if($errors->has('member_id')) has-error @endif">
                              <span class="form-control">{{ $pos->member->full_name }}</span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-lg-3 col-lg-offset-1">
                          <div class="form-group">
                            <label for="calendar-addon" class="label-control">จำนวนแต้ม</label>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group @if($errors->has('points')) has-error @endif">
                            <input type="text" class="form-control reward" name="points" placeholder="จำนวนแต้ม" value="{{ (old('points')) ? old('points') : $pos->points }}">
                            @if($errors->has('points'))
                              <div class="has-error">
                                <label for="input" class="col-sm-9 control-label">
                                  {{ $errors->first('points') }}
                                </label>
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                        <button class="btn btn-primary">Save</button>
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
    <script>
        $(document).ready(function () {
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