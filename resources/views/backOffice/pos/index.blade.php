{{--
    @author: MR.SOMPOB MOONSRI (Nick)
    @phone: 0811129499
    @email: eslidiingz@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/pos/index.css') }}">
@endsection

@section('body')
    <div class="container-fluid">
      <div class="wrapper">
        <div class="panel panel-default panel-container">
          <div class="heading">
            <div class="row">
              <div class=" heading-title">
                <figure>
                  <img src="{{ asset('images/backOffice/pos/icon-pos.png') }}"> POS
                </figure>
              </div>
              <div class="">
                <div class="options">
                  <div class="option-item">
                    <a href="{{ route('backOffice.pos.create') }}">
                      <figure>
                        <img src="{{ asset('images/backOffice/pos/icon-add.png') }}">
                      </figure>
                    </a>
                  </div>
                  <div class="option-item">
                      <form action="{{ route('backOffice.pos.deleteSelected') }}" method="post" id="frmDeleteSelected">
                          <a href="javascript:void(0);" class="btn-delete-select"> <img src="{{ asset('images/backOffice/pos/icon-remove.png') }}"></a>
                      </form>
                  </div>
                </div>

                <div class="search">
                  <form action="{{ route('backOffice.pos.index') }}" method="GET">
                    <div class="input-group">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search..." value="{{ (request()->get('search')) ? request()->get('search') : '' }}">
                      <span class="input-group-addon" id="search-group-addon">
                        <i class="fa fa-search"></i>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="task-list">
              @foreach($pos as $p)
                <div class="task-item {{ ($p->trashed()) ? 'task-delete' : '' }}">
  <div class="customer">
	<div class="check">
		<input type="checkbox" data-id="{{ $p->id }}" data-deleted="{{ ($p->trashed()) ? 'true' : 'false' }}">
	</div>
	<div class="profile">
	  <figure>
		@if($p->image)
		  <img class="img-circle member-profile-img" src="{{ getImage($p->image) }}">
		@else
		  <img class="img-circle member-profile-img" src="{{ asset('images/backOffice/member/user.png') }}">
		@endif
	  </figure>
	</div>
	<div class="detail">
	  <div class="name"><span>Name: </span>{{ ($p->member) ?  $p->member->full_name : ''  }}</div>
	  <div class="date"><span>Date: </span>25/08/2560</div>
	  <div class="transection-by">ชื่อผู้บันทึก {{ ($p->staff) ?  $p->staff->full_name : ''  }}</div>
	</div>
  </div>
  <div class="task-options">
	@if(!$p->trashed())
		  <div class="btn-edit">
			  <a href="{{ route('backOffice.pos.edit', $p->id) }}"><img src="{{ asset('images/backOffice/pos/icon-edit.png') }}"></a>
		  </div>
		  <form action="{{ route('backOffice.pos.destroy', $p->id) }}" method="post">
			  <div class="btn-delete">
				  <input type="hidden" name="_method" value="DELETE">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <img src="{{ asset('images/backOffice/pos/icon-delete.png') }}">
			  </div>
		  </form>
	@else
		  <form action="{{ route('backOffice.pos.restore', $p->id) }}" method="post">
			  <div class="btn-restore">
				  <input type="hidden" name="_method" value="PUT">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <img src="{{ asset('images/backOffice/pos/icon-undo.png') }}">
			  </div>
		  </form>
		  <form action="{{ route('backOffice.pos.destroy', $p->id) }}" method="post">
			  <div class="btn-force-delete">
				  <input type="hidden" name="_method" value="DELETE">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <img src="{{ asset('images/backOffice/order/delete2.png') }}">
			  </div>
		  </form>
	@endif
  </div>
  <div class="point-reward">
	<span>จำนวนแต้มที่ได้รับ</span>
	<div>{{ number_format($p->points) }} คะแนนสะสม</div>
  </div>
</div>
                
              @endforeach
            </div>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="pagination-section">
                <div class="col-md-8">
                  <div class="text">ทั้งหมด <span>{{ number_format($pos->total()) }}</span> รายการ</div>
                </div>
                <div class="col-md-4 text-right">
                  @if(request()->get('search'))
                    {{ $pos->appends(['search' => request()->get('search')])->links('backOffice.pos.pagination') }}
                  @else
                    {{ $pos->links('backOffice.pos.pagination') }}
                  @endif
                </div>
              </div> <!-- /END .pagination-seciton -->
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/pos/index.js') }}"></script>
    <script>
      $(document).ready(function () {

          $('#search-group-addon').click(function () {
              $(this).closest('form').submit()
          });

          $('.btn-delete-select').click(function () {
              let selected = []
              let willDelete = 0
              let willForceDelete = 0
              $('.customer > div > input:checked').each(function() {
                  selected.push($(this).data('id'))
                  if ($(this).data('deleted')) {
                      willForceDelete++
                  } else {
                      willDelete++
                  }
              })

              $('#frmDeleteSelected input').remove()
              $('#frmDeleteSelected').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">')

              $.each(selected, function( index, value ) {
                  $('#frmDeleteSelected').append('<input type="hidden" name="selected[]" value="' + value + '" />')
              })

              var swalText = ""
              if (willDelete > 0 && willForceDelete == 0) {
                  swalText = willDelete + " records will be delete."
              } else if (willDelete == 0 && willForceDelete > 0) {
                  swalText = willForceDelete + " records will be delete forever."
              } else if (willDelete > 0 && willForceDelete > 0) {
                  swalText = willDelete + " records will be delete and " + willForceDelete + " records will be delete forever."
              } else {
                  swalText = "Your selected records will be delete."
              }

              if (selected.length > 0) {
                  if (willForceDelete > 0) {
                      swal({
                          title: 'Are You Sure ?',
                          text: swalText,
                          type: 'warning',
                          confirmButtonColor: '#d60500',
                          showCancelButton: true,
                          confirmButtonText: 'Yes, delete them !'
                      }).then(result => {
                          if (result.value) {
                              $(this).closest('form').submit()
                          }
                      })
                  } else {
                      $(this).closest('form').submit()
                  }
              } else {
                  toastr["warning"]("Please select at least one item to delete !", "Warning");
              }
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
