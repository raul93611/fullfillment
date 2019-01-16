<?php
$directorio = $_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $id_rfq;
$documentos = array_filter($_FILES['file_input']['name']);
$total = count($documentos);
for ($i = 0; $i < $total; $i++) {
  $tmp_path = $_FILES['file_input']['tmp_name'][$i];
  $file = $_FILES['file_input']['name'][$i];
  if ($tmp_path != '') {
    $file = preg_replace('/[^a-z0-9-_\-\.]/i','_',$file);
    $new_path = $directorio . '/' . $file;
    move_uploaded_file($tmp_path, $new_path);
  }
}
echo 0;
?>
