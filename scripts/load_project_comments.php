<?php
ConnectionFullFillment::open_connection();
$number_comments = ProjectCommentRepository::count_all_comments_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
ConnectionFullFillment::close_connection();
?>
<button class="btn btn-primary" id="show_project_comments_button" type="button" name="button"><i class="far fa-comment"></i> Comments(<?php echo $number_comments; ?>)</button>
