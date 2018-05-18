{{--
    @author: Phitchaporn Pipatpunlop
    @phone: 0909915818
    @email: phitchaporn.pipa@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/promotion/create.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit:100,300,400" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endsection

@section('body')
    <div class="container-fluid backoffice-promotion-create">
      <div class="pop-up">
        <div class="panel panel-default">
          <div class="form-group">
            <label for="condition_name">ชื่อ Condition Group</label>
            <input type="text" name="condition_name" id="condition_name">
          </div>
          <div class="form-group">
            <button type="button" class="button-save">Save</button>
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="section-header">
          <img src="{{ asset('images/backOffice/promotion/header-icon-promotion.png')}}">
          <span class="pagination-previous">Promotion</span>
          <span class="pagination-now">/ Add</span>
        </div>

        <div class="section-body">
          <form>
            <div class="information">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-xs-12" for="name_th">ชื่อ</label>
                    <div class="input col-md-9 col-xs-12">
                      <input type="text" name="name_th" placeholder="ชื่อ" id="name_th">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-xs-12" for="name">Name</label>
                    <div class="input col-md-9 col-xs-12">
                        <input type="text" name="name_en" placeholder="Name" id="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-xs-12" for="description">Description</label>
                    <div class="input col-md-9 col-xs-12">
                        <textarea name="description" rows="3" placeholder="Description" id="description"></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label class="col-md-3 col-xs-4" for="active">Active</label>
                    <div class="input col-md-9 col-xs-8">
                        <div class="switch switch-active">
                          <input id="toggle-active-event"
                            type="checkbox"
                            data-toggle="toggle"
                            data-onstyle="success"
                            data-offstyle="danger">
                          <span id="active">ปิด</span>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 col-xs-4" for="condition">Condition</label>
                    <div class="input col-md-9 col-xs-8">
                        <div class="switch switch-condition">
                          <input id="toggle-condition-event"
                            type="checkbox"
                            data-toggle="toggle"
                            data-onstyle="success"
                            data-offstyle="danger">
                          <span id="condition">ปิด</span>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-xs-12" for="limit">Limit</label>
                    <div class="input col-md-9 col-xs-12">
                        <input type="text" name="limit" placeholder="Limit" id="limit">
                        <span>ครั้ง</span>
                    </div>
                  </div>

                  <div class="form-gruop">
                    <label class="control-label col-md-3 col-xs-12" for="date_form">เริ่มวันที่</label>
                    <div class="input col-md-4 col-xs-12">
                      <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="date_form">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                      </div>
                    </div>

                    <label class="control-label col-md-1 col-xs-12" for="date_to">ถึง</label>
                    <div class="input col-md-4 col-xs-12">
                      <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="date_to">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="conditions">
              <div class="conditions-header">Conditions:
                <div class="condition-add">
                  <div class="main">
                    <img src="{{ asset('images/backOffice/promotion/header-add.png')}}">
                    <span>เพิ่ม Group</span>
                    <span class="icon">&#9662;</span>
                  </div>
                  <ul class="list">
                    <li>เพิ่มประเภท OR</li>
                    <li>เพิ่มประเภท AND</li>
                  </ul>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="condition-selective">
                    <div class="col-md-1 col-xs-1 verticle-middle">
                      <input type="checkbox" name="name" value="bakery">
                    </div>
                    <div class="col-md-11 col-xs-11 details">
                      <div class="col-md-6 col-xs-12">
                        <div class="condition-selective-option">
                          <span class="condition-title">ชื่อกลุ่ม:</span>
                          <span>เบอเกอร์รี่</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="condition-selective-option">
                          <span class="condition-title">เงื่อนไข:</span>
                          <span>OR</span>
                        </div>
                      </div>
                    </div>
                  </label>
                  <div class="condition-actions">
                    <div class="edit">
                      <img src="{{ asset('images/backOffice/promotion/content-edit.png')}}">
                    </div>
                    <div class="delete">
                      <img src="{{ asset('images/backOffice/promotion/content-delete.png')}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="condition-selective last">
                    <div class="col-md-1 col-xs-1 verticle-middle">
                      <input type="checkbox" name="name" value="japan_comic">
                    </div>
                    <div class="col-md-11 col-xs-11 details">
                      <div class="col-md-6 col-xs-12">
                        <div class="condition-selective-option">
                          <span class="condition-title">ชื่อกลุ่ม:</span>
                          <span class="condition-name">การ์ตูนญี่ปุ่น</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="condition-selective-option">
                          <span class="condition-title">เงื่อนไข:</span>
                          <span class="condition-name">AND</span>
                        </div>
                      </div>
                    </div>
                  </label>
                  <div class="condition-actions">
                    <div class="edit">
                      <img src="{{ asset('images/backOffice/promotion/content-edit.png')}}">
                    </div>
                    <div class="delete">
                      <img src="{{ asset('images/backOffice/promotion/content-delete.png')}}">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="benefits">
              <div class="benefits-header">Benefits:</div>
              <ul>
                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5">สินค้าแถม</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail">ขนาด</label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">กล่อง</option>
                            <option value="">แผ่น</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail" for="product_quantity">จำนวน</label>
                        <div class="col-md-9">
                          <input type="text" name="product_quantity" id="product_quantity">
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5">ส่วนลด</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail">ขนาด</label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail" for="discount_max">สูงสุดไม่เกิน</label>
                        <div class="col-md-9">
                          <input type="text" name="discount_max" id="discount_max">
                          <span>บาท</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5">รับสิทธิ์ซื้อสินค้าในกลุ่ม</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">ในราคา</option>
                            <option value="">โดยได้รับส่วนลด</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail">สูงสุดไม่เกิน</label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-4" for="no_max_discount">ไม่จำกัดส่วนลดสูงสุด</label>
                        <div class="col-md-8">
                          <input type="text" name="no_max_discount" id="no_max_discount">
                          <span>บาท</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5">ซื้อสินค้าที่ติด Tags</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">ในราคา</option>
                            <option value="">โดยได้รับส่วนลด</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-4" for="max_discount">จำกัดส่วนลดสูงสุด</label>
                        <div class="col-md-8">
                          <input type="text" name="max_discount" id="max_discount">
                          <span>บาท</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5" for="get_permission">รับสิทธิซื้อสินค้า</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3" for="get_permission_type"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">ในราคา</option>
                            <option value="">โดยได้รับส่วนลด</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3" for="get_permission_price"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5" for="total_quantity">รวมกันสูงสุดไม่เกิน</label>
                        <div class="col-md-7">
                          <input type="text" name="total_quantity" id="total_quantity">
                          <span>ชิ้น</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-5">ประเภทการส่ง</label>
                        <div class="col-md-7">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                          <select class="form-control">
                            <option value="">ฟรี</option>
                            <option value="">ในราคา</option>
                            <option value="">โดยได้รับส่วนลด</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail"></label>
                        <div class="col-md-9">
                          <input type="text" name="sending_price" id="sending_price" class="half">
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-5 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3" for="credit">เครดิตเงินคืน</label>
                        <div class="col-md-9">
                          <input type="text" name="credit" id="credit" class="half">
                          <select class="form-control">
                            <option value="">บาท</option>
                            <option value="">%</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 sub-detail" for="credit_max">ของยอดซื้อไม่เกิน</label>
                        <div class="col-md-9">
                          <input type="text" name="credit_max" id="credit_max">
                          <span>บาท</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row">
                  <li>
                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-1" for="point_operation">คะแนนสะสม</label>
                        <div class="col-md-11 other">
                          <select class="form-control">
                            <option value="">Test</option>
                          </select>
                          <input type="text" name="point_total" id="point_total">
                          <span>แต้ม</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>

                <div class="row last">
                  <li>
                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-1" for="other">อื่นๆ</label>
                        <div class="col-md-11 other">
                          <textarea name="other" rows="5" id="other" style="width: 100%"></textarea>
                        </div>
                      </div>
                    </div>
                  </li>
                </div>
              </ul>
            </div>

            <div class="submit">
              <div class="form-group">
                <button type="button" class="button-save" name="save">Save</button>
                <button type="button" class="button-cancel" name="cancel">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/promotion/create.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
@endsection
