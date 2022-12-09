<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<aside>
<div class="sidebar" data-color="orange">
    <div class="logo" style="padding:unset;">
      <a href="dashboard.php" class="simple-text logo-mini" style="width:100px;padding-left:10px;">
          <img src="../assets/img/logo.png"/>
        </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="<?=($activePage=='dashboard' || $activePage=='new_test' || $activePage=='test_details' || $activePage=='add_question' || $activePage=='student_test_credentials')? 'active': ''; ?>">
          <a href="./dashboard.php">
            <i class="now-ui-icons shopping_shop"></i>
            <p>Courses</p>
          </a>
        </li>
        <li class="<?=($activePage=='add_test')? 'active': ''; ?>">
          <a href="./add_test.php">
            <i class="now-ui-icons business_badge"></i>
            <p>Create Test</p>
          </a>
        </li>
        <li class="<?=($activePage=='logout')? 'active': ''; ?>">
          <a href="./logout.php">
            <i class="now-ui-icons media-1_button-power"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>