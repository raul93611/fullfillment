<?php
class PackingSlipItemRepository{
  public static function insert_packing_slip_item($connection, $packing_slip_item){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slip_items(id_packing_slip, id_item, unit_type, back_order_quantity) VALUES(:id_packing_slip, :id_item, :unit_type, :back_order_quantity)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip', $packing_slip_item-> get_id_packing_slip(), PDO::PARAM_STR);
        $sentence-> bindParam(':id_item', $packing_slip_item-> get_id_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_type', $packing_slip_item-> get_unit_type(), PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $packing_slip_item-> get_back_order_quantity(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function packing_slip_item_exists($connection, $id_item){
    $packing_slip_item_exists = true;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_items WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          $packing_slip_item_exists = true;
        }else{
          $packing_slip_item_exists = false;
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_item_exists;
  }

  public static function get_packing_slip_item_by_id_item($connection, $id_item){
    $packing_slip_item = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_items WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $packing_slip_item = new PackingSlipItem($result['id'], $result['id_packing_slip'], $result['id_item'], $result['unit_type'], $result['back_order_quantity']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_item;
  }

  public static function get_items_for_packing_slip_by_id_rfq($connection, $id_rfq){
    if(isset($connection)){
      try{
        $sql = 'SELECT item.id, SUM(trackings.quantity) as order_shipped, packing_slip_items.unit_type, packing_slip_items.back_order_quantity FROM item LEFT JOIN trackings ON item.id = trackings.id_item LEFT JOIN packing_slip_items ON item.id = packing_slip_items.id_item WHERE item.id_rfq = :id_rfq GROUP BY item.id';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $result;
  }

  public static function print_packing_slip_item($item, $re_quote_item, $i){
    if(!isset($item)){
      return ;
    }
    ?>
    <tr <?php if(!(is_null($item['unit_type']) && is_null($item['back_order_quantity']))){echo 'style="background-color: #dfffd6;"';} ?>>
      <td>
        <div class="btn-group-vertical">
        <?php
        if(is_null($item['unit_type']) && is_null($item['back_order_quantity'])){
          ?>
          <button type="button" class="new_packing_slip_item btn btn-warning" name="<?php echo $item['id']; ?>">
            <i class="fas fa-plus"></i>
          </button>
          <?php
        }else{
          ?>
          <button type="button" class="edit_packing_slip_item btn btn-warning" name="<?php echo $item['id']; ?>">
            <i class="fas fa-pen"></i>
          </button>
          <button type="button" class="remove_packing_slip_item btn btn-warning" name="<?php echo $item['id']; ?>">
            <i class="fas fa-trash"></i>
          </button>
          <?php
        }
        ?>
        </div>
      </td>
      <td><?php echo $i + 1; ?></td>
      <td><?php echo nl2br($re_quote_item-> get_description()); ?></td>
      <td><?php echo $re_quote_item-> get_quantity(); ?></td>
      <td><?php echo $item['order_shipped']; ?></td>
      <td><?php echo $item['unit_type']; ?></td>
      <td><?php echo $item['back_order_quantity']; ?></td>
    </tr>
    <?php
    ConnectionFullFillment::open_connection();
    $subitems = PackingSlipSubitemRepository::get_subitems_for_packing_slip_by_id_item(ConnectionFullFillment::get_connection(), $item['id']);
    ConnectionFullFillment::close_connection();
    Conexion::abrir_conexion();
    $re_quote_subitems = ReQuoteSubitemRepository::get_re_quote_subitems_by_id_re_quote_item(Conexion::obtener_conexion(), $re_quote_item-> get_id());
    Conexion::cerrar_conexion();
    if(count($subitems)){
      foreach ($subitems as $key => $subitem) {
        $re_quote_subitem = $re_quote_subitems[$key];
        ?>
        <tr <?php if(!(is_null($subitem['unit_type']) && is_null($subitem['back_order_quantity']))){echo 'style="background-color: #dfffd6;"';} ?>>
          <td>
            <div class="btn-group-vertical">
              <?php
              if(is_null($subitem['unit_type']) && is_null($subitem['back_order_quantity'])){
                ?>
                <button type="button" class="new_packing_slip_subitem btn btn-warning" name="<?php echo $subitem['id']; ?>">
                  <i class="fas fa-plus"></i>
                </button>
                <?php
              }else{
                ?>
                <button type="button" class="edit_packing_slip_subitem btn btn-warning" name="<?php echo $subitem['id']; ?>">
                  <i class="fas fa-pen"></i>
                </button>
                <button type="button" class="remove_packing_slip_subitem btn btn-warning" name="<?php echo $subitem['id']; ?>">
                  <i class="fas fa-trash"></i>
                </button>
                <?php
              }
              ?>
            </div>
          </td>
          <td></td>
          <td><?php echo nl2br($re_quote_subitem-> get_description()); ?></td>
          <td><?php echo $re_quote_subitem-> get_quantity(); ?></td>
          <td><?php echo $subitem['order_shipped']; ?></td>
          <td><?php echo $subitem['unit_type']; ?></td>
          <td><?php echo $subitem['back_order_quantity']; ?></td>
        </tr>
        <?php
      }
    }
  }

  public static function print_packing_slip_items($id_rfq){
    ConnectionFullFillment::open_connection();
    $items = PackingSlipItemRepository::get_items_for_packing_slip_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
    ConnectionFullFillment::close_connection();
    Conexion::abrir_conexion();
    $re_quote = ReQuoteRepository::get_re_quote_by_id_rfq(Conexion::obtener_conexion(), $id_rfq);
    $re_quote_items = ReQuoteItemRepository::get_re_quote_items_by_id_re_quote(Conexion::obtener_conexion(), $re_quote-> get_id());
    Conexion::cerrar_conexion();
    if(count($items)){
      ?>
      <table id="packing_slip_table" class="table table-hover table-bordered">
        <thead>
          <tr>
            <th class="narrow">Opt.</th>
            <th class="narrow">#</th>
            <th>Description</th>
            <th>Qty(ordered)</th>
            <th>Qty(shipped)</th>
            <th>Unit type</th>
            <th>Backorder quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($items as $key => $item) {
            $re_quote_item = $re_quote_items[$key];
            self::print_packing_slip_item($item, $re_quote_item, $key);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function update_packing_slip_item($connection, $unit_type, $back_order_quantity, $id_packing_slip_item){
    if(isset($connection)){
      try{
        $sql = 'UPDATE packing_slip_items SET unit_type = :unit_type, back_order_quantity = :back_order_quantity WHERE id = :id_packing_slip_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':unit_type', $unit_type, PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $back_order_quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':id_packing_slip_item', $id_packing_slip_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_packing_slip_item($connection, $id_packing_slip_item){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM packing_slip_items WHERE id = :id_packing_slip_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip_item', $id_packing_slip_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_packing_slip_items_by_id_packing_slip($connection, $id_packing_slip){
    $packing_slip_items = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_items WHERE id_packing_slip = :id_packing_slip ORDER BY id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip', $id_packing_slip, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $packing_slip_items[] = new PackingSlipItem($row['id'], $row['id_packing_slip'], $row['id_item'], $row['unit_type'], $row['back_order_quantity']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_items;
  }
}
?>
