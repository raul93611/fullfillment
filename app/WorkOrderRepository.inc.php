<?php
class WorkOrderRepository{
  public static function insert_work_order($connection, $work_order){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO work_orders(id_rfq, company, address, phone, client, date, contract_number, bpa) VALUES(:id_rfq, :company, :address, :phone, :client, :date, :contract_number, :bpa)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $work_order-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':company', $work_order-> get_company(), PDO::PARAM_STR);
        $sentence-> bindParam(':address', $work_order-> get_address(), PDO::PARAM_STR);
        $sentence-> bindParam(':phone', $work_order-> get_phone(), PDO::PARAM_STR);
        $sentence-> bindParam(':client', $work_order-> get_client(), PDO::PARAM_STR);
        $sentence-> bindParam(':date', $work_order-> get_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':contract_number', $work_order-> get_contract_number(), PDO::PARAM_STR);
        $sentence-> bindParam(':bpa', $work_order-> get_bpa(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function remove_work_order($connection, $id_work_order){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM work_orders WHERE id = :id_work_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order', $id_work_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_work_orders_by_id_rfq($connection, $id_rfq){
    $work_orders = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_orders WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $work_orders[] = new WorkOrder($row['id'], $row['id_rfq'], $row['company'], $row['address'], $row['phone'], $row['client'], $row['date'], $row['contract_number'], $row['bpa']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_orders;
  }

  public static function set_work_order($connection, $company, $phone, $bpa, $address, $date, $contract_number, $client, $id_work_order){
    if(isset($connection)){
      try{
        $sql = 'UPDATE work_orders SET company = :company, phone = :phone, bpa = :bpa, address = :address, date = :date, contract_number = :contract_number, client = :client WHERE id = :id_work_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':company', $company, PDO::PARAM_STR);
        $sentence-> bindParam(':phone', $phone, PDO::PARAM_STR);
        $sentence-> bindParam(':bpa', $bpa, PDO::PARAM_STR);
        $sentence-> bindParam(':address', $address, PDO::PARAM_STR);
        $sentence-> bindParam(':date', $date, PDO::PARAM_STR);
        $sentence-> bindParam(':contract_number', $contract_number, PDO::PARAM_STR);
        $sentence-> bindParam(':client', $client, PDO::PARAM_STR);
        $sentence-> bindParam(':id_work_order', $id_work_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_work_order_by_id($connection, $id_work_order){
    $work_order = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM work_orders WHERE id = :id_work_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_work_order', $id_work_order, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $work_order = new WorkOrder($result['id'], $result['id_rfq'], $result['company'], $result['address'], $result['phone'], $result['client'], $result['date'], $result['contract_number'], $result['bpa']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $work_order;
  }
}
?>
