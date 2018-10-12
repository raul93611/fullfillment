<?php
session_start();
if (isset($_POST['guardar_cambios_provider_subitem'])) {
  ConnectionFullFillment::open_connection();
  RepositorioProviderSubitemFullFillment::actualizar_provider_subitem(ConnectionFullFillment::get_connection(), $_POST['id_provider_subitem'], $_POST['provider'], $_POST['price']);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
}
?>
