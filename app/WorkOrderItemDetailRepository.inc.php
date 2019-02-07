<?php
class WorkOrderItemDetailRepository{
  public static function get_work_order_item_details_by_id_work_order_item($connection, $id_work_order_item){
    $work_order_item_details = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_order_item_details WHERE id_work_order_item = :id_work_order_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item', $id_work_order_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $work_order_item_details[] = new WorkOrderItemDetail($row['id'], $row['id_work_order_item'], $row['detail_name'], $row['detail'], $row['keycode'], $row['notes'], $row['technitian']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_order_item_details;
  }

  public static function get_work_order_item_detail_by_id($connection, $id_work_order_item_detail){
    $work_order_item_detail = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_order_item_details WHERE id = :id_work_order_item_detail';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item_detail', $id_work_order_item_detail, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $work_order_item_detail = new WorkOrderItemDetail($result['id'], $result['id_work_order_item'], $result['detail_name'], $result['detail'], $result['keycode'], $result['notes'], $result['technitian']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_order_item_detail;
  }

  public static function delete_work_order_item_detail($connection, $id_work_order_item_detail){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM work_order_item_details WHERE id = :id_work_order_item_detail';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item_detail', $id_work_order_item_detail, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function insert_work_order_item_detail($connection, $work_order_item_detail){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO work_order_item_details(id_work_order_item, detail_name, detail, keycode, notes, technitian) VALUES(:id_work_order_item, :detail_name, :detail, :keycode, :notes, :technitian)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order_item', $work_order_item_detail-> get_id_work_order_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':detail_name', $work_order_item_detail-> get_detail_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':detail', $work_order_item_detail-> get_detail(), PDO::PARAM_STR);
        $sentence-> bindParam(':keycode', $work_order_item_detail-> get_keycode(), PDO::PARAM_STR);
        $sentence-> bindParam(':notes', $work_order_item_detail-> get_notes(), PDO::PARAM_STR);
        $sentence-> bindParam(':technitian', $work_order_item_detail-> get_technitian(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_work_order_item_detail($connection, $detail_name, $detail, $keycode, $notes, $technitian, $id_work_order_item_detail){
    if(isset($connection)){
      try{
        $sql = 'UPDATE work_order_item_details SET detail_name = :detail_name, detail = :detail, keycode = :keycode, notes = :notes, technitian = :technitian WHERE id = :id_work_order_item_detail';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':detail_name', $detail_name, PDO::PARAM_STR);
        $sentence-> bindParam(':detail', $detail, PDO::PARAM_STR);
        $sentence-> bindParam(':keycode', $keycode, PDO::PARAM_STR);
        $sentence-> bindParam(':notes', $notes, PDO::PARAM_STR);
        $sentence-> bindParam(':technitian', $technitian, PDO::PARAM_STR);
        $sentence-> bindParam(':id_work_order_item_detail', $id_work_order_item_detail, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
