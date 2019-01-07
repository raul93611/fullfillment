<?php
ConnectionFullFillment::open_connection();
$packing_slip_exists = PackingSlipRepository::packing_slip_exists(ConnectionFullFillment::get_connection(), $id_rfq);
if(!$packing_slip_exists){
  $packing_slip = new PackingSlip('', $id_rfq, '', '', '', '', '');
  $id_packing_slip = PackingSlipRepository::insert_packing_slip(ConnectionFullFillment::get_connection(), $packing_slip);
}
$packing_slip = PackingSlipRepository::get_packing_slip_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
ConnectionFullFillment::close_connection();
if($packing_slip-> get_order_date() == '0000-00-00'){
  $order_date = '';
}else {
  $order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($packing_slip-> get_order_date());
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Packing slip</h1>
        </div>
        <div class="col-sm-10">
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
              <form id="packing_slip_form" action="" method="post">
                <input type="hidden" name="id_rfq" value="<?php echo $packing_slip-> get_id_rfq(); ?>">
                <input type="hidden" name="id_packing_slip" value="<?php echo $packing_slip-> get_id(); ?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="responsible">Responsible:</label>
                      <select class="form-control form-control-sm" name="responsible">
                        <?php
                        ConnectionFullFillment::open_connection();
                        $users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
                        ConnectionFullFillment::close_connection();
                        foreach ($users as $key => $user) {
                          ?>
                          <option value="<?php echo $user-> get_username(); ?>"><?php echo $user-> get_username(); ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="order_date">Order date:</label>
                      <input type="text" name="order_date" id="order_date" class="form-control form-control-sm" value="<?php echo $order_date; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="po">P.O.:</label>
                      <input type="text" name="po" class="form-control form-control-sm" value="<?php echo $packing_slip-> get_po(); ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_contact">Customer contact:</label>
                      <textarea name="customer_contact" rows="5" class="form-control form-control-sm"><?php echo $packing_slip-> get_customer_contact(); ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ship_to">Ship to:</label>
                      <textarea name="ship_to" rows="5" class="form-control form-control-sm"><?php echo $packing_slip-> get_ship_to(); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message">Message:</label>
                      <textarea name="message" rows="5" class="form-control form-control-sm"><?php echo $packing_slip-> get_message(); ?></textarea>
                    </div>
                  </div>
                </div>
              </form>
                <div class="row">
                  <div class="col-md-12">
                    <button type="button" name="button" id="save_packing_slip" class="btn btn-success mb-3"><i class="fas fa-check"></i> Save</button>
                    <div id="packing_slip_items" class="table-responsive">
                      <?php
                      PackingSlipItemRepository::print_packing_slip_items($id_rfq);
                      ?>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer footer_item">
              <a class="btn btn-primary" id="go_back" href="<?php echo EDIT_QUOTE . $packing_slip-> get_id_rfq(); ?>"><i class="fa fa-reply"></i></a>
              <a href="<?php echo PACKING_SLIP_PDF . $packing_slip-> get_id(); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-file"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************MODAL NEW PACKING SLIP SUBITEM*************************************************************-->
<div class="modal fade" id="edit_packing_slip_subitem_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_packing_slip_subitem_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_packing_slip_subitem"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW PACKING SLIP SUBITEM*************************************************************-->
<div class="modal fade" id="edit_packing_slip_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_packing_slip_item_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_packing_slip_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW PACKING SLIP SUBITEM*************************************************************-->
<div class="modal fade" id="new_packing_slip_subitem_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_packing_slip_subitem_form" method="post" action="">
          <input type="hidden" name="id_subitem" value="">
          <input type="hidden" name="id_rfq" value="<?php echo $packing_slip-> get_id_rfq(); ?>">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="unit_type">Unit type:</label>
                  <input type="text" name="unit_type" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="back_order_quantity">Backorder quantity:</label>
                  <input type="number" name="back_order_quantity" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_new_packing_slip_subitem"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW PACKING SLIP ITEM*************************************************************-->
<div class="modal fade" id="new_packing_slip_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_packing_slip_item_form" method="post" action="">
          <input type="hidden" name="id_item" value="">
          <input type="hidden" name="id_packing_slip" value="<?php echo $packing_slip-> get_id(); ?>">
          <input type="hidden" name="id_rfq" value="<?php echo $packing_slip-> get_id_rfq(); ?>">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="unit_type">Unit type:</label>
                  <input type="text" name="unit_type" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="back_order_quantity">Backorder quantity:</label>
                  <input type="number" name="back_order_quantity" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_new_packing_slip_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
