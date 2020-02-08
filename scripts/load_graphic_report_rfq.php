<?php
list($users_array, $received_array, $colors) = RfqFullFillmentPartRepository::rfq_table_report($_POST['date_from'], $_POST['date_to']);
?>
<input type="hidden" id="users_array" value='<?php echo json_encode($users_array); ?>'>
<input type="hidden" id="received_array" value='<?php echo json_encode($received_array); ?>'>
<input type="hidden" id="colors" value='<?php echo json_encode($colors); ?>'>
