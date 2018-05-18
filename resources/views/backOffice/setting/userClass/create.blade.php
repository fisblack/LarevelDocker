{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/userClass/create.css') }}">

    <!-- plugin -->
    <link rel="stylesheet" href="{{ asset('js/plugins/jquery-asColorPicker/dist/css/asColorPicker.css') }}">
@endsection

@section('body')       
	<div class="container-fluid page-backoffice-userclass-create">
	                
	    <div class="row">
	        
	            <div class="col-xs-12 col-sm-12 col-md-12">
	                <div class="box-header-white clearfix" style="">
	                    <div class="header-left clearfix" style=" ">
	                        <figure style="">
	                            <img src="{{asset('images/backOffice/userclass/userclass.png')}}" class="w-100" alt="">
	                        </figure>
	                        <a href="{{action('BackOffice\Setting\UserClassController@index')}}" class="title">
	                            User Class
	                        </a>
	                        <a class="title active">
	                            / Create
	                        </a>
	                    </div>
	                    
	                </div>
	            </div>
	            
	    </div>

	    <div class="row">
	        <div class="col-xs-12 col-sm-12">
	            <div class="box-result" style="">
	                <div class="row">
	                    <div class="col-md-6 col-center">
							<form action="{{ route('backOffice.setting.user-class.store') }}" 
							method="POST" class="form-horizontal form-userclass clearfix" role="form"
							id="formUserClass">
								{!! csrf_field() !!}
	                            <!--div class="form-group">
	                                <div class="col-sm-12 text-center">
	                                    <div class="btn-group" data-toggle="buttons">
	                                      <label class="btn btn-class silver">
	                                        <input type="radio" name="options" id="option1">
	                                        Silver
	                                      </label>
	                                      <label class="btn btn-class gold">
	                                        <input type="radio" name="options" id="option2">
	                                        Gold
	                                      </label>
	                                      <label class="btn btn-class platinum">
	                                        <input type="radio" name="options" id="option3">
	                                        Platinum
	                                      </label>
	                                </div>
	                                    
	                                </div>
	                            </div-->
	                            <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 ">
                                        <span class="show-msg">
                                            รูปภาพใช้แสดงสัญลักษณ์ Class
                                        </span>
                                    </div>
                                </div>
	                            <div class="form-group">
	                                <label for="input" class="col-sm-3 control-label">
	                                    ชื่อ Class (TH)
	                                </label>
	                                <div class="col-sm-9">
										<input type="text" name="name_th" placeholder="ชื่อ Class"
										value = "{{$request->old('name_th')}}"
										id="input" class="form-control"  required="required">
	                                </div>
								</div>
	                            <div class="form-group">
	                                <label for="input" class="col-sm-3 control-label">
	                                    ชื่อ Class (EN)
	                                </label>
	                                <div class="col-sm-9">
										<input type="text" name="name_en" id="input" 
										value = "{{$request->old('name_en')}}"
										class="form-control"  required="required" placeholder="Class Name">
	                                </div>
	                            </div>
	                            <div class="form-group">  
                                    <label for="input" class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-9">
										<input type="text" name='color' 
										value = "@if(empty($request->old('color'))) #fa7a7a @else {{$request->old('color')}} @endif" 
										class="complex-colorpicker form-control asColorPicker-input" >
                                        <a href="#" class="asColorPicker-clear"></a>
                                    </div>
                                </div>
								<div class="@if ($errors->has('discount')){{'form-group has-error'}}@else{{'form-group'}}@endif">
                                    <label for="input" class="col-sm-3 control-label">ส่วนลด</label>
									<div class="col-sm-6">
										<input type="text" name="discount" 
										value = "{{$request->old('discount')}}"
										id="input" 
										
										class="form-control"  required="required" placeholder="Discount">
                                    </div>
                                    <div class="col-sm-3">
                                        <select value = "{{$request->old('discount_type')}}" name="discount_type" class="form-control">
                                            <option value="Bath" selected >บาท</option>
                                            <option value="%">%</option>
                                        </select>
									</div>
									@if ($errors->has('discount'))
										<div class="has-error">
											<label for="input" class="col-sm-9 col-sm-offset-3 control-label">
											@foreach ($errors->get('discount') as $message)
												{{$message}}
											@endforeach
											</label>
										</div>
									@endif
								</div>
								
	                            <div class="@if ($errors->has('minimum_purchase')){{'form-group has-error'}}@else{{'form-group'}}@endif">
	                                <label for="input" class="col-sm-6 control-label">
	                                    ยอดซื้อขั้นต่ำต่อปีเพื่อคงสถานะ
	                                </label>
	                                <div class="col-xs-11 col-sm-3">
										<input type="text" name="minimum_purchase" 
										value = "{{$request->old('minimum_purchase')}}"
										id="input" class="form-control"  required="required" placeholder="">
	                                </div>
									<label for="" class="col-xs-1 control-label">บาท</label>
									@if ($errors->has('minimum_purchase'))
										<div class="has-error">
											<label for="input" class="col-sm-6 col-sm-offset-6 control-label">
											@foreach ($errors->get('minimum_purchase') as $message)
												{{$message}}
											@endforeach
											</label>
										</div>
									@endif
								</div>
								
								

	                            
	                            
	                            <div class="form-group">
	                                <div class="col-sm-12 text-center">
	                                    <button type="submit" id="btnUserClass" class="btn btn-save">save</button>
	                                    
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


    <script src="{{ asset('js/plugins/jquery-asColorPicker/dist/jquery-asColor.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-asColorPicker/dist/jquery-asGradient.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-asColorPicker/dist/jquery-asColorPicker.js') }}"></script>

    <script>
	    $(".complex-colorpicker").asColorPicker({
	        mode: 'complex'
	    });
		// btnUserClass.
		
    </script>
@endsection