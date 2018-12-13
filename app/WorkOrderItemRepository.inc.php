<?php
class WorkOrderItemRepository{
  public static function insert_work_order_item($connection, $work_order_item){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO work_order_items(id_work_order, equipment) VALUES(:id_work_order, :equipment)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order', $work_order_item-> get_id_work_order(), PDO::PARAM_STR);
        $sentence-> bindParam(':equipment', $work_order_item-> get_equipment(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function delete_work_order_item($connection, $id_work_order_item){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM work_order_items WHERE id = :id_work_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item', $id_work_order_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_work_order_item($connection, $equipment, $id_work_order_item){
    if(isset($connection)){
      try {
        $sql = 'UPDATE work_order_items SET equipment = :equipment WHERE id = :id_work_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':equipment', $equipment, PDO::PARAM_STR);
        $sentence-> bindParam(':id_work_order_item', $id_work_order_item, PDO::PARAM_STR);
        $sentence-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_work_order_item_by_id($connection, $id_work_order_item){
    $work_order_item = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_order_items WHERE id = :id_work_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item', $id_work_order_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $work_order_item = new WorkOrderItem($result['id'], $result['id_work_order'], $result['equipment']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_order_item;
  }

  public static function get_all_work_order_items_by_id_work_order($connection, $id_work_order){
    $work_order_items = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_order_items WHERE id_work_order = :id_work_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order', $id_work_order, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $work_order_items[] = new WorkOrderItem($row['id'], $row['id_work_order'], $row['equipment']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_order_items;
  }

  public static function print_work_order_item($work_order_item, $i){
    if(!isset($work_order_item)){
      return;
    }
    ConnectionFullFillment::open_connection();
    $work_order_item_details = WorkOrderItemDetailRepository::get_work_order_item_details_by_id_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item-> get_id());
    ConnectionFullFillment::close_connection();
    if(!count($work_order_item_details)){
      $details_quantity = 1;
    }else{
      $details_quantity = count($work_order_item_details);
    }
    ?>
    <tr>
      <td rowspan="<?php echo $details_quantity; ?>">
        <div class="btn-group-vertical">
          <button type="button" class="new_work_order_item_detail_button btn btn-warning" name="<?php echo $work_order_item-> get_id(); ?>"><i class="fas fa-plus"></i></button>
          <button type="button" class="edit_work_order_item_button btn btn-warning" name="<?php echo $work_order_item-> get_id(); ?>"><i class="fas fa-pen"></i></button>
          <button type="button" class="delete_work_order_item_button btn btn-warning" name="<?php echo $work_order_item-> get_id(); ?>"><i class="fas fa-trash"></i></button>
        </div>
      </td>
      <td rowspan="<?php echo $details_quantity; ?>"><?php echo $i + 1; ?></td>
      <td rowspan="<?php echo $details_quantity; ?>"><?php echo nl2br($work_order_item-> get_equipment()); ?></td>
      <?php
      if(count($work_order_item_details)){
        ?>
        <td>
          <button type="button" class="delete_work_order_item_detail_button btn btn-warning" name="<?php echo $work_order_item_details[0]-> get_id(); ?>"><i class="fas fa-trash"></i></button>
        </td>
        <td><?php echo $work_order_item_details[0]-> get_detail_name(); ?></td>
        <td><?php echo $work_order_item_details[0]-> get_detail(); ?></td>
        <td><?php echo $work_order_item_details[0]-> get_keycode(); ?></td>
        <td><?php echo $work_order_item_details[0]-> get_notes(); ?></td>
        <td><?php echo $work_order_item_details[0]-> get_technitian(); ?></td>
        <?php
      }
      ?>
    </tr>
    <?php
    for ($j = 1; $j < count($work_order_item_details); $j++) {
      $work_order_item_detail = $work_order_item_details[$j];
      ?>
      <tr>
        <td>
          <button type="button" class="delete_work_order_item_detail_button btn btn-warning" name="<?php echo $work_order_item_detail-> get_id(); ?>"><i class="fas fa-trash"></i></button>
        </td>
        <td><?php echo $work_order_item_detail-> get_detail_name(); ?></td>
        <td><?php echo $work_order_item_detail-> get_detail(); ?></td>
        <td><?php echo $work_order_item_detail-> get_keycode(); ?></td>
        <td><?php echo $work_order_item_detail-> get_notes(); ?></td>
        <td><?php echo $work_order_item_detail-> get_technitian(); ?></td>
      </tr>
      <?php
    }
  }

  public static function print_work_order_items($id_work_order){
    ConnectionFullFillment::open_connection();
    $work_order_items = self::get_all_work_order_items_by_id_work_order(ConnectionFullFillment::get_connection(), $id_work_order);
    ConnectionFullFillment::close_connection();
    if(count($work_order_items)){
      ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="narrow">Opt.</th>
            <th class="narrow">#</th>
            <th>Equipment</th>
            <th class="narrow">Opt.</th>
            <th>Detail</th>
            <th>Description</th>
            <th>Keycode</th>
            <th>Notes</th>
            <th>Technitian</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($work_order_items as $key => $work_order_item) {
            self::print_work_order_item($work_order_item, $key);
          }
          ?>
        </tbody>
      </table>
      <?php
    }else{
      ?>
      <div class="container">
        <h3 class="text-danger text-center"><i class="fas fa-times"></i> No items!</h3>
      </div>
      <?php
    }
  }
}
?>
