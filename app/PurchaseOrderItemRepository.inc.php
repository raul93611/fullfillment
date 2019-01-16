<?php
class PurchaseOrderItemRepository{
  public static function insert_purchase_order_item($connection, $purchase_order_item){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO purchase_order_items(id_purchase_order, part_number, quantity, description, unit_price, amount) VALUES(:id_purchase_order, :part_number, :quantity, :description, :unit_price, :amount)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order', $purchase_order_item-> get_id_purchase_order(), PDO::PARAM_STR);
        $sentence-> bindParam(':part_number', $purchase_order_item-> get_part_number(), PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $purchase_order_item-> get_quantity(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $purchase_order_item-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_price', $purchase_order_item-> get_unit_price(), PDO::PARAM_STR);
        $sentence-> bindParam(':amount', $purchase_order_item-> get_amount(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_purchase_order_item($connection, $id_purchase_order_item){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM purchase_order_items WHERE id = :id_purchase_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order_item', $id_purchase_order_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_purchase_order_item_by_id($connection, $id_purchase_order_item){
    $purchase_order_item = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM purchase_order_items WHERE id = :id_purchase_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order_item', $id_purchase_order_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $purchase_order_item = new PurchaseOrderItem($result['id'], $result['id_purchase_order'], $result['part_number'], $result['quantity'], $result['description'], $result['unit_price'], $result['amount']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $purchase_order_item;
  }

  public static function update_purchase_order_item($connection, $id_purchase_order_item, $part_number, $quantity, $description, $unit_price, $amount){
    if(isset($connection)){
      try{
        $sql = 'UPDATE purchase_order_items SET part_number = :part_number, quantity = :quantity, description = :description, unit_price = :unit_price, amount = :amount WHERE id = :id_purchase_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':part_number', $part_number, PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':description', $description, PDO::PARAM_STR);
        $sentence-> bindParam(':unit_price', $unit_price, PDO::PARAM_STR);
        $sentence-> bindParam(':amount', $amount, PDO::PARAM_STR);
        $sentence-> bindParam(':id_purchase_order_item', $id_purchase_order_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_purchase_order_items($connection, $id_purchase_order){
    $purchase_order_items = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM purchase_order_items WHERE id_purchase_order = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $purchase_order_items[] = new PurchaseOrderItem($row['id'], $row['id_purchase_order'], $row['part_number'], $row['quantity'], $row['description'], $row['unit_price'], $row['amount']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $purchase_order_items;
  }

  public static function print_purchase_order_item($purchase_order_item, $i){
    if(!isset($purchase_order_item)){
      return;
    }
    ?>
    <tr>
      <td>
        <div class="btn-group-vertical">
          <button type="button" class="edit_purchase_order_item btn btn-warning" name="button">
            <i class="fas fa-pen"></i>
            <input type="hidden" class="id_purchase_order_item" value="<?php echo $purchase_order_item-> get_id(); ?>">
          </button>
          <button type="button" class="remove_purchase_order_item btn btn-warning" name="button">
            <i class="fas fa-trash"></i>
            <input type="hidden" class="id_purchase_order_item" value="<?php echo $purchase_order_item-> get_id(); ?>">
          </button>
        </div>
      </td>
      <td><?php echo $i + 1; ?></td>
      <td><?php echo $purchase_order_item-> get_part_number(); ?></td>
      <td><?php echo $purchase_order_item-> get_quantity(); ?></td>
      <td><?php echo nl2br($purchase_order_item-> get_description()); ?></td>
      <td>$ <?php echo number_format($purchase_order_item-> get_unit_price(), 2); ?></td>
      <td>$ <?php echo number_format($purchase_order_item-> get_amount(), 2); ?></td>
    </tr>
    <?php
  }

  public static function print_purchase_order_items($id_purchase_order){
    ConnectionFullFillment::open_connection();
    $purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
    $purchase_order_items = self::get_all_purchase_order_items(ConnectionFullFillment::get_connection(), $id_purchase_order);
    ConnectionFullFillment::close_connection();
    if(count($purchase_order_items)){
      ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="narrow">Opt.</th>
            <th class="narrow">#</th>
            <th>Part #</th>
            <th class="narrow">Quantity</th>
            <th>Description</th>
            <th class="amount">Unit price</th>
            <th class="amount">Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($purchase_order_items as $key => $purchase_order_item) {
            self::print_purchase_order_item($purchase_order_item, $key);
          }
          ?>
          <tr>
            <td colspan="6"><h5>SUBTOTAL:</h5></td>
            <td>
              $ <?php echo number_format($purchase_order-> get_subtotal(), 2); ?>
            </td>
          </tr>
          <tr>
            <td>
              <button type="button" name="button" id="edit_shipment_cost" class="btn btn-warning">
                <i class="fas fa-pen"></i>
                <input type="hidden" id="id_purchase_order" value="<?php echo $purchase_order-> get_id(); ?>">
              </button>
            </td>
            <td colspan="5"><h5>TAXES:</h5></td>
            <td><?php echo number_format($purchase_order-> get_taxes(), 2); ?> %</td>
          </tr>
          <tr>
            <td></td>
            <td colspan="5"><h5>SHIPMENT COST:</h5></td>
            <td>$ <?php echo number_format($purchase_order-> get_shipment_cost(), 2); ?></td>
          </tr>
          <tr>
            <td colspan="6"><h5>TOTAL:</h5></td>
            <td>$ <?php echo number_format($purchase_order-> get_total(), 2); ?></td>
          </tr>
        </tbody>
      </table>
      <?php
    }else{
      ?>
      <div class="text-center">
        <h3 class="text-danger"><i class="fas fa-times"></i> No items!</h3>
      </div>
      <?php
    }
  }
}
?>
