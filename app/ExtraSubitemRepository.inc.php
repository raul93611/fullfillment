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
}
?>
