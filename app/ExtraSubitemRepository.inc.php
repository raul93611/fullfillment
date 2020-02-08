<?php
class ExtraSubitemRepository{
  public static function insert_extra_subitem($connection, $extra_subitem){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO extra_subitem(id_subitem, payment_terms) VALUES(:id_subitem, :payment_terms)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $extra_subitem-> get_id_subitem(), PDO::PARAM_STR);
        $sentence-> bindParam(':payment_terms', $extra_subitem-> get_payment_terms(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_extra_subitem_by_id_subitem($connection, $id_subitem){
    $extra_subitem = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_subitem WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(count($result)){
          $extra_subitem = new ExtraSubitem($result['id'], $result['id_subitem'], $result['payment_terms']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_subitem;
  }

  public static function set_payment_terms($connection, $payment_terms_subitem, $id_extra_subitem){
    if(isset($connection)){
      try{
        $sql = 'UPDATE extra_subitem SET payment_terms = :payment_terms WHERE id = :id_extra_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':payment_terms', $payment_terms_subitem, PDO::PARAM_STR);
        $sentence-> bindParam(':id_extra_subitem', $id_extra_subitem, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
