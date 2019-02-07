<?php
class RepositorioItemFullFillment{
  public static function insertar_item($conexion, $item) {
    $item_insertado = false;
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO item(id_rfq, id_usuario, provider_menor, brand, brand_project, part_number, part_number_project, description, description_project, quantity, unit_price, total_price, comments, website, additional) VALUES(:id_rfq, :id_usuario, :provider_menor, :brand, :brand_project, :part_number, :part_number_project, :description, :description_project, :quantity, :unit_price, :total_price, :comments, :website, :additional)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_rfq', $item->obtener_id_rfq(), PDO::PARAM_STR);
        $sentencia->bindParam(':id_usuario', $item->obtener_id_usuario(), PDO::PARAM_STR);
        $sentencia->bindParam(':provider_menor', $item->obtener_provider_menor(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand', $item->obtener_brand(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand_project', $item->obtener_brand_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number', $item->obtener_part_number(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number_project', $item->obtener_part_number_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':description', $item->obtener_description(), PDO::PARAM_STR);
        $sentencia->bindParam(':description_project', $item->obtener_description_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':quantity', $item->obtener_quantity(), PDO::PARAM_STR);
        $sentencia->bindParam(':unit_price', $item->obtener_unit_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':total_price', $item->obtener_total_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':comments', $item->obtener_comments(), PDO::PARAM_STR);
        $sentencia->bindParam(':website', $item->obtener_website(), PDO::PARAM_STR);
        $sentencia->bindParam(':additional', $item->obtener_additional(), PDO::PARAM_STR);
        $sentencia->execute();
        $id = $conexion->lastInsertId();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function actualizar_provider_menor_item($conexion, $provider_menor, $id_item){
    $item_editado = false;
    if(isset($conexion)){
      try{
        $sql = 'UPDATE item SET provider_menor = :provider_menor WHERE id = :id_item';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':provider_menor', $provider_menor, PDO::PARAM_STR);
        $sentencia-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia-> execute();
        if($sentencia){
          $item_editado = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $item_editado;
  }

  public static function obtener_items_por_id_rfq($conexion, $id_rfq) {
    $items = [];
    if (isset($conexion)) {
      try {
        $sql = 'SELECT * FROM item WHERE id_rfq = :id_rfq';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetchall(PDO::FETCH_ASSOC);
        if (count($resultado)) {
          foreach ($resultado as $fila) {
            $items[] = new Item($fila['id'], $fila['id_rfq'], $fila['id_usuario'], $fila['provider_menor'], $fila['brand'], $fila['brand_project'], $fila['part_number'], $fila['part_number_project'], $fila['description'], $fila['description_project'], $fila['quantity'], $fila['unit_price'], $fila['total_price'], $fila['comments'], $fila['website'], $fila['additional']);
          }
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $items;
  }

  public static function escribir_item($item, $i, $numeracion) {
    if (!isset($item)) {
      return;
    }
    $j = $i;
    ConnectionFullFillment::open_connection();
    $providers = RepositorioProviderFullFillment::obtener_providers_por_id_item(ConnectionFullFillment::get_connection(), $item->obtener_id());
    ConnectionFullFillment::close_connection();
    ?>
    <tr>
      <td>
        <a href="<?php echo ADD_PROVIDER . $item->obtener_id(); ?>" class="btn btn-warning btn-block">
          <i class="fa fa-plus-circle"></i> Add Provider
        </a>
        <br>
        <a href="<?php echo EDIT_ITEM . $item->obtener_id(); ?>" class="btn btn-warning btn-block">
          <i class="fa fa-edit"></i> Edit item
        </a>
        <br>
        <a href="<?php echo DELETE_ITEM . $item-> obtener_id(); ?>" class="delete_item_button btn btn-warning btn-block">
          <i class="fa fa-trash"></i> Delete
        </a>
        <br>
        <a href="<?php echo ADD_SUBITEM . $item-> obtener_id(); ?>" class="btn btn-warning btn-block">
          <i class="fa fa-plus-circle"></i> Add subitem
        </a>
        <br>
        <a href="<?php echo $item-> obtener_id(); ?>" class="payment_terms_item btn btn-warning btn-block">
          <i class="fas fa-edit"></i> Payment terms
        </a>
      </td>
      <td><?php echo $numeracion; ?></td>
    <?php
    if(strlen($item-> obtener_description_project()) >= 100){
      ?>
      <td>
        <b>Brand:</b> <?php echo $item->obtener_brand_project(); ?>
        <br>
        <b>Part #:</b> <?php echo $item->obtener_part_number_project(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br(mb_substr($item->obtener_description_project(), 0, 100)); ?> ...
      </td>
      <?php
    }else{
      ?>
      <td>
        <b>Brand:</b> <?php echo $item->obtener_brand_project(); ?>
        <br>
        <b>Part #:</b> <?php echo $item->obtener_part_number_project(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br($item->obtener_description_project()); ?>
      </td>
      <?php
    }
    if(strlen($item-> obtener_description()) >= 100){
      ?>
      <td>
        <b>Brand:</b> <?php echo $item->obtener_brand(); ?>
        <br>
        <b>Part #:</b> <?php echo $item->obtener_part_number(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br(mb_substr($item->obtener_description(), 0, 100)); ?> ...
      </td>
      <?php
    }else{
      ?>
      <td>
        <b>Brand:</b> <?php echo $item->obtener_brand(); ?>
        <br>
        <b>Part #:</b> <?php echo $item->obtener_part_number(); ?>
        <br>
        <b>Description:</b> <?php echo nl2br($item->obtener_description()); ?>
      </td>
      <?php
    }
    ?>
      <td class="estrechar">
        <a target="_blank" href="<?php echo $item-> obtener_website(); ?>"><?php echo $item-> obtener_website(); ?></a>
      </td>
      <td><?php echo $item->obtener_quantity(); ?></td>
      <td>
        <div class="row">
          <div class="col-6">
            <?php
            for ($i = 0; $i < count($providers); $i++) {
              $provider = $providers[$i];
              if(strlen($provider-> obtener_provider()) >= 10){
                ?>
                <a href="<?php echo EDIT_PROVIDER . $provider->obtener_id(); ?>">
                  <b><?php echo mb_substr($provider->obtener_provider(), 0, 10); ?>... :</b>
                </a>
                <br>
                <?php
              }else{
                ?>
                <a href="<?php echo EDIT_PROVIDER . $provider->obtener_id(); ?>">
                  <b><?php echo $provider->obtener_provider(); ?>:</b>
                </a>
                <br>
                <?php
              }
            }
            ?>
          </div>
          <div class="col-6">
            <?php
            for ($i = 0; $i < count($providers); $i++) {
              $provider = $providers[$i];
              echo '$ ' . $provider->obtener_price() . '<br>';
            }
            ?>
          </div>
        </div>
      </td>
    <?php
    if($item-> obtener_additional() != 0){
      ?>
      <td>
        <input type="text" class="form-control form-control-sm" id="add_cost<?php echo $j; ?>" size="10" value="<?php echo $item-> obtener_additional(); ?>">
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
    for ($i = 0; $i < count($providers); $i++) {
      $provider = $providers[$i];
      $precios[$i] = $provider->obtener_price();
    }
    if (!empty($precios)) {
      $best_unit_price = min($precios);
      for($i = 0;$i < count($precios); $i++){
        if($best_unit_price == $precios[$i]){
          ConnectionFullFillment::open_connection();
          self::actualizar_provider_menor_item(ConnectionFullFillment::get_connection(), $providers[$i]->obtener_id(), $item-> obtener_id());
          ConnectionFullFillment::close_connection();
        }
      }
      echo '$ ' . $best_unit_price;
    }
    echo '</td>';
    ?>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo nl2br($item->obtener_comments()); ?></td>
    </tr>
    <?php
    $j = RepositorioSubitemFullFillment::escribir_subitems($item-> obtener_id(), $j);
    return $j;
  }

  public static function escribir_items($id_rfq) {
    ConnectionFullFillment::open_connection();
    $cotizacion = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
    $rfq_fullfillment_part = RfqFullFillmentPartRepository::get_rfq_fullfillment_part_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
    $items = self::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
    ConnectionFullFillment::close_connection();
    if (count($items)) {
      ?>
      <div class="row">
        <div class="col-md-3">
        <?php
        if ($cotizacion->obtener_taxes() != 0) {
          ?>
          <label>Taxes (%):</label>
          <input type="hidden" name="taxes_original" value="<?php echo $cotizacion->obtener_taxes(); ?>">
          <input type="number" step=".01" name="taxes" id="taxes" class="form-control form-control-sm" value="<?php echo $cotizacion->obtener_taxes(); ?>">
          <?php
        } else {
          ?>
          <label>Taxes (%):</label>
          <input type="hidden" name="taxes_original" value="<?php echo $cotizacion->obtener_taxes(); ?>">
          <input type="number" step=".01" name="taxes" id="taxes" class="form-control form-control-sm" value="0">
          <?php
        }
        ?>
        </div>
        <div class="col-md-3">
        <?php
        if ($cotizacion->obtener_profit() != 0) {
          ?>
          <label>Profit (%):</label>
          <input type="hidden" name="profit_original" value="<?php echo $cotizacion->obtener_profit(); ?>">
          <input type="number" step=".01" name="profit" id="profit" class="form-control form-control-sm" value="<?php echo $cotizacion->obtener_profit(); ?>">
          <?php
        } else {
          ?>
          <label>Profit (%):</label>
          <input type="hidden" name="profit_original" value="<?php echo $cotizacion->obtener_profit(); ?>">
          <input type="number" step=".01" name="profit" id="profit" class="form-control form-control-sm" value="0">
          <?php
        }
        ?>
        </div>
        <div class="col-md-3">
        <?php
        if($cotizacion-> obtener_additional() != 0){
          ?>
          <label>Additional general ($):</label>
          <input type="hidden" name="additional_general_original" value="<?php echo $cotizacion->obtener_additional(); ?>">
          <input type="text" name="additional_general" id="additional_general" class="form-control form-control-sm" value="<?php echo $cotizacion->obtener_additional(); ?>">
          <?php
        }else{
          ?>
          <label>Additional general ($):</label>
          <input type="hidden" name="additional_general_original" value="<?php echo $cotizacion->obtener_additional(); ?>">
          <input type="text" name="additional_general" id="additional_general" class="form-control form-control-sm" value="0">
          <?php
        }
        ?>
        </div>
        <div class="col-md-3">
          <label>Payment terms:</label>
          <div class="form-group">
            <div class="form-check-inline">
              <input class="form-check-input" type="radio" id="net_30" value="Net 30" name="payment_terms"
              <?php
              if ($cotizacion->obtener_payment_terms() == 'Net 30') {
                echo 'checked';
              }
              ?>
              ><label class="form-check-label" for="net_30">Net 30</label>
            </div>
            <div class="form-check-inline">
              <input class="form-check-input" type="radio" id="net_30cc" value="Net 30/CC" name="payment_terms"
              <?php
              if ($cotizacion->obtener_payment_terms() == 'Net 30/CC') {
                echo 'checked';
              }
              ?>
              ><label class="form-check-label" for="net_30cc">Net 30/CC</label>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="table-responsive">
        <table id="tabla_items" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="options">Options</th>
              <th id="numeracion">#</th>
              <th class="description">PROJECT SPECIFICATIONS</th>
              <th class="description">E-LOGIC PROPOSAL</th>
              <th class="options">WEBSITE</th>
              <th class="qty">QTY</th>
              <th id="provider">PROVIDERS</th>
              <th class="qty">ADDITIONAL</th>
              <th class="options">BEST UNIT COST</th>
              <th class="options">TOTAL COST</th>
              <th class="options">PRICE FOR CLIENT</th>
              <th class="options">TOTAL PRICE</th>
              <th class="description">COMMENTS</th>
            </tr>
          </thead>
          <tbody id="items">
            <?php
            $k = 1;
            for ($i = 0; $i < count($items); $i++) {
              $item = $items[$i];
              $k = self::escribir_item($item, $k, $i+1);
            }
            ?>
            <td colspan="5" class="display-4"><b><h4>TOTAL:</h4></b></td>
            <td id="total_quantity"></td>
            <td></td>
            <td id="total_additional"></td>
            <td></td>
            <td id="total1"></td>
            <td></td>
            <td id="total2"></td>
          </tbody>
        </table>
      </div>
      <?php
      $id_items = '';
      $id_subitems = '';
      $contador_subitems = 0;
      for($i = 0; $i < count($items); $i++){
        $item = $items[$i];
        if($i == 0){
          $id_items = $id_items . $item-> obtener_id();
        }else{
          $id_items = $id_items . ',' . $item-> obtener_id();
        }
        ConnectionFullFillment::open_connection();
        $subitems = RepositorioSubitemFullFillment::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $item-> obtener_id());
        ConnectionFullFillment::close_connection();
        for($j = 0; $j < count($subitems); $j++){
          $subitem = $subitems[$j];
          if($contador_subitems == 0){
            $id_subitems = $id_subitems . $subitem-> obtener_id();
          }else{
            $id_subitems = $id_subitems . ',' . $subitem-> obtener_id();
          }
          $contador_subitems++;
        }
      }
      ?>
      <input type="hidden" id="id_items" name="id_items" value="<?php echo $id_items; ?>">
      <input type="hidden" id="id_subitems" name="id_subitems" value="<?php echo $id_subitems; ?>">
      <input type="hidden" id="partes_total_price" name="partes_total_price" value="">
      <input type="hidden" id="partes_total_price_subitems" name="partes_total_price_subitems" value="">
      <input type="hidden" id="additional" name="additional" value="">
      <input type="hidden" id="additional_subitems" name="additional_subitems" value="">
      <input type="hidden" id="unit_prices" name="unit_prices" value="">
      <input type="hidden" id="unit_prices_subitems" name="unit_prices_subitems" value="">
      <input type="hidden" id="total_cost" name="total_cost" value="">
      <input type="hidden" id="total_price" name="total_price" value="">
      <br>
      <label>Shipping:</label>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <textarea class="form-control form-control-sm" rows="1" id="shipping" name="shipping" placeholder="Enter shipping ..."><?php echo $cotizacion->obtener_shipping(); ?></textarea>
            <input type="hidden" name="shipping_original" value="<?php echo $cotizacion->obtener_shipping(); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="number" step=".01" class="form-control form-control-sm" id="shipping_cost" name="shipping_cost" value="<?php echo $cotizacion->obtener_shipping_cost(); ?>">
            <input type="hidden" name="shipping_cost_original" value="<?php echo $cotizacion->obtener_shipping_cost(); ?>">
          </div>
        </div>
      </div>
      <label>Consolidate & others:</label>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <textarea class="form-control form-control-sm" rows="1" name="comment_consolidate_others" ><?php echo $rfq_fullfillment_part-> get_comment_consolidate_others(); ?></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="number" step=".01" class="form-control form-control-sm" id="consolidate_others" name="consolidate_others" value="<?php echo $rfq_fullfillment_part-> get_consolidate_others(); ?>">
          </div>
        </div>
      </div>
      <?php
    }
  }

  public static function tracking_list_item($item, $i){
    if(!isset($item)){
      return;
    }
    ConnectionFullFillment::open_connection();
    $trackings = TrackingRepository::get_all_trackings_by_id_item(ConnectionFullFillment::get_connection(), $item-> obtener_id());
    ConnectionFullFillment::close_connection();
    if(!count($trackings)){
      $trackings_quantity = 1;
    }else{
      $trackings_quantity = count($trackings);
    }
    ?>
    <tr>
      <td class="align-middle text-center" rowspan="<?php echo $trackings_quantity; ?>">
        <button type="button" class="add_tracking_button btn btn-warning" name="<?php echo $item-> obtener_id(); ?>"><i class="fas fa-plus"></i></button>
      </td>
      <td rowspan="<?php echo $trackings_quantity; ?>"><?php echo $i + 1; ?></td>
      <td rowspan="<?php echo $trackings_quantity; ?>">
        <?php
        echo '<b>Brand:</b> ' . $item-> obtener_brand_project() . '<br>';
        echo '<b>Part #:</b> ' . $item-> obtener_part_number_project() . '<br>';
        echo '<b>Description:</b> ' . nl2br(mb_substr($item->obtener_description_project(), 0, 100));
        ?>
      </td>
      <td rowspan="<?php echo $trackings_quantity; ?>"><?php echo $item-> obtener_quantity(); ?></td>
      <?php
  if(count($trackings)){
        ?>
        <td class="align-middle text-center">
          <a href="<?php echo DELETE_TRACKING . $trackings[0]-> get_id(); ?>" class="btn btn-warning"><i class="fas fa-trash"></i></a>
        </td>
        <td><?php echo $trackings[0]-> get_quantity(); ?></td>
        <td><?php echo $trackings[0]-> get_tracking_number(); ?></td>
        <td><?php echo RepositorioRfqFullFillmentComment::mysql_date_to_english_format($trackings[0]-> get_delivery_date()); ?></td>
        <td><?php echo $trackings[0]-> get_signed_by(); ?></td>
        <?php
      ?>
    </tr>
    <?php
    for ($j = 1; $j < count($trackings); $j++) {
      $tracking = $trackings[$j];
      ?>
      <tr>
        <td class="align-middle text-center">
          <a href="<?php echo DELETE_TRACKING . $tracking-> get_id(); ?>" class="btn btn-warning"><i class="fas fa-trash"></i></a>
        </td>
        <td><?php echo $tracking-> get_quantity(); ?></td>
        <td><?php echo nl2br($tracking-> get_tracking_number()); ?></td>
        <td><?php echo RepositorioRfqFullFillmentComment::mysql_date_to_english_format($tracking-> get_delivery_date()); ?></td>
        <td><?php echo $tracking-> get_signed_by(); ?></td>
      </tr>
      <?php
    }
  }
    ConnectionFullFillment::open_connection();
    $subitems = RepositorioSubitemFullFillment::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $item-> obtener_id());
    ConnectionFullFillment::close_connection();
    foreach ($subitems as $subitem) {
      RepositorioSubitemFullFillment::tracking_list_subitem($subitem);
    }
  }

  public static function tracking_list_items($id_rfq){
    ConnectionFullFillment::open_connection();
    $quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
    $items = self::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
    ConnectionFullFillment::close_connection();
    if(count($items)){
      ?>
      <div class="table-responsive">
        <table id="tracking_table" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="thin">OPTIONS</th>
              <th class="thin">#</th>
              <th class="description">PROJECT SPECIFICATIONS</th>
              <th class="thin">QTY(ordered)</th>
              <th class="thin">OPTIONS</th>
              <th class="thin">QTY(shipped)</th>
              <th>TRACKING</th>
              <th>DELIVERY DATE</th>
              <th>SIGNED BY</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($items as $i => $item) {
              self::tracking_list_item($item, $i);
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
    }
  }

  public static function obtener_item_por_id($conexion, $id_item) {
    $item = null;
    if (isset($conexion)) {
      try {
        $sql = 'SELECT * FROM item WHERE id = :id_item';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        if (!empty($resultado)) {
          $item = new Item($resultado['id'], $resultado['id_rfq'], $resultado['id_usuario'], $resultado['provider_menor'], $resultado['brand'], $resultado['brand_project'], $resultado['part_number'], $resultado['part_number_project'], $resultado['description'], $resultado['description_project'], $resultado['quantity'], $resultado['unit_price'], $resultado['total_price'], $resultado['comments'], $resultado['website'], $resultado['additional']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $item;
  }

  public static function actualizar_item($conexion, $id_item, $brand, $brand_project, $part_number, $part_number_project, $description, $description_project, $quantity, $comments, $website) {
    $item_editado = false;
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE item SET brand = :brand, brand_project = :brand_project, part_number = :part_number, part_number_project = :part_number_project, description = :description, description_project = :description_project, quantity = :quantity, comments = :comments, website = :website WHERE id = :id_item';
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
        $sentencia->bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia->execute();
        if ($sentencia) {
          $item_editado = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $item_editado;
  }

  public static function delete_item($conexion, $id_item){
    if(isset($conexion)){
      try{
        $conexion -> beginTransaction();
        $sql1 = "DELETE FROM provider WHERE id_item = :id_item";
        $sentencia1 = $conexion-> prepare($sql1);
        $sentencia1-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia1-> execute();
        $sql2 = "DELETE FROM item WHERE id = :id_item";
        $sentencia2 = $conexion-> prepare($sql2);
        $sentencia2-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia2-> execute();
        $conexion-> commit();
      } catch (PDOException $ex) {
        print "ERROR:" . $ex->getMessage() . "<br>";
        $conexion-> rollBack();
      }
    }
  }

  public static function insertar_calculos($conexion, $unit_price, $total_price, $additional, $id_item){
    $item_editado = false;
    if(isset($conexion)){
      try{
        $sql = 'UPDATE item SET unit_price = :unit_price, total_price = :total_price, additional = :additional WHERE id = :id_item';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':unit_price', $unit_price, PDO::PARAM_STR);
        $sentencia-> bindParam(':total_price', $total_price, PDO::PARAM_STR);
        $sentencia-> bindParam(':additional', $additional, PDO::PARAM_STR);
        $sentencia-> bindParam(':id_item', $id_item, PDO::PARAM_STR);
        $sentencia-> execute();
        if($sentencia){
          $item_editado = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $item_editado;
  }
}
?>
