<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <title>
    Admin Dashboard
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Admin Dashboard"/>
  <meta property="og:description" content="Admin dashboard to manage teacher account"/>
  <meta property="og:type" content="website"/>
  <meta property="og:locale" content="vi"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <link href="../assets/css/main.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <main>
      <div class="content mx-auto" style="min-height: auto; max-width: 992px;">
        <div class="row justify-content-md-center">
          <div class="col-md-12 ">
            <div class="card" style="min-height:400px;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h5 class="title">Teacher Account</h5>
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-round" onclick="redirect_to_register()" style="margin-top:0px;width:100px !important;float:right !important;">NEW</button>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-block btn-round" onclick="log_out()" style="margin-top:0px;width:100px !important;float:right !important;">LOG OUT</button>
                  </div>
                </div>  
              </div>
              <div class="card-body">
                  <?php
                    include '../database/config.php';
                    $user_id = $_SESSION["user_id"];
                    $sql = "select * from teacher";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <div class="card" style="background:#ededed;">
                              <div class="card-body" onclick="submit(<?= $row['id'];?>)">
                                <h6><?= $row["username"];?></h6>
                                <div class="row">
                                  <div class="col-md-8">
                                    <p>Password - <?= $row["password"];?></p>
                                  </div>
                                </div>
                              </div>
                          </div>
                        <?php
                      }
                    }
                    else {
                      ?>
                      <div id="no-data">
                        <center>
                          <img src="../assets/img/no-data.svg" height="400" width="400"/>
                          <center><h5>No Data</h5></center>
                        </center>
                      </div>
                      <?php
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- footer -->
    <?php
      include "footer.php";
    ?>
    
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>
<script>
  function redirect_to_register() {
    window.location = "register.php";
  }

  function log_out() {
    window.location.replace("admin_logout.php");
  }

</script>
</html>