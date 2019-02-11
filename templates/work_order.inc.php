<?php
ConnectionFullFillment::open_connection();
$work_order = WorkOrderRepository::get_work_order_by_id(ConnectionFullFillment::get_connection(), $id_work_order);
ConnectionFullFillment::close_connection();
if($work_order-> get_date() != '0000-00-00'){
  $date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($work_order-> get_date());
}else {
  $date = '';
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Work order</h1>
        </div>
        <div class="col-sm-10">
          <a href="<?php echo DELETE_WORK_ORDER . $work_order-> get_id(); ?>" class="btn btn-danger float-right"><i class="fas fa-trash"></i></a>
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
              <form id="work_order_form" action="" method="post">
                <input type="hidden" name="id_work_order" value="<?php echo $work_order-> get_id(); ?>">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="responsible">Responsible:</label>
                      <select class="form-control form-control-sm" name="responsible">
                        <?php
                        ConnectionFullFillment::open_connection();
                        $users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
                        ConnectionFullFillment::close_connection();
                        foreach ($users as $key => $user) {
                          ?>
                          <option <?php if($work_order-> get_responsible() == $user-> get_username()){echo 'selected';} ?>  value="<?php echo $user-> get_username(); ?>"><?php echo $user-> get_username(); ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="doc_name">Document name:</label>
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <div class="input-group-text">WORK ORDER: <?php echo $work_order-> get_id_rfq(); ?> - </div>
                        </div>
                        <input type="text" class="form-control form-control-sm" name="doc_name" value="<?php echo $work_order-> get_doc_name(); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">Phone:</label>
                      <input type="text" name="phone" value="<?php echo $work_order-> get_phone(); ?>" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                      <label for="bpa">BPA:</label>
                      <input type="text" name="bpa" value="<?php echo $work_order-> get_bpa(); ?>" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <textarea name="address" rows="5" class="form-control form-control-sm"><?php echo $work_order-> get_address(); ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company">Company:</label>
                      <input type="text" name="company" value="<?php echo $work_order-> get_company(); ?>" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="text" name="date" id="date" value="<?php echo $date; ?>" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                      <label for="client">Client:</label>
                      <textarea name="client" rows="5" class="form-control form-control-sm"><?php echo $work_order-> get_client(); ?></textarea>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-md-12 mb-2">
                  <button type="button" id="save_work_order" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="button" id="new_work_order_item_button" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <div id="work_order_items" class="table-responsive">
                    <?php
                    WorkOrderItemRepository::print_work_order_items($id_work_order);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer footer_item">
              <a class="btn btn-primary" id="go_back" href="<?php echo EDIT_QUOTE . $work_order-> get_id_rfq(); ?>"><i class="fa fa-reply"></i></a>
              <a href="<?php echo WORK_ORDER_PDF . $work_order-> get_id(); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-file"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************MODAL EDIT WORK ORDER ITEM*************************************************************-->
<div class="modal fade" id="edit_work_order_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_work_order_item_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_work_order_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW WORK ORDER ITEM DETAIL*************************************************************-->
<div class="modal fade" id="edit_work_order_item_detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_work_order_item_detail_form" method="post" action="">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_edit_work_order_item_detail"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW WORK ORDER ITEM DETAIL*************************************************************-->
<div class="modal fade" id="new_work_order_item_detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_work_order_item_detail_form" method="post" action="">
          <input type="hidden" name="id_work_order" value="<?php echo $work_order-> get_id(); ?>">
          <input type="hidden" name="id_work_order_item" id="id_work_order_item" value="">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="detail_name">Detail name:</label>
                  <input type="text" name="detail_name" class="form-control form-control-sm" value="">
                </div>
                <div class="form-group">
                  <label for="detail">Detail:</label>
                  <input type="text" name="detail" class="form-control form-control-sm" value="">
                </div>
                <div class="form-group">
                  <label for="keycode">Keycode:</label>
                  <input type="text" name="keycode" class="form-control form-control-sm" value="">
                </div>
                <div class="form-group">
                  <label for="notes">Notes:</label>
                  <input type="text" name="notes" class="form-control form-control-sm" value="">
                </div>
                <div class="form-group">
                  <label for="technitian">Technitian:</label>
                  <input type="text" name="technitian" class="form-control form-control-sm" value="">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_new_work_order_item_detail"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL NEW WORK ORDER ITEM*************************************************************-->
<div class="modal fade" id="new_work_order_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_work_order_item_form" method="post" action="">
          <input type="hidden" name="id_work_order" value="<?php echo $work_order-> get_id(); ?>">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="equipment">Equipment:</label>
                  <textarea name="equipment" rows="5" class="form-control form-control-sm"></textarea>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="save_new_work_order_item"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
