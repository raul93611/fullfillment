<input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
<div class="card-body">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label>Code:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_email_code(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label>Type of bid:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_type_of_bid(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label>Issue date:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_issue_date(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label>End date:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_end_date(); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label>Proposal:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_id(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label>Channel:</label>
        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_canal(); ?>">
      </div>
    </div>
    <div class="col">
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
  <label>Documents:</label>
  <?php
  $directory = $_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $quote-> obtener_id();
  if (is_dir($directory)) {
    $manager = opendir($directory);
    echo '<div class="list-group">';
    $folder = @scandir($directory);
    if(count($folder) <= 2){
      echo '<h3 class="text-center text-danger"><i class="fa fa-times"></i> No files!</h3>';
    }
    while (($file = readdir($manager)) !== false) {
      $completed_directory = $directory . "/" . $file;
      if ($file != "." && $file != "..") {
        $url_file = str_replace(' ', '%20', $file);
        $url_file = str_replace('#', '%23', $url_file);
        echo '<li class="list-group-item"><a download href="' . DOCS_RFQ . $quote-> obtener_id() . '/' . $url_file . '">' . $file . '</a><a href="' . DELETE_DOCUMENT . $quote-> obtener_id() . '/' . $url_file . '" class="delete_document_button close"><span aria-hidden="true">&times;</span></a></li>';
      }
    }

    closedir($manager);
    echo "</div>";
  }
  ?>
  <br>
  <div class="form-group">
    <label for="documents">Upload documents:</label><br>
    <div class="custom-file">
      <input type="file" name="documents[]" multiple class="custom-file-input" id="file_input_info_create">
      <label id="label_file_create" class="custom-file-label" for="file_input_info_create">Choose file</label>
    </div>
  </div>
  <?php
  RepositorioItemFullFillment::escribir_items($quote-> obtener_id());
  ConnectionFullFillment::open_connection();
  $items = RepositorioItemFullFillment::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $quote->obtener_id());
  ConnectionFullFillment::close_connection();
  if(count($items)){
    ?>
    <br>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <textarea class="form-control form-control-sm" rows="3" id="shipping" name="shipping" placeholder="Enter shipping ..."><?php echo $quote->obtener_shipping(); ?></textarea>
          <input type="hidden" name="shipping_original" value="<?php echo $quote->obtener_shipping(); ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <input type="number" step=".01" class="form-control form-control-sm" id="shipping_cost" name="shipping_cost" value="<?php echo $quote->obtener_shipping_cost(); ?>">
          <input type="hidden" name="shipping_cost_original" value="<?php echo $quote->obtener_shipping_cost(); ?>">
        </div>
      </div>
    </div>
    <?php
  }
  ?>
