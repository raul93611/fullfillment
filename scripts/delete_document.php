<?php
header('Content-Type: application/json');
$archivo = str_replace('%20', ' ', $archivo);
$archivo = str_replace('%23', '#', $archivo);
/*if(*/unlink($_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $id_rfq . '/' . $archivo);/*){*/
  //Redirection::redirect(EDIT_QUOTE . $id_rfq);
//}
echo json_encode(array(
  'result'=> '1'
));
?>
