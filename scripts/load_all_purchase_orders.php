<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Purchase orders</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="list-group">
        <?php
        ConnectionFullFillment::open_connection();
        $purchase_orders = PurchaseOrderRepository::get_all_purchase_orders_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
        if(count($purchase_orders)){
          foreach ($purchase_orders as $key => $purchase_order) {
            ?>
            <a href="<?php echo PURCHASE_ORDER . $purchase_order-> get_id(); ?>" class="list-group-item list-group-item-action">
              <?php
              if(empty($purchase_order-> get_po_number())){
                echo 'New';
              }else {
                echo 'P.O.: ' . $purchase_order-> get_po_number();
              }
              ?>
            </a>
            <?php
          }
        }else {
          ?>
          <h3 class="text-danger text-center"><i class="fas fa-times"></i> No purchase orders!</h3>
          <?php
        }
        ConnectionFullFillment::close_connection();
        ?>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
    </div>
  </div>
</div>
