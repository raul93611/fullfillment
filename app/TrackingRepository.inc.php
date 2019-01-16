<?php
class TrackingRepository{
  public static function insert_tracking($connection, $tracking){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO trackings(id_item, quantity, tracking_number, delivery_date, signed_by) VALUES(:id_item, :quantity, :tracking_number, :delivery_date, :signed_by)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $tracking-> get_id_item(), PDO::PARAM_STR);
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

  public static function get_all_trackings_by_id_item($connection, $id_item){
    $trackings = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM trackings WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $trackings[] = new Tracking($row['id'], $row['id_item'], $row['quantity'], $row['tracking_number'], $row['delivery_date'], $row['signed_by']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $trackings;
  }

  public static function get_tracking_by_id($connection, $id_tracking){
    $tracking = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM trackings WHERE id = :id_tracking';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_tracking', $id_tracking, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $tracking = new Tracking($result['id'], $result['id_item'], $result['quantity'], $result['tracking_number'], $result['delivery_date'], $result['signed_by']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $tracking;
  }

  public static function delete_tracking($connection, $id_tracking){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM trackings WHERE id = :id_tracking';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_tracking', $id_tracking, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_sum_by_item($connection, $id_item){
    $sum_tracking = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(quantity) as sum_tracking FROM trackings WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $sum_tracking = $result['sum_tracking'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $sum_tracking;
  }
}
?>
