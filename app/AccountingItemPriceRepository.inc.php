<?php
class AccountingItemPriceRepository{
  public static function insert_accounting_item_price($connection, $accounting_item_price){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO accounting_item_price(id_item, company, quantity, unit_cost, other_cost, real_cost) VALUES(:id_item, :company, :quantity, :unit_cost, :other_cost, :real_cost)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $accounting_item_price-> get_id_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':company', $accounting_item_price-> get_company(), PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $accounting_item_price-> get_quantity(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $accounting_item_price-> get_unit_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $accounting_item_price-> get_other_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $accounting_item_price-> get_real_cost(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_accounting_item_prices_by_id_item($connection, $id_item){
    $items = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_item_price WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $items[] = new AccountingItemPrice($row['id'], $row['id_item'], $row['company'], $row['quantity'], $row['unit_cost'], $row['other_cost'], $row['real_cost']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $items;
  }

  public static function get_accounting_item_price_by_id($connection, $id_accounting_item_price){
    $item = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_item_price WHERE id = :id_accounting_item_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_item_price', $id_accounting_item_price, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $item = new AccountingItemPrice($result['id'], $result['id_item'], $result['company'], $result['quantity'], $result['unit_cost'], $result['other_cost'], $result['real_cost']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $item;
  }

  public static function update_accounting_item_price($connection, $company, $quantity, $unit_cost, $other_cost, $real_cost, $id_accounting_item_price){
    if(isset($connection)){
      try{
        $sql = 'UPDATE accounting_item_price SET company = :company, quantity = :quantity, unit_cost = :unit_cost, other_cost = :other_cost, real_cost = :real_cost WHERE id = :id_accounting_item_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':company', $company, PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $unit_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $other_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $real_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_accounting_item_price', $id_accounting_item_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_accounting_item_price($connection, $id_accounting_item_price){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM accounting_item_price WHERE id = :id_accounting_item_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_item_price', $id_accounting_item_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_real_cost_by_item($connection, $id_item){
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(real_cost) as real_cost FROM accounting_item_price WHERE id_item = :id_item';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['real_cost'])){
          $real_cost = $result['real_cost'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $real_cost;
  }
}
?>
