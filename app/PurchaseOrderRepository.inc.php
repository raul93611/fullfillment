<?php
class PurchaseOrderRepository{
  public static function insert_purchase_order($connection, $purchase_order){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO purchase_orders(id_rfq, responsible, date, purchase_from, drop_ship_to, comments, ref_quote, ship_via, order_date, terms, subtotal, shipment_cost, total, message, taxes, doc_name) VALUES(:id_rfq, :responsible, :date, :purchase_from, :drop_ship_to, :comments, :ref_quote, :ship_via, :order_date, :terms, :subtotal, :shipment_cost, :total, :message, :taxes, :doc_name)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $purchase_order-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':responsible', $purchase_order-> get_responsible(), PDO::PARAM_STR);
        $sentence-> bindParam(':date', $purchase_order-> get_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':purchase_from', $purchase_order-> get_purchase_from(), PDO::PARAM_STR);
        $sentence-> bindParam(':drop_ship_to', $purchase_order-> get_drop_ship_to(), PDO::PARAM_STR);
        $sentence-> bindParam(':comments', $purchase_order-> get_comments(), PDO::PARAM_STR);
        $sentence-> bindParam(':ref_quote', $purchase_order-> get_ref_quote(), PDO::PARAM_STR);
        $sentence-> bindParam(':ship_via', $purchase_order-> get_ship_via(), PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $purchase_order-> get_order_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':terms', $purchase_order-> get_terms(), PDO::PARAM_STR);
        $sentence-> bindParam(':subtotal', $purchase_order-> get_subtotal(), PDO::PARAM_STR);
        $sentence-> bindParam(':shipment_cost', $purchase_order-> get_shipment_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':total', $purchase_order-> get_total(), PDO::PARAM_STR);
        $sentence-> bindParam(':message', $purchase_order-> get_message(), PDO::PARAM_STR);
        $sentence-> bindParam(':taxes', $purchase_order-> get_taxes(), PDO::PARAM_STR);
        $sentence-> bindParam(':doc_name', $purchase_order-> get_doc_name(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function remove_purchase_order($connection, $id_purchase_order){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM purchase_orders WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_purchase_orders_by_id_rfq($connection, $id_rfq){
    $purchase_orders = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM purchase_orders WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchall(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $purchase_orders[] = new PurchaseOrder($row['id'], $row['id_rfq'], $row['responsible'], $row['date'], $row['purchase_from'], $row['drop_ship_to'], $row['comments'], $row['ref_quote'], $row['ship_via'], $row['order_date'], $row['terms'], $row['subtotal'], $row['shipment_cost'], $row['total'], $row['message'], $row['taxes'], $row['doc_name']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $purchase_orders;
  }

  public static function set_purchase_order($connection, $responsible, $date, $order_date, $purchase_from, $drop_ship_to, $comments, $ref_quote, $ship_via, $terms, $message, $doc_name, $id_purchase_order){
    if(isset($connection)){
      try{
        $sql = 'UPDATE purchase_orders SET responsible = :responsible, date = :date, order_date = :order_date, purchase_from = :purchase_from, drop_ship_to = :drop_ship_to, comments = :comments, ref_quote = :ref_quote, ship_via = :ship_via, terms = :terms, message = :message, doc_name = :doc_name WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':responsible', $responsible, PDO::PARAM_STR);
        $sentence-> bindParam(':date', $date, PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $sentence-> bindParam(':purchase_from', $purchase_from, PDO::PARAM_STR);
        $sentence-> bindParam(':drop_ship_to', $drop_ship_to, PDO::PARAM_STR);
        $sentence-> bindParam(':comments', $comments, PDO::PARAM_STR);
        $sentence-> bindParam(':ref_quote', $ref_quote, PDO::PARAM_STR);
        $sentence-> bindParam(':ship_via', $ship_via, PDO::PARAM_STR);
        $sentence-> bindParam(':terms', $terms, PDO::PARAM_STR);
        $sentence-> bindParam(':message', $message, PDO::PARAM_STR);
        $sentence-> bindParam(':doc_name', $doc_name, PDO::PARAM_STR);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_shipment_cost_and_total($connection, $taxes, $shipment_cost, $total, $id_purchase_order){
    if(isset($connection)){
      try{
        $sql = 'UPDATE purchase_orders SET taxes = :taxes, shipment_cost = :shipment_cost, total = :total WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':taxes', $taxes, PDO::PARAM_STR);
        $sentence-> bindParam(':shipment_cost', $shipment_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':total', $total, PDO::PARAM_STR);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_total($connection, $total, $id_purchase_order){
    if(isset($connection)){
      try{
        $sql = 'UPDATE purchase_orders SET total = :total WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':total', $total, PDO::PARAM_STR);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_subtotal($connection, $subtotal, $id_purchase_order){
    if(isset($connection)){
      try{
        $sql = 'UPDATE purchase_orders SET subtotal = :subtotal WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':subtotal', $subtotal, PDO::PARAM_STR);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_purchase_order_by_id($connection, $id_purchase_order){
    $purchase_order = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM purchase_orders WHERE id = :id_purchase_order';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_purchase_order', $id_purchase_order, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $purchase_order = new PurchaseOrder($result['id'], $result['id_rfq'], $result['responsible'], $result['date'], $result['purchase_from'], $result['drop_ship_to'], $result['comments'], $result['ref_quote'], $result['ship_via'], $result['order_date'], $result['terms'], $result['subtotal'], $result['shipment_cost'], $result['total'], $result['message'], $result['taxes'], $result['doc_name']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $purchase_order;
  }
}
?>
