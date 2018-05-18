@extends('layouts.website.template')

@section('head')
  
@endsection

@section('body')
<?php
$General = SenseBook\Models\General::select()->orderBy('id', 'desc')->first();
?>
<div class="container-fluid" style="margin-bottom:50px">
    <div style="text-align: center;">
        <h2 style="margin-top: 100px; color: #d2d2d2">
            @if($General->is_maintenance==1)
            Maintenance Shop
            @endif
            @if($General->is_close==1)
            Close Shop
            @endif
        </h2>
        <div class="row">
            <div class="col-12">
                <?php
                if($General->is_maintenance==1){
                    if(!empty($General->maintenance_image)  &&file_exists( storage_path($General->maintenance_image) )){
                        $image = getImage($General->maintenance_image);
                        }else{
                        $image = getImage('images/backOffice/general/test-upload-img.png');
                    } 
                }else if($General->is_close==1){
                    if(!empty($General->close_image)  &&file_exists( storage_path($General->close_image) )){
                        $image = getImage($General->close_image);
                        }else{
                        $image = getImage('images/backOffice/general/test-upload-img.png');
                    } 
                }
                   
                ?>
               
                <img
                src="{{$image}}"
                alt="">
            </div>
        </div>
    </div>
  
</div>
@endsection


