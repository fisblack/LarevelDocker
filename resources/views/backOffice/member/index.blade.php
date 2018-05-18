{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/member/index.css') }}">
@endsection

@section('body')
    <div class="container-back no-gutters-right">
        <div class="members">
            <div class="panel">

                <div class="header">
                    <div class="page-name float-left">
                        <div class="icon float-left">
                            <img src="{{ asset('images/backOffice/member/member.png') }}">
                        </div>
                        <div class="text float-left">
                            Members
                        </div>
                    </div>

                    <div class="delete btn-action float-right border-left">
                        <form action="{{ route('backOffice.member.deleteSelected') }}" method="post" id="frmDeleteSelected">
                            <a href="javascript:void(0);" class="btn-delete-select"> <img src="{{ asset('images/backOffice/member/delete.png') }}"></a>
                        </form>
                    </div>

                    <div class="add btn-action float-right border-left">
                        <a href="{{ route('backOffice.member.create') }}"> <img
                                    src="{{ asset('images/backOffice/member/add.png') }}"></a>
                    </div>

                    <div class="delete btn-action float-right border-left">
                        <form action="{{ route('backOffice.member.print') }}" method="post" id="frmPrint">
                            <a href="javascript:void(0);" class="btn-print"> <img src="{{ asset('images/backOffice/Dashboard/detail.png') }}"></a>
                        </form>
                    </div>

                    <div class="search float-right">
                        <form action="{{ route('backOffice.member.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search" value="{{ (request()->get('search')) ? request()->get('search') : '' }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <img src="{{ asset('images/backOffice/member/search.png') }}">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div> <!-- /END .header -->

                <div class="member-list">

                    @foreach($members as $member)
                        <div class="member-item {{ ($member->trashed()) ? 'is-cancel' : '' }}">
                            <div class="select">
                                <input type="checkbox" data-id="{{ $member->id }}" data-deleted="{{ ($member->trashed()) ? 'true' : 'false' }}">
                            </div>
                            <div class="info">
                                @if($member->image)
                                    <img class="img-circle member-profile-img" src="{{ getImage($member->image)}}">
                                @else
                                    <img class="img-circle member-profile-img" src="{{ asset('images/backOffice/member/user.png') }}">
                                @endif
                                <div class="meta">
                                    <p class="meta-name text-bold"><span
                                                class="text-red">Name:</span> {{ $member->full_name }}</p>
                                    <div class="meta-info">
                                        <p><span class="text-red">Email:</span> {{ $member->email }}</p>
                                        <p><span class="text-red">Phone:</span> {{ $member->phone }}</p>
                                    </div>
                                    <div class="meta-info">
                                        <p>
                                            <span class="text-red">สถานะสมาชิก</span>
                                            <span @if(!$member->trashed()) style="color: green;" @else style="color: red;" @endif>
                                                <b>{{ (!$member->trashed()) ? 'Active' : 'Non Active' }}</b>
                                            </span>
                                        </p>

                                    </div>
                                    @if($member->userClass)
                                        <div class="meta-status">
                                            <span class="type-text">ประเภท</span>
                                            <span class="is-badge" style="background: {{ $member->userClass->color }};">
                                                <i class="fa fa-user"></i> {{ (app()->getLocale() == 'th') ? $member->userClass->name_th : $member->userClass->name_en }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex-align-center flex-column">
                                <div class="date">
                                    <h3>{{ date('d/m/Y', strtotime($member->created_at)) }}</h3>
                                    <span>วันที่สมัคร</span>
                                </div>
                            </div>

                            <div class="flex-align-center flex-column">
                                <div class="status active">
                                    <h3>{{ number_format($member->points_balance) }}</h3>
                                    <span>Point</span>
                                </div>
                            </div>

                            <div class="action">
                                @if(!$member->trashed())
                                    <div class="btn-edit">
                                        <a href="{{ route('backOffice.member.edit', $member->id) }}"><img src="{{ asset('images/backOffice/order/edit.png') }}"></a>
                                    </div>
                                    <form action="{{ route('backOffice.member.destroy', $member->id) }}" method="post">
                                        <div class="btn-delete">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <img src="{{ asset('images/backOffice/order/delete2.png') }}">
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('backOffice.member.restore', $member->id) }}" method="post">
                                        <div class="btn-restore">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <img src="{{ asset('images/backOffice/order/undo.png') }}">
                                        </div>
                                    </form>
                                    @if(Auth::id() != $member->id)
                                        <form action="{{ route('backOffice.member.destroy', $member->id) }}" method="post">
                                            <div class="btn-force-delete">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <img src="{{ asset('images/backOffice/order/delete2.png') }}">
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div> <!-- /END .member-item -->
                    @endforeach

                </div> <!-- /END .member-list -->

                <div class="pagination-section">
                    <div class="col-md-8">
                        <div class="text">ทั้งหมด <span>{{ number_format($members->total()) }}</span> รายการ</div>
                    </div>
                    <div class="col-md-4 text-right">
                        @if(request()->get('search'))
                            {{ $members->appends(['search' => request()->get('search')])->links('backOffice.member.pagination') }}
                        @else
                            {{ $members->links('backOffice.member.pagination') }}
                        @endif
                    </div>
                </div> <!-- /END .pagination-seciton -->

            </div> <!-- /END .panel -->
        </div> <!-- /END .members -->
    </div> <!-- /END .container-back -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                $(this).closest('form').submit()
                return false
            })

            $('.btn-force-delete').click(function () {
                swal({
                    title: 'Are You Sure ?',
                    text: "This member will be delete forever.",
                    type: 'warning',
                    confirmButtonColor: '#d60500',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it !'
                }).then(result => {
                    if (result.value) {
                        $(this).closest('form').submit()
                    }
                });
                return false
            })

            $('.btn-restore').click(function () {
                $(this).closest('form').submit()
                return false
            })

            $('.btn-delete-select').click(function () {
                let selected = []
                let willDelete = 0
                let willForceDelete = 0
                $('.member-item input:checked').each(function() {
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
                    swalText = willDelete + " members will be delete."
                } else if (willDelete == 0 && willForceDelete > 0) {
                    swalText = willForceDelete + " members will be delete forever."
                } else if (willDelete > 0 && willForceDelete > 0) {
                    swalText = willDelete + " members will be delete and " + willForceDelete + " members will be delete forever."
                } else {
                    swalText = "Your selected members will be delete."
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

            $('.btn-restore-select').click(function () {
                let selected = []
                let willRestore = 0
                $('.member-item input:checked').each(function() {
                    selected.push($(this).data('id'))
                    if ($(this).data('deleted')) {
                        willRestore++
                    }
                })

                $('#frmRestoreSelected input').remove()
                $('#frmRestoreSelected').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">')

                $.each(selected, function( index, value ) {
                    $('#frmRestoreSelected').append('<input type="hidden" name="selected[]" value="' + value + '" />')
                })

                if (selected.length > 0) {
                    $(this).closest('form').submit()
                } else {
                    selected = []
                    toastr["warning"]("Please select at least one item to restore !", "Warning");
                }
                return false
            })

            $('.btn-print').click(function () {
                let selected = []
                let willPrint = 0
                $('.member-item input:checked').each(function() {
                    selected.push($(this).data('id'))
                    willPrint++
                })

                $('#frmPrint input').remove()
                $('#frmPrint').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">')

                $.each(selected, function( index, value ) {
                    $('#frmPrint').append('<input type="hidden" name="selected[]" value="' + value + '" />')
                })

                $(this).closest('form').submit()
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
        })
    </script>
@endsection
