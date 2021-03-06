<?php
class RepositorioSubitemFullFillment{
  public static function insertar_subitem($conexion, $subitem) {
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO subitems(id_item, provider_menor, brand, brand_project, part_number, part_number_project, description, description_project, quantity, unit_price, total_price, comments, website, additional) VALUES(:id_item, :provider_menor, :brand, :brand_project, :part_number, :part_number_project, :description, :description_project, :quantity, :unit_price, :total_price, :comments, :website, :additional)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_item', $subitem->obtener_id_item(), PDO::PARAM_STR);
        $sentencia->bindParam(':provider_menor', $subitem->obtener_provider_menor(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand', $subitem->obtener_brand(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand_project', $subitem->obtener_brand_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number', $subitem->obtener_part_number(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number_project', $subitem->obtener_part_number_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':description', $subitem->obtener_description(), PDO::PARAM_STR);
        $sentencia->bindParam(':description_project', $subitem->obtener_description_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':quantity', $subitem->obtener_quantity(), PDO::PARAM_STR);
        $sentencia->bindParam(':unit_price', $subitem->obtener_unit_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':total_price', $subitem->obtener_total_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':comments', $subitem->obtener_comments(), PDO::PARAM_STR);
        $sentencia->bindParam(':website', $subitem->obtener_website(), PDO::PARAM_STR);
        $sentencia->bindParam(':additional', $subitem->obtener_additional(), PDO::PARAM_STR);
        $sentencia->execute();
        $id = $conexion->lastInsertId();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function actualizar_provider_menor_subitem($conexion, $provider_menor, $id_subitem){
    if(isset($conexion)){
      try{
        $sql = 'UPDATE subitems SET provider_menor = :provider_menor WHERE id = :id_subitem';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':provider_menor', $provider_menor, PDO::PARAM_STR);
        $sentencia-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function obtener_subitems_por_id_item($conexion, $id_item) {
    $subitems = [];
    if (isset($conexion)) {
      try {
        $sql = 'SELECT * FROM subitems WHERE id_item = :id_item';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        if (count($resultado)) {
          foreach ($resultado as $fila) {
            $subitems[] = new Subitem($fila['id'], $fila['id_item'], $fila['provider_menor'], $fila['brand'], $fila['brand_project'], $fila['part_number'], $fila['part_number_project'], $fila['description'], $fila['description_project'], $fila['quantity'], $fila['unit_price'], $fila['total_price'], $fila['comments'], $fila['website'], $fila['additional']);
          }
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $subitems;
  }

  public static function escribir_subitem($subitem, $i) {
    if (!isset($subitem)) {
      return;
    }
    $j = $i;
    ConnectionFullFillment::open_connection();
    $providers_subitem = RepositorioProviderSubitemFullFillment::obtener_providers_subitem_por_id_subitem(ConnectionFullFillment::get_connection(), $subitem->obtener_id());
    ConnectionFullFillment::close_connection();
    ?>
    <tr class="fila_subitem">
      <td>
        <a href="<?php echo ADD_PROVIDER_SUBITEM . $subitem->obtener_id(); ?>" class="btn btn-warning btn-block subitem">
          <i class="fa fa-plus-circle"></i> Add Provider
        </a>
        <br>
        <a href="<?php echo EDIT_SUBITEM . $subitem->obtener_id(); ?>" class="btn btn-warning btn-block subitem">
          <i class="fa fa-edit"></i> Edit subitem
        </a>
        <br>
        <a href="<?php echo DELETE_SUBITEM . $subitem-> obtener_id(); ?>" class="delete_subitem_button btn btn-warning btn-block subitem">
          <i class="fa fa-trash"></i> Delete
        </a>
        <br>
        <a href="<?php echo $subitem-> obtener_id(); ?>"  class="payment_terms_subitem btn btn-warning btn-block subitem">
          <i class="fas fa-edit"></i> Payment terms
        </a>
      </td>
      <td></td>
    <?php
    if(strlen($subitem-> obtener_description_project()) >= 100){
      ?>
      <td>
        <b>Brand:</b> <?php echo $subitem->obtener_brand_project(); ?>
        <br>
        <b>Part #:</b> <?php echo $subitem->obtener_part_number_project(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br(mb_substr($subitem->obtener_description_project(), 0, 100)); ?> ...
      </td>
      <?php
    }else{
      ?>
      <td>
        <b>Brand:</b> <?php echo $subitem->obtener_brand_project(); ?>
        <br>
        <b>Part #:</b> <?php echo $subitem->obtener_part_number_project(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br($subitem->obtener_description_project()); ?>
      </td>
      <?php
    }
    if(strlen($subitem-> obtener_description()) >= 100){
      ?>
      <td>
        <b>Brand:</b> <?php echo $subitem->obtener_brand(); ?>
        <br>
        <b>Part #:</b> <?php echo $subitem->obtener_part_number(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br(mb_substr($subitem->obtener_description(), 0, 100)); ?> ...
      </td>
      <?php
    }else{
      ?>
      <td>
        <b>Brand:</b> <?php echo $subitem->obtener_brand(); ?>
        <br>
        <b>Part #:</b> <?php echo $subitem->obtener_part_number(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br($subitem->obtener_description()); ?>
      </td>
      <?php
    }
    ?>
      <td class="estrechar">
        <a target="_blank" href="<?php echo $subitem-> obtener_website(); ?>"><?php echo $subitem-> obtener_website(); ?></a>
      </td>
      <td><?php echo $subitem->obtener_quantity(); ?></td>
      <td>
        <div class="row">
          <div class="col-6">
            <?php
            for ($i = 0; $i < count($providers_subitem); $i++) {
              $provider_subitem = $providers_subitem[$i];
              if(strlen($provider_subitem-> obtener_provider()) >= 10){
                ?>
                <a href="<?php echo EDIT_PROVIDER_SUBITEM . $provider_subitem->obtener_id(); ?>">
                  <b><?php echo mb_substr($provider_subitem->obtener_provider(), 0, 10); ?>... :</b>
                </a>
                <br>
                <?php
              }else{
                ?>
                <a href="<?php echo EDIT_PROVIDER_SUBITEM . $provider_subitem->obtener_id(); ?>">
                  <b><?php echo $provider_subitem->obtener_provider(); ?>:</b>
                </a>
                <br>
                <?php
              }
            }
            ?>
          </div>
          <div class="col-6">
            <?php
            for ($i = 0; $i < count($providers_subitem); $i++) {
              $provider_subitem = $providers_subitem[$i];
              echo '$ ' . $provider_subitem->obtener_price() . '<br>';
            }
            ?>
          </div>
        </div>
      </td>
    <?php
    if($subitem-> obtener_additional() != 0){
      ?>
      <td>
        <input type="text" class="form-control form-control-sm" id="add_cost<?php echo $j; ?>" size="10" value="<?php echo $subitem-> obtener_additional(); ?>">
      </td>
      <?php
    }else{
      ?>
      <td>
        <input type="text" class="form-control form-control-sm" id="add_cost<?php echo $j; ?>" size="10" value="0">
      </td>
      <?php
    }
    echo '<td>';
    for ($i = 0; $i < count($providers_subitem); $i++) {
      $provider_subitem = $providers_subitem[$i];
      $precios_subitem[$i] = $provider_subitem->obtener_price();
    }
    if (!empty($precios_subitem)) {
      $best_unit_price = min($precios_subitem);
      for($i = 0;$i < count($precios_subitem); $i++){
        if($best_unit_price == $precios_subitem[$i]){
          ConnectionFullFillment::open_connection();
          self::actualizar_provider_menor_subitem(ConnectionFullFillment::get_connection(), $providers_subitem[$i]->obtener_id(), $subitem-> obtener_id());
          ConnectionFullFillment::close_connection();
        }
      }
      echo '$ ' . $best_unit_price;
    }
    echo '</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td>' . nl2br($subitem->obtener_comments()) . '</td>';
    echo '</tr>';
  }

  public static function escribir_subitems($id_item, $j) {
    $j++;
    ConnectionFullFillment::open_connection();
    $subitems = self::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $id_item);
    ConnectionFullFillment::close_connection();
    if (count($subitems)) {
      for ($i = 0; $i < count($subitems); $i++) {
        $subitem = $subitems[$i];
        self::escribir_subitem($subitem, $j);
        $j++;
      }
    }
    return $j;
  }

  public static function delete_subitem($conexion, $id_subitem){
    if(isset($conexion)){
      try{
        $conexion -> beginTransaction();
        $sql1 = "DELETE FROM provider_subitems WHERE id_subitem = :id_subitem";
        $sentencia1 = $conexion-> prepare($sql1);
        $sentencia1-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia1-> execute();
        $sql2 = "DELETE FROM subitems WHERE id = :id_subitem";
        $sentencia2 = $conexion-> prepare($sql2);
        $sentencia2-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia2-> execute();
        $conexion-> commit();
      } catch (PDOException $ex) {
        print "ERROR:" . $ex->getMessage() . "<br>";
        $conexion-> rollBack();
      }
    }
  }

  public static function obtener_subitem_por_id($conexion, $id_subitem) {
    $subitem = null;
    if (isset($conexion)) {
      try {
        $sql = 'SELECT * FROM subitems WHERE id = :id_subitem';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        if (!empty($resultado)) {
          $subitem = new Subitem($resultado['id'], $resultado['id_item'], $resultado['provider_menor'], $resultado['brand'], $resultado['brand_project'], $resultado['part_number'], $resultado['part_number_project'], $resultado['description'], $resultado['description_project'], $resultado['quantity'], $resultado['unit_price'], $resultado['total_price'], $resultado['comments'], $resultado['website'], $resultado['additional']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $subitem;
  }

  public static function actualizar_subitem($conexion, $id_subitem, $brand, $brand_project, $part_number, $part_number_project, $description, $description_project, $quantity, $comments, $website) {
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE subitems SET brand = :brand, brand_project = :brand_project, part_number = :part_number, part_number_project = :part_number_project, description = :description, description_project = :description_project, quantity = :quantity, comments = :comments, website = :website WHERE id = :id_subitem';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':brand', $brand, PDO::PARAM_STR);
        $sentencia->bindParam(':brand_project', $brand_project, PDO::PARAM_STR);
        $sentencia->bindParam(':part_number', $part_number, PDO::PARAM_STR);
        $sentencia->bindParam(':part_number_project', $part_number_project, PDO::PARAM_STR);
        $sentencia->bindParam(':description', $description, PDO::PARAM_STR);
        $sentencia->bindParam(':description_project', $description_project, PDO::PARAM_STR);
        $sentencia->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $sentencia->bindParam(':comments', $comments, PDO::PARAM_STR);
        $sentencia->bindParam(':website', $website, PDO::PARAM_STR);
        $sentencia->bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia->execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function insertar_calculos($conexion, $unit_price_subitem, $total_price_subitem, $additional_subitem, $id_subitem){
    if(isset($conexion)){
      try{
        $sql = 'UPDATE subitems SET unit_price = :unit_price, total_price = :total_price, additional = :additional WHERE id = :id_subitem';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':unit_price', $unit_price_subitem, PDO::PARAM_STR);
        $sentencia-> bindParam(':total_price', $total_price_subitem, PDO::PARAM_STR);
        $sentencia-> bindParam(':additional', $additional_subitem, PDO::PARAM_STR);
        $sentencia-> bindParam(':id_subitem', $id_subitem, PDO::PARAM_STR);
        $sentencia-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function tracking_list_subitem($subitem, $re_quote_subitem){
    if(!isset($subitem)){
      return;
    }
    ConnectionFullFillment::open_connection();
    $trackings_subitems = TrackingSubitemRepository::get_all_trackings_by_id_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
    ConnectionFullFillment::close_connection();
    if(!count($trackings_subitems)){
      $trackings_quantity = 1;
    }else{
      $trackings_quantity = count($trackings_subitems);
    }
    ?>
    <tr>
      <td class="align-middle text-center" rowspan="<?php echo $trackings_quantity; ?>">
        <button type="button" class="add_tracking_subitem_button btn btn-warning" name="<?php echo $subitem-> obtener_id(); ?>"><i class="fas fa-plus"></i></button>
      </td>
      <td rowspan="<?php echo $trackings_quantity; ?>"></td>
      <td rowspan="<?php echo $trackings_quantity; ?>">
        <?php
        echo '<b>Brand:</b> ' . $re_quote_subitem-> get_brand() . '<br>';
        echo '<b>Part #:</b> ' . $re_quote_subitem-> get_part_number() . '<br>';
        echo '<b>Description:</b> ' . nl2br(mb_substr($re_quote_subitem-> get_description(), 0, 100));
        ?>
      </td>
      <td rowspan="<?php echo $trackings_quantity; ?>"><?php echo $re_quote_subitem-> get_quantity(); ?></td>
      <?php
    if(count($trackings_subitems)){
          ?>
          <td class="align-middle text-center">
            <a href="<?php echo DELETE_TRACKING_SUBITEM . $trackings_subitems[0]-> get_id(); ?>" class="mb-2 btn btn-warning"><i class="fas fa-trash"></i></a><br>
            <a href="#" data="<?php echo $trackings_subitems[0]-> get_id(); ?>" class="edit_tracking_subitem btn btn-warning"><i class="fas fa-pen"></i></a>
          </td>
          <td><?php echo $trackings_subitems[0]-> get_quantity(); ?></td>
          <td><?php echo nl2br($trackings_subitems[0]-> get_tracking_number()); ?></td>
          <td><?php echo RepositorioRfqFullFillmentComment::mysql_date_to_english_format($trackings_subitems[0]-> get_delivery_date()); ?></td>
          <td><?php echo $trackings_subitems[0]-> get_signed_by(); ?></td>
          <?php
        ?>
      </tr>
      <?php
      for ($j = 1; $j < count($trackings_subitems); $j++) {
        $tracking = $trackings_subitems[$j];
        ?>
        <tr>
          <td class="align-middle text-center">
            <a href="<?php echo DELETE_TRACKING_SUBITEM . $tracking-> get_id(); ?>" class="mb-2 btn btn-warning"><i class="fas fa-trash"></i></a><br>
            <a href="#" data="<?php echo $tracking-> get_id(); ?>" class="edit_tracking_subitem btn btn-warning"><i class="fas fa-pen"></i></a>
          </td>
          <td><?php echo $tracking-> get_quantity(); ?></td>
          <td><?php echo nl2br($tracking-> get_tracking_number()); ?></td>
          <td><?php echo RepositorioRfqFullFillmentComment::mysql_date_to_english_format($tracking-> get_delivery_date()); ?></td>
          <td><?php echo $tracking-> get_signed_by(); ?></td>
        </tr>
        <?php
      }
    }
  }

  public static function print_accounting_subitem($subitem){
    if(!isset($subitem)){
      return;
    }
    ConnectionFullFillment::open_connection();
    $accounting_subitem_prices = AccountingSubitemPriceRepository::get_all_accounting_subitem_prices_by_id_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
    $real_cost_by_subitem = AccountingSubitemPriceRepository::get_real_cost_by_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
    ConnectionFullFillment::close_connection();
    if(!count($accounting_subitem_prices)){
      $quantity = 1;
    }else{
      $quantity = count($accounting_subitem_prices);
    }
    ?>
    <tr>
      <td class="align-middle text-center" rowspan="<?php echo $quantity; ?>">
        <button type="button" class="new_accounting_subitem_price_button btn btn-warning" name="<?php echo $subitem-> obtener_id(); ?>"><i class="fas fa-plus"></i></button>
      </td>
      <td rowspan="<?php echo $quantity; ?>"></td>
      <td rowspan="<?php echo $quantity; ?>">
        <?php
        echo '<b>Brand:</b> ' . $subitem-> obtener_brand() . '<br>';
        echo '<b>Part #:</b> ' . $subitem-> obtener_part_number() . '<br>';
        echo '<b>Description:</b> ' . nl2br(mb_substr($subitem-> obtener_description(), 0, 100));
        ?>
      </td>
      <td rowspan="<?php echo $quantity; ?>"><?php echo $subitem-> obtener_total_price(); ?></td>
      <?php
    if(count($accounting_subitem_prices)){
          ?>
          <td><a href="#" data="<?php echo $accounting_subitem_prices[0]-> get_id(); ?>" class="edit_accounting_subitem_price_button"><?php echo $accounting_subitem_prices[0]-> get_company(); ?></a></td>
          <td><?php echo $accounting_subitem_prices[0]-> get_quantity(); ?></td>
          <td><?php echo $accounting_subitem_prices[0]-> get_unit_cost(); ?></td>
          <td><?php echo $accounting_subitem_prices[0]-> get_other_cost(); ?></td>
          <td><?php echo $accounting_subitem_prices[0]-> get_real_cost(); ?></td>
          <td rowspan="<?php echo $quantity; ?>"><?php echo $subitem-> obtener_total_price() - $real_cost_by_subitem; ?></td>
      </tr>
      <?php
      for ($j = 1; $j < count($accounting_subitem_prices); $j++) {
        $accounting_subitem_price = $accounting_subitem_prices[$j];
        ?>
        <tr>
          <td><a href="#" data="<?php echo $accounting_subitem_price-> get_id(); ?>" class="edit_accounting_subitem_price_button"><?php echo $accounting_subitem_price-> get_company(); ?></a></td>
          <td><?php echo $accounting_subitem_price-> get_quantity(); ?></td>
          <td><?php echo $accounting_subitem_price-> get_unit_cost(); ?></td>
          <td><?php echo $accounting_subitem_price-> get_other_cost(); ?></td>
          <td><?php echo $accounting_subitem_price-> get_real_cost(); ?></td>
        </tr>
        <?php
      }
    }
  }
}
?>
