{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}


@extends('layouts.backOffice.template')

@section('head')
    <!--link rel="stylesheet" href="{{ asset('css/backOffice/project_name/create.css') }}"-->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/userClass/index.css') }}">
@endsection

@section('body')       
<div class="container-fluid page-backoffice-userclass ">
                
    <div class="row">
        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/userclass/userclass.png')}}" class="w-100" alt="">
                        </figure>
                        <span class="title">
                           User Class
                        </span>
                    </div>
                    <div class="header-right clearfix" style=" ">
                        
                        <ul class="nav navbar-top-links navbar-right  ">
                            <li class="m-r-20">
                                <form action="{{route('backOffice.setting.user-class.index')}}" method="GET" id="search" role="search" class="app-search ">
                                    <input type="text" name="search" placeholder="Search..." class="form-control"> 
                                    <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
                                    <a id="btn_search"><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="add" style="">
                                <a href="{{action('BackOffice\Setting\UserClassController@create')}}" style="    ">
                                    <img  src="{{asset('images/backOffice/bankAcc/btn-add.png')}}" alt="Add">
                                </a>
                            </li>
                            <li class="del" style="">
                               
                                <a id="btn_delete_all" style="">
                                    <img src="{{asset('images/backOffice/bankAcc/btn-del.png')}}" alt="Delete">
                                </a>
                                
                            </li>
                            <form action="{{route('backOffice.setting.user-class.delete-all')}}" method="POST" id="form_delete_all">
                                 {!! csrf_field() !!}

                                 <input id="ar_delete_all" name="ar_delete_all" type="hidden" value="">
                                 <input id="check_force" name="check_force" type="hidden" value="">
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        
                        <tbody>
                        @foreach($UserClasss as $index => $UserClass)
                        
                            <tr class="@if($UserClass->deleted_at) records__item--delete @endif">
                                <td class="first" >
                                    <input type="checkbox" name="bank[]" UseForce="@if($UserClass->deleted_at) true @endif"  value="{{$UserClass->id}}" id="bank_1">
                                </td>
                                <td class="second" style="">
                                    
                                    <ul class="list-unstyled" >
                                        <!-- <li>
                                            <div class="box-box">
                                                <strong>Class TH :</strong>
                                                <div class="box-class" style="background-color :{{ $UserClass->color }}">
                                                    <i class="fa fa-user"></i>
                                                    {{$UserClass->name_th}}
                                                </div>
                                            </div>
                                        </li> -->
                                        <li>
                                            <div class="box-box">
                                                <strong>Class :</strong>
                                                <div class="box-class" style="background-color :{{ $UserClass->color }}">
                                                    <i class="fa fa-user"></i>
                                                    {{$UserClass->name_en}}
                                                </div> 
                                                 /
                                                <div class="box-class" style="background-color :{{ $UserClass->color }}">
                                                    <i class="fa fa-user"></i>
                                                    {{$UserClass->name_th}}
                                                </div>
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <strong>Class EN :</strong>
                                            <span>
                                                <div class="box-class" style="background-color :{{ $UserClass->color }}">
                                                    <i class="fa fa-user"></i>
                                                    {{$UserClass->name_en}}
                                                </div>
                                            </span>
                                        </li> -->
                                        <li>
                                            <strong>ยอดซื้อขั้นต่ำ</strong>
                                            <span>: {{$UserClass->minimum_purchase}} บาท/ปี</span>
                                            
                                        </li>
                                        <li>
                                            <strong>ส่วนลด</strong>
                                            <span>: {{$UserClass->discount}}
                                            @if($UserClass->discount_type =="Bath")
                                                บาท
                                            @else
                                                {{ $UserClass->discount_type }}
                                            @endif
                                            </span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        
                                        @if($UserClass->deleted_at)
                                        <form id="form_restore{{ $UserClass->id }}" action="{{ route('backOffice.setting.user-class.restore',$UserClass->id) }}" method="post">
                                            {!! csrf_field() !!}    
                                            {!! method_field('patch') !!}
                                            <!-- <li style=" " onclick=""  > -->
                                                <a onclick="FnRestore({{ $UserClass->id }})" style=" ">
                                                    <img style="" src="{{asset('images/backOffice/order/undo.png')}}" alt="Undo">
                                                </a>
                                                <!-- <img src="{{asset('images/backOffice/order/undo.png')}}" > -->
                                            <!-- <li> -->
                                        </form>
                                        
                                            
                                        
                                        @else
                                            <li style=" ">
                                            <a href="{{ route('backOffice.setting.user-class.edit',  $UserClass->id) }}" style="    ">
                                                <img style="" src="{{asset('images/backOffice/bankAcc/edit.png')}}" alt="Edit">
                                            </a>
                                            </li>
                                            
                                            
                                        @endif
                                            <form id="delete{{ $UserClass->id }}" action="{{ route('backOffice.setting.user-class.destroy',$UserClass->id) }}"
                                            UseForce="@if($UserClass->deleted_at) true @endif"
                                             method="post">
                                                {!! csrf_field() !!}
                                                {!! method_field('delete') !!}
                                                @if($UserClass->deleted_at) 
                                                    <input type="hidden" name='UseForce' value="true">
                                                @endif
                                                
                                                <li style="">
                                                    <a onclick="FnDelete({{ $UserClass->id }})" style=" ">
                                                        <img style="" src="{{asset('images/backOffice/bankAcc/bin.png')}}" alt="Delete">
                                                    </a>
                                                </li>
                                            </form>
                                    </ul>
                                </td>
                                
                            </tr>
                        @endforeach

                            <!-- <tr>
                                <td class="first" >
                                    <input type="checkbox" name="bank[]" value="1" id="bank_1">
                                </td>
                                <td class="second" style="">
                                    
                                    <ul class="list-unstyled" >
                                        <li>
                                            <strong>Class</strong>
                                            <span>: xxxxxxx</span>
                                        </li>
                                        <li>
                                            <strong>ยอดซื้อขั้นต่ำ</strong>
                                            <span>: 888 บาท/ปี</span>
                                            
                                        </li>
                                        <li>
                                            <strong>ส่วนลด</strong>
                                            <span>: 10 %</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <a href="#" style="    ">
                                                <img style="" src="{{asset('images/backOffice/bankAcc/edit.png')}}" alt="Edit">
                                            </a>
                                        </li>
                                        <li style="">
                                            <a href="#" style=" ">
                                                <img style="" src="{{asset('images/backOffice/bankAcc/bin.png')}}" alt="Delete">
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                
                            </tr> -->
                            
                            
                        </tbody>
                    </table>
                    
                </div>
                
                <div class="pagination-detail clearfix">
                    
                    <div class="col-xs-12 col-sm-4 left">
                        <p style="">
                            ทั้งหมด {{$UserClasss->total()}} รายการ
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-8 right">
                        {{ $UserClasss->links('backOffice.setting.userClass.pagination') }}
                        <!-- <nav>
                            <ul class="pagination" style="    ">
                                
                                <li class="active">
                                    <a href="#">1</a>
                                </li>
                                
                                
                            </ul>
                        </nav> -->
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    
</div>   

@endsection

@section('script')
    <script>
        $('#btn_search').click(function(){
            $('#search').submit()
        })
        
        $('#btn_delete_all').click(function(){
            let ar_delete_all = []
            let check_force =[]
            $("input[name='bank[]']:checked").each( function () {
                ar_delete_all.push($(this).val())
                if($(this).attr('UseForce')) {
                    check_force.push(true)
                }else{
                    check_force.push(false)
                }
                // $('#ar_delete_all').val()
                // $('#check_force').val()
                
            });
            
            // console.log(ar_delete_all)
            // $('#ar_delete_all').val(ar_delete_all)
            //     $('#check_force').val(check_force)
            $('#ar_delete_all').val(ar_delete_all)
            $('#check_force').val(check_force)
            if(ar_delete_all.length >0){
                if(check_force.indexOf(true)>=0){
                    

                    swal({
                    title: 'Are You Sure ?',
                    text: "Do you want to force delete?",
                    type: 'warning',
                    confirmButtonColor: '#d60500',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $('#form_delete_all').submit()
                        }
                    });
                    // console.log("มี")
                    
                    
                }else{
                    $('#form_delete_all').submit()
                }
                
            }
           
            
        })
        function FnDelete(id){
            if($('#delete'+id).attr('UseForce')){
                swal({
                title: 'Are You Sure ?',
                text: "มีข้อมูลที่จะถูกลบถาวร!!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $('#delete'+id).submit()
                    }
                });
            }else{
                $('#delete'+id).submit()
            }
            // console.log($('#delete'+id).attr('UseForce'))
        }
        function FnRestore(id){
            $('#form_restore'+id).submit()
        }

        
        $( document ).ready(function() {
            var width = 0;
            console.log( "ready!" );
            // setTimeout(() => {
            //     $('.box-class').each(function( index ) {
                    
            //         if($( this ).outerWidth() > width ){
            //             width = $( this ).outerWidth()
            //         }
            //         console.log( index + ": " + $( this ).outerWidth() );
            //     });
            //     width = width+5
            //     $('.box-class').each(function( index ) {
            //         $( this ).css('width' , width)
                    
            //     });
            //     console.log(width)
            // }, 3000);
            // console.log()
            // 
            
            
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

        
    </script>
    <!--script src="{{ asset('js/backOffice/project_name/create.js') }}"></script-->
@endsection