<?php
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $id_subitem);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$packing_slip_subitem = PackingSlipSubitemRepository::get_packing_slip_subitem_by_id_subitem(ConnectionFullFillment::get_connection(), $id_subitem);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_subitem" value="<?php echo $id_subitem; ?>">
<input type="hidden" name="id_rfq" value="<?php echo $item-> obtener_id_rfq(); ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="unit_type">Unit type:</label>
        <input type="text" name="unit_type" class="form-control form-control-sm" value="<?php echo $packing_slip_subitem-> get_unit_type(); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="back_order_quantity">Backorder quantity:</label>
        <input type="number" name="back_order_quantity" class="form-control form-control-sm" value="<?php echo $packing_slip_subitem-> get_back_order_quantity(); ?>">
      </div>
    </div>
  </div>
</div>
