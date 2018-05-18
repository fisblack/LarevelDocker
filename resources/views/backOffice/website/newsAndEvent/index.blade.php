{{-- 
    @author: วราทัศน์ พานทองถาวร
    @phone: 087-806-5868
    @email: boss119@hotmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/newsAndEvent/index.css') }}">
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
                            <img src="{{asset('images/backOffice/newsandevent/icon-newsandevent.png')}}" alt="" />News & Events
                        </h4>
                    
                        <div class="panel-heading__delete">
                            <a href="javascript:;" id="delete-all"><img src="{{asset('images/backOffice/preOrder/icon-delete-lg.png')}}" alt="Delete" /></a>
                        </div>
                        <div class="panel-heading__add">
                            <a href="{{action('BackOffice\Website\NewsAndEventController@create')}}"><img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="Add" /></a>
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
                            @foreach($data['newsEvents'] as $news)
                            <div class="records__item {{ $news->deleted_at ? 'records__item--delete' : null }}">
                                <div class="records__check">
                                    <input type="checkbox" name="deleteAll[]" id="{{$news->id}}" class="deleteAll">
                                </div>
                                <div class="records__detail" style="border-right: 1px solid #e4e4e4!important;">
                                    <div class="img hidden-xs">
                                        <!--img src="{{asset('images/backOffice/preOrder/user-3.jpg')}}" alt="Name" /--> 
                                        <img src="{{ getImage($news->user->image)}}" alt="Name" /> 
                                    </div>
                                    <div class="records__description">
                                        <div class="order">
                                            <div class="order__detail">
                                                <div class="order__name__th">
                                                    <span>ชื่อ: </span>
                                                    {{ str_limit($news->title_th, 45) }}
                                                </div>
                                                <div class="order__name__th__description">
                                                    <span>รายละเอียด:</span>
                                                    {!! str_limit($news->short_description_th, 100) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order">
                                            <div class="order__detail">
                                                <div class="order__name__en">
                                                    <span>Name: </span>
                                                    {{ str_limit($news->title_en, 45) }}
                                                </div>
                                                <div class="order__name__en__description">
                                                    <span>Description:</span>
                                                    {!! str_limit($news->short_description_en, 100) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order">
                                            <div class="order__detail">
                                                <div class="order__name__category">
                                                    <span>หมวด: </span>
                                                    {!! $news->category ? $news->category->name_th : '<i style="color: gray;">Unset category</i>' !!}
                                                </div>
                                                <div class="order__date">
                                                    <span>วัน/เดือน/ปี:</span>
                                                    {{ $news->news_events_date }}
                                                </div>
                                                
                                                @if($news->is_show === 0)
                                                    <button class="btn btn-primary btn-md chang_is_show" type="submit"  news_id="{{$news->id}}" name="is_show" value="1">แสดง</button>
                                                @elseif($news->is_show === 1)
                                                    <button class="btn btn-primary btn-md chang_is_show" type="submit"  news_id="{{$news->id}}" style="background-color: #353432;" name="is_show" value="0">ไม่แสดง</button>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="records__action">
                                    <a href="{{ route('backOffice.website.news-and-event.edit', $news->id) }}" class="edit">
                                        <img src="{{asset('images/backOffice/preOrder/icon-edit.png')}}" alt="Edit"/>
                                    </a>
                                    <form action="{{ route('backOffice.website.news-and-event.destroy', $news->id) }}" method="post">
                                        {!! csrf_field() !!}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="delete">
                                            <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
                                        </button>
                                    </form>
                                    <form action="{{ url('backOffice/website/news-and-event/restore') }}" method="POST" class="records__action__refresh">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$news->id}}">
                                        <button class="refresh">
                                            <img src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Refresh"/>
                                        </button>
                                    </form>
                                    <form class="records__action__refresh forceDelete" id="{{$news->id}}">
                                        {!! csrf_field() !!}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="refresh">
                                            <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- End item -->
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Body -->
                    <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <p class="total">
                                ทั้งหมด {{ $data['newsEvents']->total() }} รายการ
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-8 text-right pagination">
                            @if($data['newsEvents']->lastPage() == 1)
                                <ul class="pagination">
                                    <li class="disabled"><span>«</span></li>
                                    <li class="active"><a href="{{ action('BackOffice\Website\NewsAndEventController@index') }}">1</a></li>
                                    <li class="disabled"><span>»</span></li>
                                </ul>
                                @endif
                            @if(isset($_GET['search']))
                            {{ $data['newsEvents']->appends(['search' => $_GET['search']])->links() }}
                            @else
                            {{ $data['newsEvents']->links() }}
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
                </div>
            </div>
        </div>
        
    </div>    
@endsection

@section('script')
<script>
$(document).ready(function(){
    
    $('.chang_is_show').on('click',(e) => {
        var id = $(e.target).attr('news_id');
        var value = $(e.target).attr('value');
        $.ajax({
            type: "PUT",
            url: "{{url('backOffice/website/news-and-event')}}/"+id,
            data:   {
                        is_show                 : value,
                        description_en          : "{!! $news->description_en !!}"
                        description_th          : "{!! $news->description_th !!}",
                        news_events_date        : "{!! $news->news_events_date !!}",
                        short_description_en    : "{!! $news->short_description_en !!}",
                        short_description_th    : "{!! $news->short_description_th !!}",
                        title_en                : "{!! $news->title_en !!}",
                        title_th                : "{!! $news->title_th !!}"
                    },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                console.log(data);
                location.reload();
            }
        });
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
                    url: "{{url('backOffice/website/news-and-event/0?deleteAll=true')}}",
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
                        url: "{{url('backOffice/website/news-and-event/0?deleteAll=true')}}",
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