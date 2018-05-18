@extends('layouts.eCommerce.template')

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/shipping.css')}}"/>
  <link rel="stylesheet" href="{{ asset('css/common/easy-autocomplete.min.css') }}">
@endsection


@section('body')
<div class="page_shipping">
  <div class="container ">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="shipping-title">
          shipping
        </div>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">

        <div class="panel panel-primary  panel-shipping">
          <div class="panel-heading ">
            <h3 class="panel-title">
              โปรดเลือกที่อยู่สำหรับการจัดส่ง
            </h3>
          </div>
          <div class="panel-body detail">

            @foreach($address as $item)
              @include('eCommerce.shipping._partial.shipping_address_detail')
            @endforeach

            <div class="add clearfix">
              <a href="javascript:" class="hide-address">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                Add another address
              </a>

            </div>

            @include('eCommerce.shipping._partial.form_create_address', ['form_id' => 'form-shipping'])

          </div>
        </div>

        <div class="panel panel-primary panel-billing">
          <div class="panel-heading update-shipping" id="billing-check" data-type="billing-required">
            <h3 class="panel-title">
              <a href="javascript:void(0)" class="icon" >
                  <i class="fa {{ ($billing_required) ? 'fa-check':'' }}" aria-hidden="true"></i>
                <input type="hidden" name="billing_select" value="{{ $billing_required }}">
              </a>
              โปรดเลือกที่อยู่สำหรับใบเสร็จ / ใบกำกับภาษี {{ $billing_required }}
            </h3>
          </div>
          <div class="panel-body detail {{ ($billing_required) ? '':'hidden' }}">

            @foreach($address as $item)
              @include('eCommerce.shipping._partial.billing_address_detail')
            @endforeach

            <div class="add clearfix">
              <a href="javascript:" class="hide-billing">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                Add another address
              </a>

            </div>

              @include('eCommerce.shipping._partial.form_create_address', ['form_id' => 'form-billing'])


          </div>
        </div>

      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-offset-1 col-lg-4">

        <div class="delivery-title">
          delivery
          <span class="sub">
            method
          </span>
        </div>

        <div class="express clearfix">
          <span class="title">
            <span class="icon">
              P
            </span>
            แต้มสะสม
          </span>
		  <span class="desc" style="font-size: 16px;">
            คุณมีแต้มสะสม {{$user->points_balance}} แต้ม
          </span>          
		  <span class="desc" style="font-size: 16px;">
            ใช้เป็นส่วนลดไปแล้ว {{$discount_point}} แต้ม
          </span>
		  <span class="desc" style="font-size: 16px;">
            สามารถใช้แต้มได้ {{$user->points_balance - $discount_point}} แต้ม
          </span>
        </div>

        @include('eCommerce.shipping._partial.deliver')

        @include('eCommerce._partial.order_detail')

      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="group-bot-back-left">
          <a href="{{ route('checkout.index') }}"class="btn btn-b">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
            กลับสู่เมนูก่อนหน้า
          </a>
        </div>
        <div class="group-bot-next-right">
          <a href="JavaScript:void(0);" onclick="go_next()" class="btn btn-n">
            ดำเนินการต่อ
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('script')
  <script src="{{ asset('js/common/jquery.easy-autocomplete.min.js') }}"></script>
  <script>
  function checkDigit(event) {
      var code = (event.which) ? event.which : event.keyCode;

      if ((code < 48 || code > 57) && (code > 31)) {
          return false;
      }

      return true;
  }

  $('.hide-address').click(function(){
    var form = $('#form-shipping');
    if( $(this).is(':visible') ){
      form.slideToggle( "fast" );
    }else{
      form.slideToggle( "fast" );
    }

  })

  $('.hide-billing').click(function(){
    var form = $('#form-billing');
    if( $(this).is(':visible') ){
      form.slideToggle( "fast" );
    }else{
      form.slideToggle( "fast" );
    }

  })

  $('#billing-check').click(function(){
    var _self = $(this);
    var parent_show =  $(this).closest('.panel-billing')

    if( parent_show.find('.detail').hasClass('hidden') == true ){
      parent_show.find('.detail').removeClass('hidden')
        _self.find('i').eq(0).addClass('fa-check')
        _self.find('input').val(1)
    }else{
      parent_show.find('.detail').addClass('hidden')
      _self.find('i').eq(0).removeClass('fa-check')
      _self.find('input').val(0)
    }
  })

// Auto complete
  const _address = $('#addresses');
  _address.easyAutocomplete({
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
              const selectedItemData = _address.getSelectedItemData();
              $('#sub_district_span').text(selectedItemData.sub_district);
              $("#sub_district_id").val(selectedItemData.sub_district_id);
              $("#sub_district").val(selectedItemData.sub_district);

              $("#district_span").text(selectedItemData.district);
              $("#district_id").val(selectedItemData.district_id);
              $("#district").val(selectedItemData.district);

              $("#province_span").text(selectedItemData.province);
              $("#province_id").val(selectedItemData.province_id);
              $("#province").val(selectedItemData.province);

              $("#postal_code_id").val(selectedItemData.postal_code_id);
              $("#postal_code").val(selectedItemData.postal_code);

              _address.val(selectedItemData.postal_code);
          }
      }
  });

  function choose_this_type_all(type,value,name){
        if(type == 'type'){
            $('#shipping-price-choose-'+value).prop("checked", true);
            $('.delivery-text').html('ส่งแบบ '+name);
        }else if(type == 'price'){
            $('#shipping-type-id-'+value).prop("checked", true);
            $('.delivery-text').html('ส่งแบบ '+name);
        }else if(type == 'point'){
            $('#shipping-type-id-'+value).prop("checked", true);
            $('.delivery-text').html('ส่งแบบ '+name);
        }else{

        }
  }

  function go_next(){
      if(typeof $('input[name=shipping_type_id]:checked').val() != "undefined"){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          const shipping_address_id = $('.update-shipping').data('shipping_address_id');
          const billing_address_id = $('.update-shipping').data('billing_address_id');
          const shipping_type_id = $('input[name=shipping_type_id]:checked').val();
          const shipping_price_point_choose = $('input[name=shipping_price_point_choose]:checked').val();

          $.ajax({
              type: 'POST',
              url: '/shipping',
              data: {
                  shipping_address_id:shipping_address_id,
                  billing_address_id:billing_address_id,
                  shipping_type_id:shipping_type_id,
                  shipping_price_point_choose:shipping_price_point_choose
              },
              success: function (data) {
                  window.location.href = '{{ route('payment.index') }}';
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });

      }else{
          toastr['error']('โปรดเลือกวิธีการจัดส่ง');
      }
  }
  // END
</script>
@endsection
