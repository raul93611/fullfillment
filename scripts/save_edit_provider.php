<?php
session_start();
if (isset($_POST['guardar_cambios_provider'])) {
  ConnectionFullFillment::open_connection();
  $provider_editado = RepositorioProviderFullFillment::actualizar_provider(ConnectionFullFillment::get_connection(), $_POST['id_provider'], $_POST['provider'], $_POST['price']);
  ConnectionFullFillment::close_connection();
  if($provider_editado){
    Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
  }
}
?>
