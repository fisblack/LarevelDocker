<?php
use SenseBook\Models\General;
$General = General::select()->first();
// $CheckGeneral = $General ? true : false;
$CheckGeneral = true;


?>
<style>
    .modal-body{
        text-align: center;
    }
</style>

<!-- Order -->
<div id="myModalMaintenance" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Order content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">วิธีการสั้งหนังสือ</h4>
      </div>
      <div class="modal-body">
        <?php
        $name_name = 'order_image';
        if (!empty($General->$name_name) && file_exists( storage_path($General->$name_name) ) && $CheckGeneral) {
            $order_image = getImage($General->$name_name);
        } else {
            $order_image = getImage('images/backOffice/general/test-upload-img-6.png');
        }
        ?>
        <img style="max-width: 100%;"
        src="{{$order_image}}"
        alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Shipment -->
<div id="myModalShipment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Shipment content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">วิธีการจัดส่ง</h4>
      </div>
      <div class="modal-body">
        <?php
        $name_name = 'shipment_image';
        if (!empty($General->$name_name) && file_exists( storage_path($General->$name_name) ) && $CheckGeneral) {
            $shipment_image = getImage($General->$name_name);
        } else {
            $shipment_image = getImage('images/backOffice/general/test-upload-img-6.png');
        }
        ?>
        <img style="max-width: 100%;"
        src="{{$shipment_image}}"
        alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Payment -->
<div id="myModalPayment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Payment content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แจ้งชำระเงิน</h4>
      </div>
      <div class="modal-body">
        <?php
        $name_name = 'payment_image';
        if (!empty($General->$name_name) && file_exists( storage_path($General->$name_name) ) && $CheckGeneral) {
            $payment_image = getImage($General->$name_name);
        } else {
            $payment_image = getImage('images/backOffice/general/test-upload-img-6.png');
        }
        ?>
        <img style="max-width: 100%;"
        src="{{$payment_image}}"
        alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Point -->
<div id="myModalPoint" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Point content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">คะแนนสะสม</h4>
      </div>
      <div class="modal-body">
        <?php
        $name_name = 'point_image';
        if (!empty($General->$name_name) && file_exists( storage_path($General->$name_name) ) && $CheckGeneral) {
            $point_image = getImage($General->$name_name);
        } else {
            $point_image = getImage('images/backOffice/general/test-upload-img-6.png');
        }
        ?>
        <img style="max-width: 100%;"
        src="{{$point_image}}"
        alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Return -->
<div id="myModalReturn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Return content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">นโยบายการคืนหนังสือ</h4>
      </div>
      <div class="modal-body">
        <?php
        $name_name = 'return_image';
        if (!empty($General->$name_name) && file_exists( storage_path($General->$name_name) ) && $CheckGeneral) {
            $return_image = getImage($General->$name_name);
        } else {
            $return_image = getImage('images/backOffice/general/test-upload-img-6.png');
        }
        ?>
        <img style="max-width: 100%;"
        src="{{$return_image}}"
        alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
