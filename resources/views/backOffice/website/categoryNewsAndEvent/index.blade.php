{{-- 
    @author: วราทัศน์ พานทองถาวร
    @phone: 087-806-5868
    @email: boss119@hotmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/categoryNewsAndEvent/index.css') }}">
@endsection

@section('body')       
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading--action">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>
                                    <img src="{{asset('images/backOffice/categorynewsandevent/icon-categorynewsandevent.png')}}" alt="" />Category News & Events
                                </h4>
                            
                                <div class="panel-heading__delete">
                                    <a href="javascript:;" id="delete-all"><img src="{{asset('images/backOffice/preOrder/icon-delete-lg.png')}}" alt="Delete" /></a>
                                </div>
                                <div class="panel-heading__add">
                                    <a href="{{action('BackOffice\Website\CategoryNewsAndEventController@create')}}"><img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="Add" /></a>
                                </div>
                                <div class="panel-heading__search">
                                    <form action="" method="get" class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." @if(isset($_GET['search'])) value="{{$_GET['search']}}" @endif>
                                        <div class="input-group-addon">
                                            <button>
                                                <img src="{{asset('images/backOffice/preOrder/icon-search.png')}}" alt="" />
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="records table-responsive">
                                    @if(!empty($data['categoriesNews']->count()))
                                    @foreach($data['categoriesNews'] as $category)
                                    <div class="records__item @if($category->deleted_at) records__item--delete @endif">
                                        <div class="records__check">
                                            <input type="checkbox" name="deleteAll[]" id="{{$category->id}}" class="deleteAll">
                                        </div>
                                        <div class="records__detail" style="border-right: 1px solid #e4e4e4!important;">
                                            <div class="order">
                                                <div class="order__detail">
                                                    <div class="order__name__th">
                                                        <span>ชื่อ: </span>
                                                        {!! $category->name_th !!}
                                                    </div>
                                                    <div class="order__name__en">
                                                        <span>Name: </span>
                                                        {!! $category->name_en !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="records__action">
                                            <a href="{{ route('backOffice.website.category-news-and-event.edit', $category->id) }}" class="edit">
                                                <img src="{{asset('images/backOffice/preOrder/icon-edit.png')}}" alt="Edit"/>
                                            </a>
                                            <form action="{{ route('backOffice.website.category-news-and-event.destroy', $category->id) }}" method="post" id="delete">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="delete">
                                                    <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
                                                </button>
                                            </form>
                                            <form action="{{ url('backOffice/website/category-news-and-event/restore') }}" method="POST" class="records__action__refresh">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$category->id}}">
                                                <button class="refresh">
                                                    <img src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Refresh"/>
                                                </button>
                                            </form>
                                            <form class="records__action__refresh forceDelete" id="{{$category->id}}">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="refresh">
                                                    <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    ว่างเปล่า
                                    @endif 
                                    <!-- End item -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Body -->

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <p class="total">
                                    ทั้งหมด {{ $data['categoriesNews']->total() }} รายการ
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-8 text-right pagination">
                                @if($data['categoriesNews']->lastPage() == 1)
                                <ul class="pagination">
                                    <li class="disabled"><span>«</span></li>
                                    <li class="active"><a href="{{ action('BackOffice\Website\CategoryNewsAndEventController@index') }}">1</a></li>
                                    <li class="disabled"><span>»</span></li>
                                </ul>
                                @endif
                                @if(isset($_GET['search']))
                                {{ $data['categoriesNews']->appends(['search' => $_GET['search']])->links() }}
                                @else
                                {{ $data['categoriesNews']->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->
            </div>
        </div>
    </div> 
@endsection

@section('script')
    <!-- <script src="{{ asset('js/backOffice/project_name/create.js') }}"></script> -->
delete-all
<script>
$(document).ready(function(){
    $('.forceDelete').on('submit',(ev) => {
        swal({
            title: 'Are You Sure ?',
            text: "มีข้อมูลที่จะถูกลบถาวร!!",
            type: 'warning',
            confirmButtonColor: '#d60500',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then( result => {
            console.log('ev.target.id', ev.target.id)
            if(result.value){
                $.ajax({
                    type: "DELETE",
                    url: "{{url('backOffice/website/category-news-and-event/0?deleteAll=true')}}",
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
                        url: "{{url('backOffice/website/category-news-and-event/0?deleteAll=true')}}",
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
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr["error"]("{{ $error }}", "Error");
        @endforeach
    @endif
});
</script>
@endsection