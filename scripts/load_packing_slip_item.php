<?php
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $id_item);
$packing_slip_item = PackingSlipItemRepository::get_packing_slip_item_by_id_item(ConnectionFullFillment::get_connection(), $id_item);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_item" value="<?php echo $id_item; ?>">
<input type="hidden" name="id_rfq" value="<?php echo $item-> obtener_id_rfq(); ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="unit_type">Unit type:</label>
        <input type="text" name="unit_type" class="form-control form-control-sm" value="<?php echo $packing_slip_item-> get_unit_type(); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="back_order_quantity">Backorder quantity:</label>
        <input type="number" name="back_order_quantity" class="form-control form-control-sm" value="<?php echo $packing_slip_item-> get_back_order_quantity(); ?>">
      </div>
    </div>
  </div>
</div>
