<form role="form" id="form_edited_quote" method="post" enctype="multipart/form-data" action="<?php echo SAVE_QUOTE; ?>">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-highlighter"></i> Enter the data</h3>
    </div>
    <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
    <input type="hidden" name="id_rfq_fullfillment_part" value="<?php echo $rfq_fullfillment_part-> get_id(); ?>">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 mb-1 mt-1">
          <a href="<?php echo TRACKING . $quote-> obtener_id(); ?>" class="btn btn-primary btn-block"><i class="fas fa-file"></i> Tracking</a>
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
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Code:</label>
            <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_email_code(); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Type of bid:</label>
            <input type="text" class="form-control form-control-sm" disabled value="<?php echo $quote-> obtener_type_of_bid(); ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Channel:</label>
            <input type="text" class="form-control form-control-sm" id="channel" disabled value="<?php echo $quote-> obtener_canal(); ?>">
          </div>
        </div>
        <div class="col-md-6">
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
      <div class="form-group">
        <label for="ship_via">Ship via:</label>
        <select id="ship_via" class="form-control form-control-sm" disabled name="ship_via">
          <option <?php if ($quote->obtener_ship_via() == 'GROUND') { echo 'selected';} ?>>GROUND</option>
          <option <?php if ($quote->obtener_ship_via() == 'BEST WAY') { echo 'selected';} ?>>BEST WAY</option>
        </select>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="contract_number">Contract number:</label>
            <input type="text" class="form-control form-control-sm" name="contract_number" value="<?php echo $quote-> obtener_contract_number(); ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="address">Address:</label>
              <textarea class="form-control form-control-sm" rows="5" placeholder="Enter address ..." id="address" name="address"><?php echo $quote->obtener_address(); ?></textarea>
              <input type="hidden" name="addres_original" value="<?php echo $quote->obtener_address(); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="ship_to">Ship to:</label>
              <textarea class="form-control form-control-sm" rows="5" placeholder="Enter ship to ..." id="ship_to" name="ship_to"><?php echo $quote->obtener_ship_to(); ?></textarea>
              <input type="hidden" name="ship_to_original" value="<?php echo $quote->obtener_ship_to(); ?>">
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="rfq_fullfillment_part_name">Name:</label>
            <input type="text" class="form-control form-control-sm" name="rfq_fullfillment_part_name" id="rfq_fullfillment_part_name" value="<?php echo $rfq_fullfillment_part-> get_name(); ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="po_date">P.O. date:</label>
            <input type="text" class="form-control form-control-sm" name="po_date" id="po_date" value="<?php if($po_date != '00/00/0000'){echo $po_date;} ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="business_classification">Business classification:</label>
            <select class="form-control form-control-sm" name="business_classification" id="business_classification">
              <option value="small_business" <?php if($rfq_fullfillment_part-> get_business_classification() == 'small_business'){echo 'selected';} ?>>Small business</option>
              <option value="8a" <?php if($rfq_fullfillment_part-> get_business_classification() == '8a'){echo 'selected';} ?>>8A</option>
              <option value="hubzone" <?php if($rfq_fullfillment_part-> get_business_classification() == 'hubzone'){echo 'selected';} ?>>HUBZONE</option>
              <option value="full_and_open" <?php if($rfq_fullfillment_part-> get_business_classification() == 'full_and_open'){echo 'selected';} ?>>Full and open</option>
              <option value="gsa" <?php if($rfq_fullfillment_part-> get_business_classification() == 'gsa'){echo 'selected';} ?>>GSA</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="eta">ETA1:</label>
            <input type="text" class="eta form-control form-control-sm" name="eta1" value="<?php if($eta1 != '00/00/0000'){echo $eta1;} ?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="eta">ETA2:</label>
            <input type="text" class="eta form-control form-control-sm" name="eta2" value="<?php if($eta2 != '00/00/0000'){echo $eta2;} ?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="eta">ETA3:</label>
            <input type="text" class="eta form-control form-control-sm" name="eta3" value="<?php if($eta3 != '00/00/0000'){echo $eta3;} ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header" id="final_quote_toggle">
      <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> RFQ Quote <a class="float-right" target="_blank" href="<?php echo QUOTE_PDF_ITEMS_TABLE . $quote-> obtener_id(); ?>"><i class="fas fa-file"></i></a></h3>
    </div>
    <div class="card-body" id="final_quote">
      <?php
      RepositorioRfq::print_final_quote($quote-> obtener_id());
      ?>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header" id="final_re_quote_toggle">
      <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> RFQ Re-Quote <a class="float-right" target="_blank" href="<?php echo RE_QUOTE_PDF_ITEMS_TABLE . $quote-> obtener_id(); ?>"><i class="fas fa-file"></i></a></h3>
    </div>
    <div class="card-body" id="final_re_quote">
      <?php
      ReQuoteRepository::print_final_re_quote($quote-> obtener_id());
      ?>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> Fulfillment Re-quote</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Total cost:</label>
            <input type="number" step=".01" class="form-control form-control-sm" name="total_cost" value="<?php echo $quote-> obtener_total_cost(); ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Total price:</label>
            <input type="text" disabled class="form-control form-control-sm" value="<?php echo $quote-> obtener_total_price(); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-file"></i> Documents</h3>
    </div>
    <div class="card-body">
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
      if($rfq_fullfillment_part-> get_invoice()){

      }else if($rfq_fullfillment_part-> get_in_process()){
        ?>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="invoice" class="custom-control-input" id="invoice" value="invoice">
          <label class="custom-control-label" for="invoice">Invoice</label>
        </div>
        <?php
      }else if($quote-> obtener_fullfillment()){
        ?>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="in_process" class="custom-control-input" id="in_process" value="in_process">
          <label class="custom-control-label" for="in_process">In process</label>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <div class="card-footer footer_item" id="footer_lg">
    <a class="btn btn-primary" id="go_back" href="
    <?php
    if($rfq_fullfillment_part-> get_invoice()){
      echo INVOICES;
    }else if($rfq_fullfillment_part-> get_in_process()){
      echo IN_PROCESS_QUOTES;
    }else if($quote-> obtener_fullfillment()){
      echo RECEIVED_QUOTES;
    }
    ?>
    "><i class="fa fa-reply"></i></a>
    <button type="submit" class="btn btn-success" id="save_item" name="guardar_cambios_cotizacion"><i class="fa fa-check"></i> Save</button>
    <a class="btn btn-primary add_item_charter" href="<?php echo ADD_ITEM . $quote->obtener_id(); ?>"><i class="fa fa-plus-circle"></i> Add item</a>
    <a href="#" id="add_comment" class="btn btn-primary add_item_charter"><i class="fas fa-plus"></i> Add comment</a>
    <div class="btn-group dropup">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-file"></i> Docs
      </button>
      <div class="dropdown-menu">
        <a href="<?php echo NEW_PURCHASE_ORDER . $quote-> obtener_id(); ?>" class="dropdown-item">New P.O.</a>
        <a href="<?php echo NEW_WORK_ORDER . $quote-> obtener_id(); ?>" class="dropdown-item">New work order</a>
      </div>
    </div>
  </div>
</form>
