<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $_POST['id_fulfillment_project']);
$directory = $_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfp_team/' . $fulfillment_project-> get_id_project();
$documents = array_filter($_FILES['files']['name']);
$total = count($documents);
$documents_name = [];
for ($i = 0; $i < $total; $i++) {
  $tmp_path = $_FILES['files']['tmp_name'][$i];
  $file = $_FILES['files']['name'][$i];
  $file = preg_replace('/[^a-z0-9-_\-\.]/i','_',$file);
  $documents_name[] = $file;
  if ($tmp_path != '') {
    $new_path = $directory . '/' . $file;
    move_uploaded_file($tmp_path, $new_path);
  }
}
$documents_name = implode(',', $documents_name);
$project_document = new ProjectDocument('', $_POST['id_fulfillment_project'], $documents_name, htmlspecialchars($_POST['comment']), '', $_SESSION['username']);
ProjectDocumentRepository::insert_document(ConnectionFullFillment::get_connection(), $project_document);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> '2'
));
?>
