<?php
class TrackingSubitemRepository{
  public static function insert_tracking($connection, $tracking){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO trackings_subitems(id_subitem, quantity, tracking_number, delivery_date, signed_by) VALUES(:id_subitem, :quantity, :tracking_number, :delivery_date, :signed_by)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $tracking-> get_id_subitem(), PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $tracking-> get_quantity(), PDO::PARAM_STR);
        $sentence-> bindParam(':tracking_number', $tracking-> get_tracking_number(), PDO::PARAM_STR);
        $sentence-> bindParam(':delivery_date', $tracking-> get_delivery_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':signed_by', $tracking-> get_signed_by(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_trackings_by_id_subitem($connection, $id_subitem){
    $trackings_subitems = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM trackings_subitems WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $trackings_subitems[] = new TrackingSubitem($row['id'], $row['id_subitem'], $row['quantity'], $row['tracking_number'], $row['delivery_date'], $row['signed_by']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $trackings_subitems;
  }

  public static function get_tracking_subitem_by_id($connection, $id_tracking_subitem){
    $tracking_subitem = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM trackings_subitems WHERE id = :id_tracking_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_tracking_subitem', $id_tracking_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $tracking_subitem = new TrackingSubitem($result['id'], $result['id_subitem'], $result['quantity'], $result['tracking_number'], $result['delivery_date'], $result['signed_by']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $tracking_subitem;
  }

  public static function delete_tracking_subitem($connection, $id_tracking_subitem){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM trackings_subitems WHERE id = :id_tracking_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_tracking_subitem', $id_tracking_subitem, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>