{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/profile/index.css') }}">

    <!-- plugin css -->
    <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
    <!-- CSS file -->
    <link rel="stylesheet" href="{{ asset('css/common/easy-autocomplete.min.css') }}">
@endsection

@section('body')
    <div class="container-fluid page-backoffice-profile">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/profile/profile.png')}}" class="w-100" alt="">
                        </figure>
                        <a href="{{ route('profile.index') }}" class="title active">
                            Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box-result clearfix" style="">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" class="form-horizontal form-userclass clearfix" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="col-md-4">
                            <div class="pro-preview">
                                @if($user->image)
                                    <img class="img img-circle img-responsive img-profile-preview" id="display-profile-picture" src="{{ getImage($user->image) }}">
                                @else
                                    <img class="img img-circle img-responsive img-profile-preview" id="display-profile-picture" src="{{asset('images/backOffice/profile/preview.png')}}" alt="">
                                @endif
                                <div class="img-title">
                                    {{ $user->full_name }}
                                </div>
                                <div class="img-title-sub">
                                </div>
                                <div class="g-btn">
								<span class="btn btn-default btn-file upload">
								อัพโหลด <input type="file" name="profile_picture" accept="image/*">
								</span>
                                </div>
                                <div class="g-point">
                                    คะแนนสะสมคงเหลือ : {{ $user->points_balance }}
                                </div>
                                <div class="g-custome">
                                    Customer tier : ยังไม่ทราบที่มา // สต๊อก
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">
                                    ชื่อ - นามสกุล
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" placeholder="ชื่อ - นามสกุล" class="form-control" value="{{ (old('full_name')) ? old('full_name') : $user->full_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">
                                    เบอร์โทรศัพท์
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" placeholder="เบอร์โทรศัพท์" class="form-control" value="{{ (old('phone')) ? old('phone') : $user->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">
                                    วันเดือนปีเกิด
                                </label>
                                <div class="col-sm-9">
                                    @if($user->dateOfBirth !== null)
                                        <span class="form-control">{{ date('Y-m-d', strtotime($user->dateOfBirth->date . '-' . $user->dateOfBirth->month . '-' . $user->dateOfBirth->year)) }}</span>
                                    @else
                                        <div class="input-group datetime">
                                            <input type="text" class="form-control" placeholder="วันเดือนปีเกิด" data-toggle="datepicker" name="dob" value="{{ old('dob') }}">
                                            <span class="input-group-addon bg-white">
										            <img src="{{ asset('images/backOffice/member/time.png') }}" alt="">
										        </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">
                                    อีเมล
                                </label>
                                <div class="col-sm-9">
                                    @if($user->email)
                                        <span class="form-control">{{ $user->email }}</span>
                                    @else
                                        <input type="email" name="email" placeholder="อีเมล" class="form-control" value="{{ (old('email')) ? old('email') : $user->email }}">
                                    @endif
                                </div>
                            </div>
                            @if($user->email)
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        รหัสผ่านใหม่
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" placeholder="ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        รหัสผ่านใหม่ (อีกครั้ง)
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password_confirmation" placeholder="ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="col-sm-3 control-label">
                                        รหัสผ่าน
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="old_password" placeholder="ยืนยันรหัสผ่านเพื่อบันทึกข้อมูล" class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group group-address">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h5 class="title">ที่อยู่การชำระเงิน</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h5 class="title">ที่อยู่การจัดส่ง</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h4 class="title">
                                            ที่อยู่
                                        </h4>
                                    </div>
                                </div>
                                @foreach($user->addresses as $address)
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                            <div class="col-md-6 col-sm-6 col-xs-6 group">
                                                <input type="radio" name="billing_address_id" value="{{ $address->id }}" {{ ($user->billing_address_id == $address->id) ? 'checked' : '' }}>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 group" style="">
                                                <input type="radio" name="shipping_address_id" value="{{ $address->id }}" {{ ($user->shipping_address_id == $address->id) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 address-section">
                                            <div class="box-gray">
                                                <h4 class="title-add">
                                                    {{ $address->address_line_1 }}
                                                </h4>
                                                <address>
                                                    {{ $address->address_line_2 }} <br>
                                                    {{ $address->subDistrict->name }} {{ $address->district->name }} {{ $address->province->name }} <br>
                                                    รหัสไปรษณีย์ {{ $address->postalCode->code }}
                                                    <a href="javascript:void(0);" class="deleteAddress" data-id="{{ $address->id }}">
                                                        <img class="bin" src="{{asset('images/backOffice/profile/bin.png')}}" alt="">
                                                    </a>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-9 col-sm-9 col-xs-9">
                                    <button type="button" class="btn btn-add-address" data-toggle="modal" data-target="#addMoreAddress">
                                        + เพิ่มที่อยู่ใหม่
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-save">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="addMoreAddress" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="{{ route('backOffice.address.store') }}" method="post" class="form-horizontal" >
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">เพิ่มที่อยู่ใหม่</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">ที่อยู่ <small>(บรรทัดแรก)</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="address_line_1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">ที่อยู่ <small>(บรรทัดรอง)</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="address_line_2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">รหัสไปรษณีย์</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="addresses" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="col-md-3 control-label">ตำบล</span>
                                            <div class="col-md-9">
                                                <div class="form-group row" style="margin-bottom: 0 !important;">
                                                    <div class="col-md-5 address-span">
                                                        <span id="sub_district_span"></span>
                                                        <input type="hidden" name="sub_district_id" class="form-control" id="sub_district_id">
                                                    </div>
                                                    <label for="inputValue" class="col-md-2 control-label">อำเภอ</label>
                                                    <div class="col-md-5 address-span">
                                                        <span id="district_span"></span>
                                                        <input type="hidden" name="district_id" class="form-control" id="district_id">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="col-md-3 control-label">จังหวัด</span>
                                            <div class="col-md-9">
                                                <div class="form-group row" style="margin-bottom: 0 !important;">
                                                    <div class="col-md-5 address-span">
                                                        <span id="province_span"></span>
                                                        <input type="hidden" name="province_id" class="form-control" id="province_id">
                                                    </div>
                                                    <div class="col-md-4 address-span">
                                                        <input type="hidden" name="postal_code_id" class="form-control" id="postal_code_id">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn" style="color: #fff; background-color: #8a1330; border-color: #731028;">บันทึก</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
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
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.en-US.js"></script>
    <script src="{{ asset('js/common/jquery.easy-autocomplete.min.js') }}"></script>

    <script>
        $(document).ready( function() {

            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-mm-dd'
            });

            $(':file').on('fileselect', function(event, numFiles, label) {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    console.log(reader)
                    reader.onload = function (e) {
                        $('#display-profile-picture').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            let options = {
                url: "{{ asset('js/website/addresses.json') }}",
                getValue: function(element) {
                    return element.sub_district + ' » ' + element.district + ' » ' + element.province + ' » ' + element.postal_code;
                },
                list: {
                    maxNumberOfElements: 10,
                    match: {
                        enabled: true
                    },
                    onClickEvent: function() {
                        const selectedItemData = $("#addresses").getSelectedItemData();
                        let sub_district = selectedItemData.sub_district;
                        let sub_district_id = selectedItemData.sub_district_id;
                        let district = selectedItemData.district;
                        let district_id = selectedItemData.district_id;
                        let province = selectedItemData.province;
                        let province_id = selectedItemData.province_id;
                        let postal_code = selectedItemData.postal_code;
                        let postal_code_id = selectedItemData.postal_code_id;
                        $("#sub_district_span").text(sub_district);
                        $("#sub_district_id").val(sub_district_id);
                        $("#district_span").text(district);
                        $("#district_id").val(district_id);
                        $("#province_span").text(province);
                        $("#province_id").val(province_id);
                        // $("#postal_code_span").text(postal_code);
                        $("#postal_code_id").val(postal_code_id);

                        $("#addresses").val(postal_code);
                    }
                }
            };

            $("#addresses").easyAutocomplete(options);

            $('.deleteAddress').click(function () {
                swal({
                    title: 'Are You Sure ?',
                        text: "This address will be delete.",
                        type: 'warning',
                        confirmButtonColor: '#d60500',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
                }).then(result => {
                    if (result.value) {
                        location.href = "backOffice/address/" + $(this).data('id')
                    }
                });
                return false
            })

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
