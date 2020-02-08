<?php
class AccountingSubitemPriceRepository{
  public static function insert_accounting_subitem_price($connection, $accounting_subitem_price){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO accounting_subitem_price(id_subitem, company, quantity, unit_cost, other_cost, real_cost) VALUES(:id_subitem, :company, :quantity, :unit_cost, :other_cost, :real_cost)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $accounting_subitem_price-> get_id_subitem(), PDO::PARAM_STR);
        $sentence-> bindParam(':company', $accounting_subitem_price-> get_company(), PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $accounting_subitem_price-> get_quantity(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $accounting_subitem_price-> get_unit_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $accounting_subitem_price-> get_other_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $accounting_subitem_price-> get_real_cost(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_accounting_subitem_prices_by_id_subitem($connection, $id_subitem){
    $subitems = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_subitem_price WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $subitems[] = new AccountingSubitemPrice($row['id'], $row['id_subitem'], $row['company'], $row['quantity'], $row['unit_cost'], $row['other_cost'], $row['real_cost']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $subitems;
  }

  public static function get_accounting_subitem_price_by_id($connection, $id_accounting_subitem_price){
    $subitem = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_subitem_price WHERE id = :id_accounting_subitem_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_subitem_price', $id_accounting_subitem_price, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $subitem = new AccountingSubitemPrice($result['id'], $result['id_subitem'], $result['company'], $result['quantity'], $result['unit_cost'], $result['other_cost'], $result['real_cost']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $subitem;
  }

  public static function update_accounting_subitem_price($connection, $company, $quantity, $unit_cost, $other_cost, $real_cost,$id_accounting_subitem_price){
    if(isset($connection)){
      try{
        $sql = 'UPDATE accounting_subitem_price SET company = :company, quantity = :quantity, unit_cost = :unit_cost, other_cost = :other_cost, real_cost = :real_cost WHERE id = :id_accounting_subitem_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':company', $company, PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $unit_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $other_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $real_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_accounting_subitem_price', $id_accounting_subitem_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_accounting_subitem_price($connection, $id_accounting_subitem_price){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM accounting_subitem_price WHERE id = :id_accounting_subitem_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_subitem_price', $id_accounting_subitem_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_real_cost_by_subitem($connection, $id_subitem){
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(real_cost) as real_cost FROM accounting_subitem_price WHERE id_subitem = :id_subitem';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
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
