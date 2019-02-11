<?php
class PackingSlipSubitemRepository{
  public static function insert_packing_slip_subitem($connection, $packing_slip_subitem){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slip_subitems(id_packing_slip_item, id_subitem, unit_type, back_order_quantity) VALUES(:id_packing_slip_item, :id_subitem, :unit_type, :back_order_quantity)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip_item', $packing_slip_subitem-> get_id_packing_slip_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':id_subitem', $packing_slip_subitem-> get_id_subitem(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_type', $packing_slip_subitem-> get_unit_type(), PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $packing_slip_subitem-> get_back_order_quantity(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function packing_slip_subitem_exists($connection, $id_subitem){
    $packing_slip_subitem_exists = true;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_subitems WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          $packing_slip_subitem_exists = true;
        }else{
          $packing_slip_subitem_exists = false;
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_subitem_exists;
  }

  public static function get_subitems_for_packing_slip_by_id_item($connection, $id_item){
    if(isset($connection)){
      try{
        $sql = 'SELECT subitems.id, subitems.description, subitems.quantity, SUM(trackings_subitems.quantity) as order_shipped, packing_slip_subitems.unit_type, packing_slip_subitems.back_order_quantity FROM subitems LEFT JOIN trackings_subitems ON subitems.id = trackings_subitems.id_subitem LEFT JOIN packing_slip_subitems ON subitems.id = packing_slip_subitems.id_subitem WHERE subitems.id_item = :id_item GROUP BY subitems.id';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $result;
  }

  public static function get_packing_slip_subitem_by_id_subitem($connection, $id_subitem){
    $packing_slip_subitem = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_subitems WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $packing_slip_subitem = new PackingSlipSubitem($result['id'], $result['id_packing_slip_item'], $result['id_subitem'], $result['unit_type'], $result['back_order_quantity']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_subitem;
  }

  public static function update_packing_slip_subitem($connection, $unit_type, $back_order_quantity, $id_packing_slip_subitem){
    if(isset($connection)){
      try{
        $sql = 'UPDATE packing_slip_subitems SET unit_type = :unit_type, back_order_quantity = :back_order_quantity WHERE id = :id_packing_slip_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':unit_type', $unit_type, PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $back_order_quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':id_packing_slip_subitem', $id_packing_slip_subitem, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_packing_slip_subitems_by_id_packing_slip_item($connection, $id_packing_slip_item){
    $packing_slip_subitems = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slip_subitems WHERE id_packing_slip_item = :id_packing_slip_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip_item', $id_packing_slip_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $packing_slip_subitems[] = new PackingSlipSubitem($row['id'], $row['id_packing_slip_item'], $row['id_subitem'], $row['unit_type'], $row['back_order_quantity']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_subitems;
  }

  public static function remove_packing_slip_subitem($connection, $id_packing_slip_subitem){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM packing_slip_subitems WHERE id = :id_packing_slip_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip_subitem', $id_packing_slip_subitem, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
