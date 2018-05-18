
@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/allBook/index.css') }}">
@endsection

@section('body')       
<div class="container-fluid page-backoffice-allbook ">
                
    <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="box-header-white clearfix" style="">
                <div class="header-left clearfix" style=" ">
                    <figure style="">

                        <span>
                            <img src="{{asset('images/backOffice/allbook/allbook.png')}}" class="w-100" alt="">
                        </span>

                    </figure>
                    <span class="title">
                       All Book
                    </span>
                </div>
                
            </div>
        </div>
            
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default panel-bg">
                
                <label for="FileInput" style="display:block">
                    <figure class="img-bg">
                        @if( empty($allbook) )
                            <div class="img-preview" style="background-image: url({{asset('images/backOffice/allbook/book01.jpg')}});">
                            
                            </div>
                                @else
                            <div class="img-preview" style="background-image: url({{ getImage( $allbook->allbook_image ) }});">
                            
                            </div>
                        @endif
                    </figure>
                </label>
                <form action="{{ route('backOffice.website.allbook.store') }}" method="post" enctype="multipart/form-data" id="form1">
                    {!! csrf_field() !!}
                    <input type="file" name="FileInput" id="FileInput" style="cursor: pointer;  display: none"/>
                    <div class="button-save">
                        <button type="submit" class="btn ">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>     
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/website/allBook/index.js') }}"></script>
    <script type="text/javascript">

        $(function() {

            $(document).on('change', "#FileInput", function () {
            var files = this.files;
            var elPreview = $('.img-preview');

            if (files.length > 0) {
                var file = files[0];
                var reader = new FileReader();

                reader.onload = function (event) {
                    var loadedFile = event.target;
                    if (file.type.match('image')) {
                        elPreview.css("background-image", "url(" + loadedFile.result + ")");
                    } else {
                        alert('รองรับไฟล์ประเภท รูปภาพ เท่านั้น');
                    }
                }

                reader.readAsDataURL(file);

            } else {
                elPreview.css("background-image", "");
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