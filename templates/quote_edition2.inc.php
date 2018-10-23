  <?php
  if($quote-> obtener_canal() == 'FedBid'){
    ?>
    <div class="row">
      <div class="col-12">
        <label for="total_price">Total price:</label>
        <input type="number" step=".01" name="total_price_fedbid" class="form-control form-control-sm" value="<?php echo $quote-> obtener_total_price(); ?>">
      </div>
    </div>
    <br>
    <?php
  }
  ?>
  <div class="row">
    <div class="col">
      <div class="form-group">
          <label for="completed_date">Completed date:</label>
          <input type="text" class="form-control form-control-sm" disabled id="completed_date" name="completed_date"
          <?php
          $hoy = getdate();
          $fecha_default = $hoy['mon'] . '/' . $hoy['mday'] . '/' . $hoy['year'];
          if($quote->obtener_fecha_completado() != '0000-00-00'){
            $fecha_completado_formato = date('m/d/Y', strtotime($quote->obtener_fecha_completado()));
            echo 'value="' . $fecha_completado_formato . '"';
          }else{

            echo 'value="' . $fecha_default . '"';
          }
          ?>>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
          <label for="expiration_date">Expiration date:</label>
          <input type="text" class="form-control form-control-sm" disabled id="expiration_date" name="expiration_date"
          <?php
          if($quote->obtener_expiration_date() != '0000-00-00'){
            $expiration_date_formato = date('m/d/Y', strtotime($quote->obtener_expiration_date()));
            echo 'value="' . $expiration_date_formato . '"';
          }else{
            echo 'value="' . $fecha_default . '"';
          }
          ?>>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="ship_via">Ship via:</label>
    <select id="ship_via" class="form-control form-control-sm" disabled name="ship_via">
      <option <?php if ($quote->obtener_ship_via() == 'GROUND') { echo 'selected';} ?>>GROUND</option>
      <option <?php if ($quote->obtener_ship_via() == 'BEST WAY') { echo 'selected';} ?>>BEST WAY</option>
    </select>
  </div>
  <div class="row">
    <div class="col">
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea class="form-control form-control-sm" rows="5" placeholder="Enter address ..." id="address" name="address"><?php echo $quote->obtener_address(); ?></textarea>
          <input type="hidden" name="addres_original" value="<?php echo $quote->obtener_address(); ?>">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
          <label for="ship_to">Ship to:</label>
          <textarea class="form-control form-control-sm" rows="5" placeholder="Enter ship to ..." id="ship_to" name="ship_to"><?php echo $quote->obtener_ship_to(); ?></textarea>
          <input type="hidden" name="ship_to_original" value="<?php echo $quote->obtener_ship_to(); ?>">
        </div>
    </div>
  </div>
</div>
<div class="card-footer footer_item">
  <a class="btn btn-primary" id="go_back" href="<?php echo RFQ_TEAM; ?>"><i class="fa fa-reply"></i></a>
  <button type="submit" class="btn btn-success" id="save_item" name="guardar_cambios_cotizacion"><i class="fa fa-check"></i> Save</button>
  <?php
  if($quote-> obtener_canal() != 'FedBid'){
    ?>
    <a class="btn btn-primary add_item_charter" href="<?php echo ADD_ITEM . $quote->obtener_id(); ?>"><i class="fa fa-plus-circle"></i> Add item</a>
    <?php
  }
  ?>
  <button type="button" class="btn btn-primary" id="add_rfq_fullfillment_info"><i class="fas fa-plus"></i> Add info</button>
  <a href="<?php echo PDF_ITEMS_TABLE . $quote-> obtener_id(); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-file"></i> PDF</a>
  <a href="#" id="add_comment" class="btn btn-primary add_item_charter"><i class="fas fa-plus"></i> Add comment</a>
</div>
