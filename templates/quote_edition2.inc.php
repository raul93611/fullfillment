  <?php
  if($quote-> obtener_canal() == 'FedBid'){
    ?>
    <div class="row">
      <div class="col-md-6">
        <label for="total_cost_fedbid">Total cost:</label>
        <input type="number" step=".01" name="total_cost_fedbid" id="total_cost_fedbid" class="form-control form-control-sm" value="<?php echo $quote-> obtener_total_cost(); ?>">
        <input type="hidden" name="" value="">
      </div>
      <div class="col-md-6">
        <label for="total_price_fedbid">Total price:</label>
        <input type="number" step=".01" name="total_price_fedbid" id="total_price_fedbid" class="form-control form-control-sm" value="<?php echo $quote-> obtener_total_price(); ?>">
      </div>
    </div>
    <br>
    <?php
  }
  ?>
  <div class="row">
    <div class="col-md-6">
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
    <div class="col-md-6">
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
    <div class="col-md-6">
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea class="form-control form-control-sm" rows="5" placeholder="Enter address ..." id="address" name="address"><?php echo $quote->obtener_address(); ?></textarea>
          <input type="hidden" name="addres_original" value="<?php echo $quote->obtener_address(); ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label for="ship_to">Ship to:</label>
          <textarea class="form-control form-control-sm" rows="5" placeholder="Enter ship to ..." id="ship_to" name="ship_to"><?php echo $quote->obtener_ship_to(); ?></textarea>
          <input type="hidden" name="ship_to_original" value="<?php echo $quote->obtener_ship_to(); ?>">
        </div>
    </div>
  </div>
  <?php
  if($rfq_fullfillment_part-> get_in_process()){
    ?>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="invoice" class="custom-control-input" id="invoice" value="invoice">
      <label class="custom-control-label" for="invoice">Invoice</label>
    </div>
    <?php
  }else if($quote-> obtener_fullfillment()){
    ?>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="in_process" class="custom-control-input" id="in_process" value="in_process">
      <label class="custom-control-label" for="in_process">In process</label>
    </div>
    <?php
  }
  ?>
</div>
<div class="card-footer footer_item" id="footer_lg">
  <a class="btn btn-primary" id="go_back" href="
  <?php
  if($rfq_fullfillment_part-> get_invoice()){
    echo INVOICES;
  }else if($rfq_fullfillment_part-> get_in_process()){
    echo IN_PROCESS_QUOTES;
  }else if($quote-> obtener_fullfillment()){
    echo RECEIVED_QUOTES;
  }
  ?>
  "><i class="fa fa-reply"></i></a>
  <button type="submit" class="btn btn-success" id="save_item" name="guardar_cambios_cotizacion"><i class="fa fa-check"></i> Save</button>
  <?php
  if($quote-> obtener_canal() != 'FedBid'){
    ?>
    <a class="btn btn-primary add_item_charter" href="<?php echo ADD_ITEM . $quote->obtener_id(); ?>"><i class="fa fa-plus-circle"></i> Add item</a>
    <?php
  }
  ?>
  <button type="button" class="btn btn-primary" id="add_rfq_fullfillment_info"><i class="fas fa-plus"></i> Add info</button>
  <a href="#" id="add_comment" class="btn btn-primary add_item_charter"><i class="fas fa-plus"></i> Add comment</a>
  <div class="btn-group dropup">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-file"></i> Docs
    </button>
    <div class="dropdown-menu">
      <a href="<?php echo NEW_PURCHASE_ORDER . $quote-> obtener_id(); ?>" class="dropdown-item">New P.O.</a>
      <a href="<?php echo NEW_WORK_ORDER . $quote-> obtener_id(); ?>" class="dropdown-item">New work order</a>
    </div>
  </div>
</div>
