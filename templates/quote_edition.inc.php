<input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="contract_number">Contract number:</label>
        <input type="text" class="form-control form-control-sm" name="contract_number" value="<?php echo $quote-> obtener_contract_number(); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Code:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_email_code(); ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Type of bid:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_type_of_bid(); ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Issue date:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_issue_date(); ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>End date:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_end_date(); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Proposal:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_id(); ?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Channel:</label>
        <input type="text" class="form-control form-control-sm" id="channel" disabled value="<?php echo $quote-> obtener_canal(); ?>">
      </div>
    </div>
    <div class="col-md-4">
      <?php
        Conexion::abrir_conexion();
        $usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $quote-> obtener_usuario_designado());
        Conexion::cerrar_conexion();
        ?>
        <div class="form-group">
          <label for="usuario_designado">Designated user:</label>
          <input type="text" class="form-control form-control-sm" disabled value="<?php echo $usuario-> obtener_nombre_usuario(); ?>">
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-1 mt-1">
      <a href="<?php echo TRACKING . $quote-> obtener_id(); ?>" class="btn btn-primary btn-block"
        <?php
        if($quote-> obtener_canal() != 'FedBid'){
          echo 'disabled';
        }
        ?>
        ><i class="fas fa-file"></i> Tracking</a>
    </div>
    <div class="col-md-3 mb-1 mt-1">
      <button type="button" id="purchase_orders_button" name="<?php echo $quote-> obtener_id(); ?>" class="btn btn-primary btn-block"><i class="fas fa-file"></i> Purchase order</button>
    </div>
    <div class="col-md-3 mb-1 mt-1">
      <button type="button" id="work_orders_button" name="<?php echo $quote-> obtener_id(); ?>" class="btn btn-primary btn-block"><i class="fas fa-file"></i> Work order</button>
    </div>
    <div class="col-md-3 mb-2 mt-1">
      <a href="<?php echo PACKING_SLIP . $quote-> obtener_id(); ?>" class="btn btn-primary btn-block"><i class="fas fa-file"></i> Packing slip</a>
    </div>
  </div>
  <br>
  <label>Documents:</label>
  <?php
  $directory = $_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $quote-> obtener_id();
  if (is_dir($directory)) {
    $manager = opendir($directory);
    $folder = @scandir($directory);
    if(count($folder) <= 2){
    }
    $files = [];
    while (($file = readdir($manager)) !== false) {
      $complete_directory = $directory . "/" . $file;
      if ($file != "." && $file != "..") {
        $files[] = $file;
      }
    }
    $files = implode(',', $files);
    ?>
    <input type="hidden" id="files" value="<?php echo $files; ?>">
    <?php
    closedir($manager);
  }
  ?>
  <input type="file" id="file_input" multiple name="file_input[]">
  <br>
  <?php
  RepositorioItemFullFillment::escribir_items($quote-> obtener_id());
  ConnectionFullFillment::open_connection();
  $items = RepositorioItemFullFillment::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $quote->obtener_id());
  ConnectionFullFillment::close_connection();
  if(count($items)){
    ?>
    <br>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <textarea class="form-control form-control-sm" rows="3" id="shipping" name="shipping" placeholder="Enter shipping ..."><?php echo $quote->obtener_shipping(); ?></textarea>
          <input type="hidden" name="shipping_original" value="<?php echo $quote->obtener_shipping(); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="number" step=".01" class="form-control form-control-sm" id="shipping_cost" name="shipping_cost" value="<?php echo $quote->obtener_shipping_cost(); ?>">
          <input type="hidden" name="shipping_cost_original" value="<?php echo $quote->obtener_shipping_cost(); ?>">
        </div>
      </div>
    </div>
    <?php
  }
  ?>
