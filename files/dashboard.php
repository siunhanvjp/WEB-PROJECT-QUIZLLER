<?php

session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

if(isset($_SESSION["insert_error"])){
  echo "<script> alert('Duplicate course, cannot insert'); </script>";
  unset($_SESSION["insert_error"]);
}
  
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
    Quizller Dashboard
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Teacher Dashboard"/>
  <meta property="og:description" content="Dashboard for teacher view the current course, create, delete or edit course and question"/>
  <meta property="og:type" content="website"/>
  <meta property="og:locale" content="en"/>
  
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
    <!-- sidebar -->
    <?php
      include "sidebar.php";
    ?>
    <main>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <!-- <a class="navbar-brand" href="#pablo">Dashboard Basic Settings</a> -->
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">
        </div>
        <div class="content" style="min-height: auto;">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="min-height:400px;">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-8">
                      <h5 class="title">Course</h5>
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-primary btn-block btn-round" onclick="redirect_to_new_course()" style="margin-top:0px;width:100px !important;float:right !important;">NEW</button>
                    </div>
                  </div>  
                </div>
                <div class="card-body">
                    <?php
                      include '../database/config.php';
                      $user_id = $_SESSION["user_id"];
                      $sql = "select * from course where teacher_id = $user_id";
                      $result = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          ?>
                            <div id="<?= $row["id"]; ?>" class="card" style="background:#ededed;">
                                <div class="card-body" >
                                <div >
                                  <h6 onclick="submit(<?= $row['id'];?>)"><?= $row["course_name"];?></h6>
                                  <div class="row" style="display: flex; justify-content: space-between; align-items: center">
                                    <div class="col-md-8">
                                      <p>CourseID - <?= $row["course_id"];?></p>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-round" style="margin:0px;width:100px !important;" onclick="delete_course('<?= $row["id"]; ?>')">DELETE</button>
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

        <form method="POST" action="course_details.php" id="course_details">
          <input type="hidden" id="id_course" name="id_course">
        </form>
        <!-- footer -->
        <?php
          include "footer.php";
        ?>
      </div>
    </main>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
</body>
<script>
  function redirect_to_new_course() {
    window.location = "add_course.php";
  }

  function submit(val1) {
    document.getElementById("id_course").value = val1;
    document.getElementById("course_details").submit();
  }

  function delete_course(id_course) {
      var target = document.getElementById(id_course);
      target.style.display = 'none';
      $.ajax({
          type: 'POST',
          url: 'delete_course.php',
          data: {
            'id_course': id_course,
          },
          success: function (response) {
          }
      });
    }
</script>
</html>