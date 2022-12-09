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
    Quizller-Add Test
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Add Test"/>
  <meta property="og:description" content="Teacher create test with multiple questions for a course and install pdf file"/>
  <meta property="og:type" content="website"/>
  <meta property="og:locale" content="en"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- <link type="text/css" rel="stylesheet" href="http://jqueryte.com/css/jquery-te.css" charset="utf-8"> -->
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
          <div class="row mx-auto align-items-center justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h5 class="title" style="text-align:center">Add New Test</h5>
                </div>
                <div class="card-body">
                  <form method="POST" action="add_test_question.php">
                    <input type="hidden" name="general_settings">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Test for:</label>
                          <input required pattern="\S(.*\S)?" title="no whitespace or tab "type="text" class="form-control" id = "test_name" name="test_name" placeholder="Test name"/>
                        </div>
                        <div class="form-group">
                          <label>Exam time (MINUTES)</label>
                          <input type="number"
                            min="1"
                            step="1"
                            onfocus="this.previousValue = this.value"
                            onkeydown="this.previousValue = this.value"
                            oninput="validity.valid || (value = this.previousValue)" class="form-control" id = "time" name="time" placeholder="Exam time"/>
                        </div>
                        <div class="form-group">
                          <label>Course</label>
                          
                          <select class="form-control" id = "id_course" name="id_course">
                            <?php
                              include '../database/config.php';
                              $user_id = $_SESSION["user_id"];
                              echo $user_id;
                              $sql = "SELECT * from course where teacher_id = $user_id";
                              $result = mysqli_query($conn,$sql);
                              $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
                              foreach($courses as $course){
                                $id_course = $course['id'];
                                $course_id = $course['course_id'];
                                $course_name = $course['course_name'];
                                echo "<option value='$id_course'>$course_id - $course_name </option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row center-element">
                      <div class="col-md-8">
                        <div class="form-group"><br/>
                          <button class="btn btn-primary btn-block btn-round">CREATE</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->


  </script>
</body>
</html>