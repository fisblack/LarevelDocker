{{--
    @author: Parada Susuk (Care)
    @phone: 0835548554
    @email: careparadas@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/product/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
@endsection

@section('body')
    <div class="container-back">
      <div class="order">
        <div class="padding">
          <div class="bg shadow radius">
            <div class="header underline">
              <div class="page-name float-left">
                <div class="icon float-left">
                  <img src="{{ asset('images/backOffice/setting/product/product.png') }}">
                </div>

                <div class="text float-left">Products</div>
              </div>
              
              <div class="delete btn-action float-right border-left">
                <a href="javascript:;" id="delete-all"> <img src="{{ asset('images/backOffice/setting/product/delete.png') }}"></a>
              </div>

              <div class="add btn-action float-right border-left">
                <a href="{{ route('backOffice.setting.product.create') }}">  <img src="{{ asset('images/backOffice/setting/product/add.png') }}"></a>
              </div>
                    
              <div class="search float-right">
                <form action="{{ route('backOffice.setting.product.index') }}" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." @if(isset($_GET['search'])) value="{{$_GET['search']}}"@endif>
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit">
                        <img src="{{ asset('images/backOffice/setting/product/search.png') }}">
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <ul class="list underline">
              @if(count($data['products']) <= 0)
              <h4>Empty</h4>
              @endif
              @foreach($data['products'] as $product)
              <li class="gradient {{ $product->deleted_at ? 'gray' : null }}">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                  <div class="select float-left">
                    <input type="checkbox" name="deleteAll[]" id="{{$product->id}}" class="deleteAll">
                  </div>
                  <div class="vhr "></div>
                  <div class="profile-img float-left">
                    <div class=" txt-center">
                      <img src="{{ !empty($product->coverImage) ? getImage($product->coverImage->image) : noImage() }}" width="50px">
                    </div>
                  </div>
                  <div class="data float-left">
                      
                    <div class="info ">
                      <div class="text">
                        <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="namebook paddding-r10">
                            <d class="paddding-r10">ชื่อเรื่อง:</d>
                            <span class="">{{ $product->name }}</span> / <span>{{ $product->name_en }}</span></div>
                        </div>
                        <div class="detailbook">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  ">
                            <span class="paddding-r10">กว้างxยาวxสูง</span>{{ $product->width . 'x' . $product->depth . 'x' . $product->heigth }} ซม
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                            <span class="paddding-r10">น้ำหนัก</span>{{ $product->weight }} กรัม
                          </div>  
                        </div>  
                      </div>
                      <div class="clear"></div>

                      <div class="status col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="box payment r">
                          <div class="topic">ประเภท</div>
                          <span class="type">{{ $product->productType->name }}</span>
                        </div>
                      </div>
                    </div>
                                     
                  </div>
                </div>
                <div class="clearfix hidden-md hidden-lg">
                  <div class="hr"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                  <div class="price col-xs-12 col-sm-6 col-md-5 col-lg-5  txt-center">
                    <div style="border-right: 1px solid #e4e4e4;border-left: 1px solid #e4e4e4;">
                        <div class="price-num sub-str">
                          <?php $size = count($product->category()->get()); ?>
                          @foreach($product->category()->get() as $key => $category)
                          {{ $category->name_th }}@if($key+1 < $size), @endif
                          @endforeach
                        </div>
                        <div class="price-txt">หมวด</div>  
                    </div>
                  </div>
                         
                  <div class="price b col-xs-12 col-sm-6 col-md-5 col-lg-5  txt-center">
                    <div style="border-right: 1px solid #e4e4e4;border-left: 1px solid #e4e4e4;">
                         <div class="price-num">{{ $product->suggested_retail_price }} บาท</div>
                         <div class="price-txt">ราคา (ปลีก)</div>
                    </div>
                  </div>
                    
                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 txt-center">
                    <div class="txt-center" style="line-height: 3;">
                      <form action="{{ url('backOffice/setting/product/restore') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <button class="delete print" style="line-height: 30px; width: 30px; padding: 0;">
                          <img class="btn-undo img-responsive" src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                        </button>
                      </form>
                      <form id="{{ $product->id }}" class="delete radius b forceDelete">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETEs">
                        <a src="javascript:;" class="delete submitForm print" style="line-height: 30px; width: 30px; cursor: pointer;">
                            <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                          </a>
                      </form>
                    </div>

                    <div class="btn-action txt-center">
                      <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 txt-center">
                        <a href="{{ route('backOffice.setting.product.edit', $product->id) }}" class="edit radius b">
                          <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                        </a>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 txt-center">
                        <form action="{{ route('backOffice.setting.product.destroy', $product->id) }}?type=soft_delete" method="post" class="delete radius b">
                          {!! csrf_field() !!}
                          <input name="_method" type="hidden" value="DELETE">
                          <a src="javascript:;" class="delete submitForm" style="cursor: pointer;">
                            <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                          </a>
                        </form>
                      </div>
                    </div>
                       
                  </div>
                </div>

              </li>
              @endforeach
            </ul>

            <div class="pagination-section">
              <div class="col1  text-align-left-destop">
                <div class="text">ทั้งหมด <span>{{ $data['products']->total() }}</span> รายการ</div>
              </div>
              <div class="col2 text-align-right-destop">
                @if(request()->get('search'))
                    {{ $data['products']->appends(['search' => request()->get('search')])->links('paginations.sensebook') }}
                @else
                    {{ $data['products']->links('paginations.sensebook') }}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function(){

  $('.submitForm').on('click', function(e){
    $(this).parents('form').submit();
  });

  $('.forceDelete').on('submit',(ev) => {
      swal({
          title: 'Are You Sure ?',
          text: "มีข้อมูลที่จะถูกลบถาวร!!",
          type: 'warning',
          confirmButtonColor: '#d60500',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!'
      }).then( result => {
          if(result.value){
              $.ajax({
                  type: "DELETE",
                  url: "{{url('backOffice/setting/product/0?deleteAll=true')}}",
                  data: {id: [ev.target.id]},
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: (data) => {
                      location.reload();
                  }
              });
          } 
      });
      return false
  });

  $('#delete-all').on('click',function(){
        let deleteID = [];
        $('.deleteAll').each((a, b) => {
            b.checked ?  deleteID.push(b.id) : null 
        });

        if(!deleteID.length){
            swal({
                text: 'ไม่มีข้อมูลที่จะลบ',
                type: 'error',
            })
        }else{
            swal({
                title: 'Are You Sure ?',
                text: "มีข้อมูลที่จะถูกลบถาวร!!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then( result => {
                if(result.value){
                    $.ajax({
                        type: "DELETE",
                        url: "{{url('backOffice/setting/product/0?deleteAll=true')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {id: deleteID},
                        success: (data) => {
                            location.reload();
                        }
                    });
                } 
            }); 
        }
        
    });

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
  @elseif(session()->has('confirm'))
    swal({
      title: 'Are You Sure ?',
      text: "มีข้อมูลที่จะถูกลบถาวร!!",
      type: 'warning',
      confirmButtonColor: '#d60500',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then( result => {
      if(result.value){
        $.ajax({
            type: "DELETE",
            url: "{{url('backOffice/setting/product/0?deleteAll=true')}}",
            data: {
              id: [{{ session()->get('confirm') }}]
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                location.reload();
            }
        });
      } 
    });
  @endif
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      toastr["error"]("{{ $error }}", "Error");
    @endforeach
  @endif

});
</script>
@endsection
