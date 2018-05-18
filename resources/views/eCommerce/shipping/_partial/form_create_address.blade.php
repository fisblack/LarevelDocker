<form action="{{ route('shipping.createAddress') }}" method="POST" id="{{ $form_id }}" class="form-shipping" style="display:none" role="form">
    {{ csrf_field() }}
    <div class="form-group has-float-label clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">ชื่อ และ นามสกุล</label>
        </div>
        <div class="col-sm-6 ">
            <input type="text" name="full_name" class="form-control" id="" placeholder="">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">ที่อยู่ 1 <small>(บรรทัดแรก)</small></label>
        </div>
        <div class="col-sm-6 ">
            <input type="text" name="address_line_1" class="form-control">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">ที่อยู่ 2 <small>(บรรทัดรอง)</small></label>
        </div>
        <div class="col-sm-6 ">
            <input type="text" name="address_line_2" class="form-control">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">รหัสไปรษณีย์</label>
        </div>
        <div class="col-sm-6 ">
            <input type="text" id="addresses" class="form-control">
            <input type="hidden" name="postal_code_id" class="form-control" id="postal_code_id">
            <input type="hidden" name="postal_code" class="form-control" id="postal_code">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">แขวง/ตำบล</label>
        </div>
        <div class="col-sm-6 ">
            <span id="sub_district_span"></span>
            <input type="hidden" name="sub_district_id" class="form-control" id="sub_district_id">
            <input type="hidden" name="sub_district" class="form-control" id="sub_district">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">เขต/อำเภอ</label>
        </div>
        <div class="col-sm-6 ">
            <span id="district_span"></span>
            <input type="hidden" name="district_id" class="form-control" id="district_id">
            <input type="hidden" name="district" class="form-control" id="district">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">จังหวัด</label>
        </div>
        <div class="col-sm-6 ">
            <span id="province_span"></span>
            <input type="hidden" name="province_id" class="form-control" id="province_id">
            <input type="hidden" name="province" class="form-control" id="province">
        </div>

    </div>

    <div class="form-group clearfix">
        <div class="col-sm-3 text-right">
            <label class="" for="">โทรศัพท์มือถือ</label>
        </div>
        <div class="col-sm-6 ">
            <input type="text" name="phone" class="form-control" id="" placeholder="">
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-5">
            <button type="submit" class="btn btn-primary btn-submit-form">บันทึก</button>
        </div>
    </div>

</form>
