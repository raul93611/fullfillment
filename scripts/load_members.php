<?php
ConnectionFullFillment::open_connection();
$members = MemberRepository::get_all_members_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
ConnectionFullFillment::close_connection();
if(count($members)){
  ?>
  <div class="list-group">
    <?php
    foreach ($members as $key => $member) {
      ?>
      <a href="#" data="<?php echo $member-> get_id(); ?>" class="edit_member_button list-group-item list-group-item-action"><?php echo $member-> get_names(); ?></a>
      <?php
    }
    ?>
  </div>
  <?php
}
?>
