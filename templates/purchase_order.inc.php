<?php
ConnectionFullFillment::open_connection();
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
ConnectionFullFillment::close_connection();
if($purchase_order-> get_date() != '0000-00-00'){
  $date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($purchase_order-> get_date());
}else {
  $date = '';
}
if($purchase_order-> get_order_date() != '0000-00-00'){
  $order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($purchase_order-> get_order_date());
}else {
  $order_date = '';
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Purchase order</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-highlighter"></i> Enter the data</h3>
            </div>
            <div class="card-body">
              <form id="purchase_order_form" action="" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="text" name="purchase_order_date" id="date" class="form-control form-control-sm" value="<?php echo $date; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="order_date">Order date:</label>
                      <input type="text" name="order_date" id="order_date" class="form-control form-control-sm" value="<?php echo $order_date; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="purchase_from">Purchase from:</label>
                      <textarea name="purchase_from" rows="5" id="purchase_from" class="form-control form-control-sm"><?php echo $purchase_order-> get_purchase_from(); ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="drop_ship_to">Drop ship to:</label>
                      <textarea name="drop_ship_to" rows="5" id="drop_ship_to" class="form-control form-control-sm"><?php echo $purchase_order-> get_drop_ship_to(); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="purchase_order_comment">Comments:</label>
                      <textarea name="purchase_order_comment" rows="5" id="purchase_order_comment" class="form-control form-control-sm"><?php echo $purchase_order-> get_comments(); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="po_number">P.O.:</label>
                      <input type="text" name="po_number" id="po_number" class="form-control form-control-sm" value="<?php echo $purchase_order-> get_po_number(); ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="ref_quote">REF-Quote:</label>
                      <input type="text" name="ref_quote" id="ref_quote" class="form-control form-control-sm" value="<?php echo $purchase_order-> get_ref_quote(); ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="ship_via">Ship via:</label>
                      <input type="text" name="ship_via" id="ship_via" class="form-control form-control-sm" value="<?php echo $purchase_order-> get_ship_via(); ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="terms">Terms:</label>
                      <input type="text" name="terms" id="terms" class="form-control form-control-sm" value="<?php echo $purchase_order-> get_terms(); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="button" name="button" id="new_purchase_order_item" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div id="purchase_order_items" class="table-responsive">
                      <?php
                      PurchaseOrderItemRepository::print_purchase_order_items($id_purchase_order);
                      ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer footer_item">
              <a class="btn btn-primary" id="go_back" href="#"><i class="fa fa-reply"></i></a>
              <a href="#" target="_blank" class="btn btn-primary"><i class="fas fa-file"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************MODAL NEW PURCHASE ORDER ITEM*************************************************************-->
<div class="modal fade" id="new_purchase_order_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_purchase_order_item_form" method="post" action="">
          <input type="hidden" name="id_purchase_order" value="<?php echo $purchase_order-> get_id(); ?>">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="part_number">Part number:</label>
                  <input type="text" name="part_number" class="form-control form-control-sm" id="part_number" value="">
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity:</label>
                  <input type="number" name="quantity" class="form-control form-control-sm" id="quantity" value="">
                </div>
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea name="description" rows="5" id="description" class="form-control form-control-sm"></textarea>
                </div>
                <div class="form-group">
                  <label for="unit_price">Unit price:</label>
                  <input type="number" step=".01" name="unit_price" id="unit_price" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_new_purchase_order_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW PURCHASE ORDER ITEM*************************************************************-->
<div class="modal fade" id="edit_purchase_order_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_purchase_order_item_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_purchase_order_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL EDIT SHIPMENT COST*************************************************************-->
<div class="modal fade" id="edit_shipment_cost_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_shipment_cost_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_shipment_cost"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
