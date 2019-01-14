<?php
class PackingSlipRepository{
  public static function insert_packing_slip($connection, $packing_slip){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slips(id_rfq, responsible, order_date, customer_contact, ship_to, message) VALUES(:id_rfq, :responsible, :order_date, :customer_contact, :ship_to, :message)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $packing_slip-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':responsible', $packing_slip-> get_responsible(), PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $packing_slip-> get_order_date(), PDO::PARAM_STR);
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

  public static function packing_slip_exists($connection, $id_rfq){
    $packing_slip_exists = true;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slips WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          $packing_slip_exists = true;
        }else{
          $packing_slip_exists = false;
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip_exists;
  }

  public static function get_packing_slip_by_id_rfq($connection, $id_rfq){
    $packing_slip = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slips WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $packing_slip = new PackingSlip($result['id'], $result['id_rfq'], $result['responsible'], $result['order_date'], $result['customer_contact'], $result['ship_to'], $result['message']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip;
  }

  public static function get_packing_slip_by_id($connection, $id_packing_slip){
    $packing_slip = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM packing_slips WHERE id = :id_packing_slip';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip', $id_packing_slip, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $packing_slip = new PackingSlip($result['id'], $result['id_rfq'], $result['responsible'], $result['order_date'], $result['customer_contact'], $result['ship_to'], $result['message']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $packing_slip;
  }

  public static function update_packing_slip($connection, $responsible, $order_date, $customer_contact, $ship_to, $message, $id_packing_slip){
    if(isset($connection)){
      try{
        $sql = 'UPDATE packing_slips SET responsible = :responsible, order_date = :order_date, customer_contact = :customer_contact, ship_to = :ship_to, message = :message WHERE id = :id_packing_slip';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':responsible', $responsible, PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $sentence-> bindParam(':customer_contact', $customer_contact, PDO::PARAM_STR);
        $sentence-> bindParam(':ship_to', $ship_to, PDO::PARAM_STR);
        $sentence-> bindParam(':message', $message, PDO::PARAM_STR);
        $sentence-> bindParam(':id_packing_slip', $id_packing_slip, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
