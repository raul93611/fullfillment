<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?php echo PROFILE; ?>" class="brand-link">
    <img src="<?php echo IMG; ?>eP_perfil.png" alt="E-logic" style="width:35px;height:35px;" class="brand-image img-thumbnail elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">E-logic</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo IMG; ?>user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $user->get_username(); ?></a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?php echo PROFILE; ?>" class="nav-link
          <?php
          if ($current_manager == '') {
            echo 'active';
          }
          ?>
             ">
            <i class="fa fa-th nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="<?php echo RFQ_TEAM; ?>" class="nav-link
            <?php
            if($current_manager == 'rfq_team'){
              echo 'active';
            }
            ?>
            ">
            <i class="fas fa-tag nav-icon"></i>
            <p>RFQ Team</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
