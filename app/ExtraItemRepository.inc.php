<?php
class ExtraItemRepository{
  public static function insert_extra_item($connection, $extra_item){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO extra_item(id_item, payment_terms) VALUES(:id_item, :payment_terms)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $extra_item-> get_id_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':payment_terms', $extra_item-> get_payment_terms(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_extra_item_by_id_item($connection, $id_item){
    $extra_item = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_item WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(count($result)){
          $extra_item = new ExtraItem($result['id'], $result['id_item'], $result['payment_terms']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_item;
  }

  public static function set_payment_terms($connection, $payment_terms_item, $id_extra_item){
    if(isset($connection)){
      try{
        $sql = 'UPDATE extra_item SET payment_terms = :payment_terms WHERE id = :id_extra_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':payment_terms', $payment_terms_item, PDO::PARAM_STR);
        $sentence-> bindParam(':id_extra_item', $id_extra_item, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
