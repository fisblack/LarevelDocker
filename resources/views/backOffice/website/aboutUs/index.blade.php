{{-- 
    @author: Napat Maipaiboon
    @phone: 0873589259
    @email: elecwebmaker@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/aboutUs/index.css') }}">
@endsection

@section('body')       
<form action="{{ route('backOffice.website.about-us.store') }}" method="post" enctype="multipart/form-data" id="form1">
    <div class="container-fluid">
        <section class="wrapper container">
            <header class="header row">
                <h2> About Us</h2>
            </header>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="section section-head row">
                <h3> Head </h3>
                <div>
                    <div class="row"> 
                        <section class="head_image col-lg-6">
                            <div class="image_uploader">
                                <i>
                                    <div class="file_upload">
                                        <div >
                                            <label for="image_head">Image Head</label>
                                        </div>
                                        <div >
                                            <div class="input_upload">
                                                <label class="browse_btn">
                                                    <input type="file" id="image_head" name="image_head" />
                                                    Browse
                                                </label>
                                                <div class="name_display">
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="error_empty_img">
                                                <p id="headImgEmpty" class="error_empty_img_txt">กรุณาเลือกรูป</p>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                                <i>
                                    <div class="image_preview col-lg-9 col-md-offset-3">
                                        <p>My Image:</p>
                                        @if(file_exists(storage_path($aboutUs->image_head)) && !empty($aboutUs->image_head))
                                            <img id="headImg" class="image-container" src="{{getImage($aboutUs->image_head)}}" alt="">
                                        @else
                                            <img id="headImg" class="image-container"></img>
                                        @endif
                                    </div>
                                </i>
                            </div>
                        </section>
                        <section class="head_descript col-lg-6">
                            <div class="textarea_field">
                                <label for="head_descirpt" class="col-lg-3">Head Descript</label>
                                <div>
                                    <textarea id="head_descirpt" name="head_descirpt">@if (isset($aboutUs)){{ $aboutUs->head_description }}@endif</textarea>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            <section class="section section-aboutus row">
                <h3> About Us</h3>
                <div>
                    <div class="row">
                        <section class="title col-lg-12">
                            <div class="text-field ">
                                <div class="col-lg-3">
                                    <label for="title">Title</label>
                                </div>
                                <div class="col-lg-9"> 
                                    <input type="text" id="title" name="title" @if (isset($aboutUs)) value="{{ $aboutUs->title }}" @endif required>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section class="portion portion_one col-lg-6">
                            <section class="cover_image">
                            <div class="image_uploader">
                                <i>
                                    <div class="file_upload">
                                        <div class="col-lg-3">
                                            <label for="image_head">Image 1</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="input_upload">
                                                <label class="browse_btn">
                                                    <input type="file" id="image_1" name="image_1"/>
                                                    Browse
                                                </label>
                                                <div class="name_display">
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="error_empty_img">
                                                <p id="imgOneEmpty" class="error_empty_img_txt">กรุณาเลือกรูป</p>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                                <i>
                                    <div class="image_preview col-lg-9 col-md-offset-3">
                                        <p>My Image:</p>
                                        @if(file_exists(storage_path($aboutUs->image_1)) && !empty($aboutUs->image_1))
                                            <img id="imgOne" class="image-container" src="{{getImage($aboutUs->image_1)}}" alt="">
                                        @else
                                            <img id="imgOne" class="image-container"></img>
                                        @endif
                                    </div>
                                </i>
                            </div>
                            </section>
                            <section class="detail col-lg-12">
                                <div class="textarea_field">
                                    <label for="detail_one" class="col-lg-3 thaifont">รายละเอียด1</label>
                                    <div>
                                        <textarea id="detail_one" name="detail_one">@if (isset($aboutUs)){{ $aboutUs->description_1 }}@endif</textarea>
                                    </div>
                                </div>
                            </section>
                        </section>
                        <section class="portion portion_two col-lg-6">
                            <section class="cover_image">
                                <div class="image_uploader">
                                    <i>
                                        <div class="file_upload">
                                            <div class="col-lg-3">
                                                <label for="image_head">Image 2</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="input_upload">
                                                    <label class="browse_btn">
                                                        <input type="file" id="image_2" name="image_2"/>
                                                        Browse
                                                    </label>
                                                    <div class="name_display">
                                                        <span></span>
                                                    </div>
                                                </div>
                                                <div class="error_empty_img">
                                                    <p id="imgTwoEmpty" class="error_empty_img_txt">กรุณาเลือกรูป</p>
                                                </div>
                                            </div>
                                        </div>
                                    </i>
                                    <i>
                                        <div class="image_preview col-lg-9 col-md-offset-3">
                                            <p>My Image:</p>
                                            @if(file_exists(storage_path($aboutUs->image_2)) && !empty($aboutUs->image_2))
                                                <img id="imgTwo" class="image-container" src="{{getImage($aboutUs->image_2)}}" alt="">
                                            @else
                                                <img id="imgTwo" class="image-container"></img>
                                            @endif
                                        </div>
                                    </i>
                                </div>
                            </section>
                            <section class="detail col-lg-12">
                                <div class="textarea_field">
                                    <label for="detail_two" class="col-lg-3 thaifont">รายละเอียด2</label>
                                    <div>
                                        <textarea id="detail_two" name="detail_two">@if (isset($aboutUs)){{ $aboutUs->description_2 }}@endif</textarea>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </div>
                    <div class="row"> 
                        <section class="writer col-lg-12">
                            <span class="thaifont"> นักเขียน</span>
                            <ul id="imageUl" class="writer_list col-lg-9">
                                <div id="writer_image_div" class="writer_upload">
                                    <input id="writer_image_input0" type="file" class="upload_input" />
                                </div>
                                <div id="imageDiv">
                                @if (isset($aboutUsWriters))
                                @foreach($aboutUsWriters as $key => $aboutUsWriter)
                                    <a href="javascript:void(0)" onclick="removeWriter(this)" class="writer_img_a">
                                        <img id="oldWriterImg" name="oldWriterImg" class="writer_item" src="{{getImage($aboutUsWriter->writer_image)}}" />
                                        <input type="text"
                                            id="{{'writer_image_input'.($key+1)}}"
                                            class="upload_input"
                                            name="old_writer_image_input_hidden[]"
                                            value="{{$aboutUsWriter->writer_image}}" />
                                    </a>
                                @endforeach
                                @endif
                                </div>
                                <label for="writer_image_input0">
                                    <li for="writer_image_input0" class="item_add" for="addWriter"></li>
                                </label>
                            </ul>
                        </section>
                    </div>
                </div>
            </section>

            <section class="section section-footer row">
                <div>
                    <div class="row">
                        <section class="footer_box col-lg-12">
                            <div class="textarea_field">
                                <label for="foot_descirpt" class="thaifont">Footer</label>
                                <div class="head_descript col-lg-9">
                                    <textarea id="foot_descirpt" name="foot_descirpt">@if (isset($aboutUs)){{ $aboutUs->footer }}@endif</textarea>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            <section class="section btn-container">
                <button class="edit_btn" type="button" onclick="checkEmptyImg()">Save</button>
                <button class="cancel_btn" type="button" onclick="reloadPage()">Cancel</button>
                <button class="edit_btn_hidden" id="edit_btn_hidden" type="submit">Save</button>
            </section>
        </section>
    </div>      
</form>
@endsection

@section('script')
<script src="{{ asset('js/backOffice/website/aboutUs/index.js') }}"></script>
<script type="text/javascript">
    function checkEmptyImg(){
        var elemHeadImg = document.getElementById('headImg');
        var elemImgOne = document.getElementById('imgOne');
        var elemImgTwo = document.getElementById('imgTwo');
        var countEmpty = 0;
        if(elemHeadImg.getAttribute('src') === null) {
            document.getElementById("headImgEmpty").style.display = "block";
            countEmpty++;
        } else {
            document.getElementById("headImgEmpty").style.display = "none";
        }
        if(elemImgOne.getAttribute('src') === null) {
            document.getElementById("imgOneEmpty").style.display = "block";
            countEmpty++;
        } else {
            document.getElementById("imgOneEmpty").style.display = "none";
        }
        if(elemImgTwo.getAttribute('src') === null) {
            document.getElementById("imgTwoEmpty").style.display = "block";
            countEmpty++;
        } else {
            document.getElementById("imgTwoEmpty").style.display = "none";
        }

        if (countEmpty === 0) document.getElementById('edit_btn_hidden').click();
    }
    
    function removeWriter(param){
        param.remove();
    }

    function reloadPage(){
        location.reload();
    }

    $(document).ready(function(){

        function setPreviewImg(input, id) {
            console.log("input", input.files)
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_head").change(function() {
            setPreviewImg(this, '#headImg');
        });

        $("#image_1").change(function() {
            setPreviewImg(this, '#imgOne');
        });

        $("#image_2").change(function() {
            setPreviewImg(this, '#imgTwo');
        });

        var num_of_writer = 0;

        $('#writer_image_div').on('change','#writer_image_input0' , function(){ addWriterImage(); });

        function addWriterImage(){
            var el_writer = $('<a href="javascript:void(0)" onclick="removeWriter(this)" class="writer_img_a"><img id="writerImg" class="writer_item" /></a>');
            $("#imageDiv").append(el_writer);
            num_of_writer++;

            var input = document.getElementById("writer_image_input0");

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    el_writer.find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

            // get the last DIV which ID starts with ^= "klon"
            var $inputFirst = $('input[id^="writer_image_input"]:first');
            var $inputLast = $('input[id^="writer_image_input"]:last');
            var $writerImgLast = $('img[id^="writerImg"]:last');

            // Read the Number from that DIV's ID (i.e: 3 from "klon3")
            // And increment that number by 1
            var num = parseInt($inputLast.prop("id").match(/\d+/g), 10) +1;
            console.log($inputLast);
            // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
            var $klon = $inputFirst.clone()
                .prop('id', 'writer_image_input'+num )
                .prop('name', 'writer_image_input_hidden[]')
                .prop('style', 'display: none');

            // Finally insert $klon wherever you want
            $writerImgLast.after($klon);

            document.getElementById("writer_image_input0").value = "";
        }

        // $("img")
        //     .mouseover(function() { 
        //         var src = $(this).attr("src").match(/[^\.]+/) + "https://i.stack.imgur.com/OjsXZ.png";
        //         $(this).attr("src", src);
        //     })
        //     .mouseout(function() {
        //         var src = $(this).attr("src").replace("over", "");
        //         $(this).attr("src", src);
        //     });
    });

</script>
<script>
    $(function() {
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
    $('input,textarea').focus(function(){

$(this).css('color','black');
});
    });
</script>
@endsection
