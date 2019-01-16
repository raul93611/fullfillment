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
        <?php
        if ($level == 1) {
        ?>
        <li class="nav-item has-treeview menu-open">
          <a href="<?php echo SIGN_IN; ?>" class="nav-link
          <?php
          if ($current_manager == 'sign_in') {
            echo 'active';
          }
          ?>
             ">
            <i class="fa fa-users nav-icon"></i>
            <p>User register</p>
          </a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item has-treeview
        <?php
        if($current_manager == 'received' || $current_manager == 'in_process' || $current_manager == 'invoices'){
          echo 'menu-open';
        }
        ?>
        ">
          <a href="#" class="nav-link
            <?php
            if($current_manager == 'received' || $current_manager == 'in_process' || $current_manager == 'invoices'){
              echo 'active';
            }
            ?>
            ">
            <i class="fas fa-tag nav-icon"></i>
            <p>RFQ Team</p>
            <i class="right fa fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo RECEIVED_QUOTES; ?>" class="nav-link
                <?php
                if($current_manager == 'received'){
                  echo 'active';
                }
                ?>
                ">
                <p>Received</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo IN_PROCESS_QUOTES; ?>" class="nav-link
                <?php
                if($current_manager == 'in_process'){
                  echo 'active';
                }
                ?>
                ">
                <p>In process</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo INVOICES; ?>" class="nav-link
                <?php
                if($current_manager == 'invoices'){
                  echo 'active';
                }
                ?>
                ">
                <p>Invoices</p>
              </a>
            </li>
          </ul>
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo EMPLOYEE_DOCS_PAGE; ?>" class="nav-link
            <?php
            if ($current_manager == 'employee_docs_page') {
              echo 'active';
            }
            ?>
               ">
              <i class="fas fa-file nav-icon"></i>
              <p>Employee docs</p>
            </a>
          </li>
        </li>
      </ul>
    </nav>
  </div>
</aside>
