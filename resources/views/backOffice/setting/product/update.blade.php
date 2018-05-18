{{-- @author: Parada Susuk @phone: 0835548554 @email: careparadas@gmail.com --}} @extends('layouts.backOffice.template')
@section('head')
<link rel="stylesheet" href="{{ asset('css/backOffice/setting/product/create.css') }}">
<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese"
  rel="stylesheet">

<link rel="stylesheet" href="{{ asset('js/plugins/bower_components/bootstrap-datetimepicker.min.css') }}"> @endsection @section('body')
<div class="container-back">
  <div class="order">
    <div class="">
      <!--      <div class="padding">-->
      <div class="bg shadow radius">
        <div class="header underline">
          <div class="page-name float-left">
            <div class="icon float-left">
              <img src="{{ asset('images/backOffice/setting/product/product.png') }}">
            </div>

            <div class="text float-left txt">
              Products<span> / Update</span>
            </div>
          </div>
        </div>
        <form action="{{ route('backOffice.setting.product.update', $product->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="_method" value="PUT">
          <div class="content">

            <h1 class="data">แก้ไขสินค้า</h1>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="inputPassword3" class="col-md-1 control-label radius">หมวด</label>
                  <div class="col-md-11">
                    <div class="input ">
                      <div class="row">
                        @foreach($data['categories'] as $category)
                        <div class="col-category">
                            <label class="checkbox-inline label-checkbox">
                              <input
                                name="category[]"
                                type="checkbox"
                                class="largerCheckbox"
                                value="{{ $category->id }}" @foreach($product->category()->get() as $cat) @if($cat->id == $category->id) checked="checked" @endif @endforeach>
                              <span class="txt-check">{{ $category->name_th }}</span>
                            </label>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label for="inputPassword3" class="col-md-3  control-label radius">ชื่อหนังสือ(ไทย)</label>
                        <div class="col-md-8 ">
                          <input type="text" name="name" class="form-control radius border2" id="Tracking" value="{{ empty(old('name')) ? $product->name : old('name') }}">
                        </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label for="inputPassword3" class="col-md-3  control-label radius">ชื่อหนังสือ(อังกฤษ)</label>
                        <div class="col-md-8 ">
                          <input type="text" name="name_en" class="form-control radius border2" id="Tracking" value="{{ empty(old('name_en')) ? $product->name_en : old('name_en') }}">
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label for="inputPassword3" class="col-md-3  control-label radius">ISBN</label>
                        <div class="col-md-8 ">
                          <input type="text" name="isbn" class="form-control radius border2" id="Tracking" value="{{ empty(old('isbn')) ? $product->isbn : old('isbn') }}">
                        </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label for="inputPassword3" class="col-md-3 control-label radius">จำนวนหน้า</label>
                        <div class="col-md-4">
                          <input type="number" name="page_count" class="form-control radius border2" id="Tracking" value="{{ empty(old('page_count')) ? $product->page_count : old('page_count') }}" min="1" step="0.01">
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="inputPassword3" class="col-md-1 control-label radius">ชื่อผู้แต่ง</label>
                  <div class="col-md-11">
                    <div class="input ">
                      <div class="row">
                        
                        @foreach($data['writers'] as $writer)
                          <div class="col-category">
                              <label class="checkbox-inline label-checkbox">
                                <input
                                  name="author[]"
                                  type="checkbox"
                                  class=" largerCheckbox"
                                  value="{{ $writer->id }}"
                                  @foreach($product->writer()->get() as $writ) @if($writ->id == $writer->id) checked="checked" @endif @endforeach>
                                <span class="txt-check"><img src="{{ getImage($writer->image) }}" width="20" height="20px" class="img-circle"> {{ $writer->fullname_th }}</span>
                              </label>
                          </div>
                        @endforeach

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputPassword3" class="col-xs-3  control-label radius">  น้ำหนัก</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="weight" class="form-control radius border2  txt-center" id="Tracking" placeholder="" value="{{ empty(old('weight')) ? $product->weight : old('weight') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-2  control-label radius labal-gray">กรัม.</label>
                </div>
              </div>
              <div class="col-xs-12 col-sm-5 col-md-5">
                <div class="form-group">
                  <label for="inputPassword3" class="col-xs-1 control-label radius">กว้าง</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="width" class="form-control radius border2  txt-center" id="" placeholder="" value="{{ empty(old('width')) ? $product->width : old('width') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-1  control-label radius labal-gray">ซม.</label>
                  <label for="inputPassword3" class="col-xs-1  control-label radius">ยาว</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="depth" class="form-control radius border2  txt-center" id="" placeholder="" value="{{ empty(old('depth')) ? $product->depth : old('depth') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-1  control-label radius labal-gray">ซม.</label>
                  <label for="inputPassword3" class="col-xs-1  control-label radius">สูง</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="height" class="form-control radius border2  txt-center" id="" placeholder="" value="{{ empty(old('height')) ? $product->height : old('height') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-1  control-label radius labal-gray">ซม.</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputPassword3" class="col-md-3  control-label radius">รูปหนังสือ</label>
                  <div class="col-md-8 ">
                    <div class="custom-file-upload">
                      <input type="file" id="addImage" name="myfiles[]" class="hidden imageFile" accept="image/jpeg,image/jpg,image/png,image/bmp"/>
                      <button type="button" id="btnAddImage" class="file-upload-button col-xs-3 ">Browse</button>
                      <input type="text" id="displayImageName" class="file-upload-input col-xs-9 "/>
                      <span id="image-list-file"></span>
                    </div>
                    <br><br><br>
                    <div class="row" >
                      <div id="showAfterAddList">
                      <div class="col-xs-3" class="hidden">My Image</div>
                      <div class="col-xs-7">
                        <div class="img-crop">
                          <img src="" id="displayImageCover" class="hidden" width="100%">
                        </div>
                        <div class="text-center" style="margin-top: 10px;">
                          <button type="button" class="btn btn-red" id="addImageToLists"><i class="fa fa-plus-circle"></i> ADD</button>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-md-3  control-label radius">Exam Page (PDF)</label>
                  <div class="col-md-8 ">
                    <div class="custom-file-upload">
                      <input type="file" id="attach" name="pdf" accept="application/pdf" class="hidden"/>
                      <button type="button" id="btnAddPDF" class="file-upload-button col-xs-3 ">Browse</button>
                      <input type="text" name="_file" id="displayPDFName" class="file-upload-input col-xs-9" value="{{ $product->file_ref }}" />
                      <ul style="padding-top: 50px;">
                        <li><i class="fa fa-file"></i> File <i class="fa fa-times-circle" style="float: right; color: #a62221; margin-right: 20px;"></i></li>
                      </ul>
                    </div>
                    <br>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-6">
                <label for="inputPassword3" class=" control-label ">รูปทั้งหมด</label>
                <br><br>

                <div class="box-product border radius">
                  <div class="body boder">
                    <ul class="list" id="coverLists">

                      <?php $size = 1; ?>
                      @foreach($product->imageCover()->get() as $imageCover)
                      <li class="gradient list-cover-{{ $imageCover->id }}">
                        <div class="btn-action">
                          <div class="touch">
                            <img src="{{ asset('images/backOffice/setting/product/touch.png') }}">
                          </div>
                        </div>
                        <div class="v-lin"></div>
                        <div class="btn-action">
                          <input name="bookchk" type="checkbox" class=" " value="">
                        </div>
                        <div class="cover coverbook">
                          <img src="{{ getImage($imageCover->image) }}" width="65px" style="max-height: 70px;">
                        </div>
                        <div class="btn-action">
                          <div class="delete radius" >
                            <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}" data-id="{{ $imageCover->id }}" class="action-delete">
                          </div>
                        </div>
                        <div class="btn-action">
                          <input name="book" type="radio" value="{{ $imageCover->id }}" @if($imageCover->id == $product->cover_image_id) checked="checked" @endif>
                        </div>
                      </li>
                      @endforeach

                    </ul>
                  </div>
                  <div class="clear"></div>
                </div>
                <br><br>

                <div class="form-group">
                  <label for="inputPassword3" class="col-md-3  control-label radius">Description</label>
                  <div class="col-md-8 ">
                    <textarea type="text" name="description" rows="6" class="form-control radius border2 textarea" id="Tracking">{{ empty(old('description')) ? $product->description : old('description') }}</textarea>
                  </div>
                </div>
              </div>

            </div>

            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputPassword3" class="col-xs-3  control-label radius"> ราคาขายปลีก</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="suggested_retail_price" class="form-control radius border2 txt-center" id="Tracking" value="{{ empty(old('suggested_retail_price')) ? $product->suggested_retail_price : old('suggested_retail_price') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-2  control-label radius labal-gray">บาท</label>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                  <div class="input2 col-xs-4">
                    <label class="checkbox-inline label-checkbox">
                      <input name="optradio_cost" type="checkbox" id="cost" class="largerCheckbox clickToggle" @if(old('optradio_cost') || !empty($product->cost)) checked @endif>
                      <span class="txt-check">ราคาทุน</span>
                    </label>
                  </div>
                  <div class="col-xs-3">
                    <input type="number" disabled name="cost" class="form-control radius border2 txt-center" id="cost-num" value="{{ empty(old('cost')) ? $product->cost : old('cost') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-1  control-label radius labal-gray">บาท</label>
                </div>
              </div>

              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                  <div class="input2 col-xs-4">
                    <label class="checkbox-inline label-checkbox">
                      <input name="optradio_reward_points" type="checkbox" id="reward_points" class="largerCheckbox clickToggle" @if(old('optradio_reward_points') || !empty($product->reward_points)) checked @endif>
                      <span class="txt-check">ได้</span>
                    </label>
                  </div>
                  <div class="col-xs-3">
                    <input type="number" disabled name="reward_points" class="form-control radius border2  txt-center" id="reward_points-num" value="{{ empty(old('reward_points')) ? $product->reward_points : old('reward_points') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-1  control-label radius labal-gray">แต้ม</label>
                </div>
              </div>

              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                  <div class="input2 col-xs-4">
                    <label class="checkbox-inline label-checkbox">
                      <input name="optradio_point_redemption_for_free_gift" type="checkbox" id="point_redemption_for_free_gift" class="largerCheckbox clickToggle" @if(old('optradio_point_redemption_for_free_gift') || !empty($product->point_redemption_for_free_gift)) checked @endif>
                      <span class="txt-check">ใช้</span>
                    </label>
                  </div>
                  <div class="col-xs-3">
                    <input type="number" disabled name="point_redemption_for_free_gift" class="form-control radius border2  txt-center" id="point_redemption_for_free_gift-num" value="{{ empty(old('point_redemption_for_free_gift')) ? $product->point_redemption_for_free_gift : old('point_redemption_for_free_gift') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-4  control-label radius labal-gray">แต้มแลกฟรี</label>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-3 control-label radius">วิธีการส่ง</label>
                  <div class="col-md-4 ">
                    <select class="form-control radius border2  txt-center" name="shipping_method">
                      @foreach($data['shippings'] as $shipping)
                      <option
                        value="{{ $shipping->id }}"
                        @if(old('shipping_method') == $shipping->id || $product->shipping_method_id == $shipping->id) selected="selected" @endif>{{ $shipping->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-3 control-label">วันที่เปิดจำหน่าย</label>
                  <div class="col-md-8">
                    <div class="col2">
                      <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" id="calendar" value="" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <div class="col3 calendar">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <br>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="input2">
                      <label class="checkbox-inline label-checkbox2">
                        <input name="is_point_redemption_only" type="checkbox" class=" largerCheckbox" @if(old('is_point_redemption_only') || $product->is_point_redemption_only) checked @endif>
                        <span class="txt-check2">ซื้อโดยใช้แต้มอย่างเดียว</span>
                      </label>
                      <label class="checkbox-inline label-checkbox2">
                        <input name="is_join_promotion" type="checkbox" class=" largerCheckbox" @if(old('is_join_promotion') || $product->is_join_promotion) checked @endif>
                        <span class="txt-check2">ร่วมโปรโมชัน</span>
                      </label>
                      <label class="checkbox-inline label-checkbox2">
                        <input name="is_free_shipping" type="checkbox" class="largerCheckbox" @if(old('is_free_shipping') || $product->is_free_shipping) checked @endif>
                        <span class="txt-check2">ส่งฟรี</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-3 control-label radius">ชนิดสินค้า</label>
                  <div class="col-md-4 ">
                    <select class="form-control radius border2  txt-center" name="product_type">
                      @foreach($data['types'] as $type)
                      <option
                        value="{{ $type->id }}"
                        @if(old('product_type') == $type->id || $product->product_type_id == $type->id) selected="selected" @endif>{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="inputPassword3" class="col-xs-3  control-label radius"> ราคาสมาชิก</label>
                  <div class="col-xs-2 ">
                    <input type="number" name="suggested_member_price" class="form-control radius border2 txt-center" id="Tracking" value="{{ empty(old('suggested_member_price')) ? $product->suggested_member_price : old('suggested_member_price') }}" min="1" step="any">
                  </div>
                  <label for="inputPassword3" class="col-xs-2  control-label radius labal-gray">บาท</label>
                </div>
              </div>
            </div>

            <div class="row">
              <center>
                <button type="submit" class="btn btn-red">Save</button>
                <a href="{{ route('backOffice.setting.product.index') }}" class="btn btn-black">Cancel</a>
              </center>
              <br><br>
            </div>

          </div>

        </form>
      </div>
    </div>

  </div>

</div>
@endsection 

@section('script')
<script src="{{ asset('js/plugins/bower_components/moment.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/bower_components/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('js/backOffice/setting/product/update.js') }}"></script>

<script type="text/javascript">
  $(function () {
    $('#datetimepicker1').datetimepicker();

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

    $('.action-delete').on('click', function(ev){
      var that = this;
      $.ajax({
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ route('backOffice.setting.product.destroy', $product->id) }}',
        data: {
          deleteImageID: $(this).attr('data-id')
        },
        success: function(resp){
          if(resp.status == 200){
            $('.list-cover-' + $(that).attr('data-id')).remove();
          } else {
            toastr["error"](resp.massage);
          }
        }
      });
    })

  });

function updateCoverList(){
  var imgCover = $('#displayImageCover').attr('src');
  var imageFile = $('#addImage');
  var imageClone = imageFile.clone();
  var size = $('.gradient').size();

  imageClone.attr({name: 'coverImg['+size+']', id: ''});

  if(imgCover.length !== 0){
    var list = $('#coverLists').html();
    var newList = '<li class="gradient">\n\
            <div class="btn-action">\n\
              <div class="touch">\n\
                <img src="{{ asset('images/backOffice/setting/product/touch.png') }}">\n\
              </div>\n\
            </div>\n\
            <div class="v-lin"></div>\n\
            <div class="btn-action">\n\
              <input name="bookchk['+size+']" type="checkbox">\n\
            </div>\n\
            <div class="cover coverbook">\n\
              <img src="'+imgCover+'" width="65px" style="max-height: 70px;">\n\
            </div>\n\
            <div class="btn-action">\n\
              <div class="delete radius">\n\
                <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">\n\
              </div>\n\
            </div>\n\
            <div class="btn-action">\n\
              <input name="book" value="'+size+'" type="radio">\n\
            </div>\n\
          </li>';
    $('#coverLists').html(newList.concat(list))
    $('#image-list-file').prepend(imageClone)
    clearForm()
  }
}


</script>
@endsection
