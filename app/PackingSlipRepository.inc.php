<?php
class PackingSlipRepository{
  public static function insert_packing_slip($connection, $packing_slip){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slips(id_rfq, order_date, po, customer_contact, ship_to, message) VALUES(:id_rfq, :order_date, :po, :customer_contact, :ship_to, :message)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $packing_slip-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $packing_slip-> get_order_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':po', $packing_slip-> get_po(), PDO::PARAM_STR);
        $sentence-> bindParam(':customer_contact', $packing_slip-> get_customer_contact(), PDO::PARAM_STR);
        $sentence-> bindParam(':ship_to', $packing_slip-> get_ship_to(), PDO::PARAM_STR);
        $sentence-> bindParam(':message', $packing_slip-> get_message(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }
}
?>
