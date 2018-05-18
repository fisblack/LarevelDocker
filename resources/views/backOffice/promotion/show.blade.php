{{-- 
    @author: Chanikarn Thavornwong
    @phone: 0909737246
    @email: ploid.t@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/promotion/show.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit:100,300,400" rel="stylesheet">
@endsection

@section('body')       
    <div class="container-fluid">
    	<div class="promotion-wrapper">
            <div class="shadow">
                <div class="header underline">
                    <div class="page-name-wrapper verticle-middle-wrapper">
                        <div class="vm-div heading">
                            <figure>
                                <img src="{{ asset('images/backOffice/promotion/header-icon-promotion.png') }}" > 
                                <div class="page-name">
                                    Promotion/ ConditionGroup / Show
                                </div>

                            </figure>
                        </div>
                    </div>
                    <div class="btn-action verticle-middle-wrapper">
                        <div class="vm-div">
                            <a href="#"> <img src="{{ asset('images/backOffice/promotion/header-delete.png') }}"></a>
                        </div>
                    </div>

                    <div class="btn-action verticle-middle-wrapper">
                        <div class="vm-div">
                          <a href="/create">  <img src="{{ asset('images/backOffice/promotion/header-add.png') }}"></a>
                        </div>
                    </div>
                    <div class="search-wrapper verticle-middle-wrapper">
                      <div class="input-group vm-div">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-btn">
                          <button class="btn btn-default" type="submit">
                                  <img src="{{ asset('images/backOffice/promotion/header-icon-search.png') }}">
                          </button>
                        </div>
                      </div>

                    </div>
                </div>
                <div class="content">
                	<div class="promo-info-head">
                		<div class="row">
                			<div class="col-xs-12 col-sm-4 info">
	                			<p class="text-red">ชื่อ Promotion :</p>
	                			<span class="text">Lorem ipsum</span>
	                		</div>
	                		<div class="col-xs-12 col-sm-4 info">
	                			<p class="text-red">ชื่อ ConditionGroup :</p>
	                			<span class="text">Lorem ipsum</span>
	                		</div>
	                		<div class="col-xs-12 col-sm-4 info">
	                			<p class="text-red">ประเภท :</p>
	                			<span class="text-bold">OR</span>
	                		</div>
                		</div>
                		
                	</div>

                	<div class="promotion-list">
                        <div class="promotion-info row">
                            <div class="col-xs-2 col-sm-1 promotion-checkbox verticle-middle-wrapper">
                                <div class="vm-div">
                                    <input type="checkbox" name="promotionCheckbox" class="vm-element checkbox">
                                </div>
                                
                            </div>
                            <div class="col-xs-10 col-sm-9 col-md-10 detail verticle-middle-wrapper">
                                <div class="vm-div">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p><span class="heading">จำนวนครั้งซื้อ</span> = 1</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xs-12 col-sm-1 setting verticle-middle-wrapper">
                                <div class="vm-div">
                                    <div class="vm-element">
                                        <div class="icon-wrapper">
                                            <img src="{{ asset('images/backOffice/promotion/content-edit.png') }}" alt="edit icon">
                                        </div>
                                        <div class="icon-wrapper">
                                            <img src="{{ asset('images/backOffice/promotion/content-delete.png') }}" alt="delete icon">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <!-- end promotion-info div -->

                        <div class="promotion-info row">
                            <div class="col-xs-2 col-sm-1 promotion-checkbox verticle-middle-wrapper">
                                <div class="vm-div">
                                    <input type="checkbox" name="promotionCheckbox" class="vm-element checkbox">
                                </div>
                                
                            </div>
                            <div class="col-xs-10 col-sm-9 col-md-10 detail verticle-middle-wrapper">
                                <div class="vm-div">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p><span class="heading">ราคารวมก่อนภาษี</span> > 500</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xs-12 col-sm-1 setting verticle-middle-wrapper">
                                <div class="vm-div">
                                    <div class="vm-element">
                                        <div class="icon-wrapper">
                                            <img src="{{ asset('images/backOffice/promotion/content-edit.png') }}" alt="edit icon">
                                        </div>
                                        <div class="icon-wrapper">
                                            <img src="{{ asset('images/backOffice/promotion/content-delete.png') }}" alt="delete icon">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <!-- end promotion-info div -->
                    </div>
                </div>

                <div class="bottom">
                    <div class="summary">
                        ทั้งหมด 3 รายการ
                    </div>
                    <div class="pages">
                        <div class="box verticle-middle-wrapper active">
                            <div class="vm-div">1</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">2</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">3</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">4</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">5</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">...</div>
                        </div>
                        <div class="box verticle-middle-wrapper">
                            <div class="vm-div">10</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>      
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/promotion/show.js') }}"></script>
@endsection