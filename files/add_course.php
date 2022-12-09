<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

include '../database/config.php';
if(isset($_POST['new_course'])) {
  $course_id = $_POST['course_id'];
  $course_name = $_POST['course_name'];
  $teacher_id = $_SESSION["user_id"];

  
  $course_id = mysqli_real_escape_string($conn,$course_id);
  
  $course_name = mysqli_real_escape_string($conn,$course_name);
  
  //creating new course
  $sql = "SELECT * FROM course WHERE teacher_id = '$teacher_id' and course_name = '$course_name' and course_id = '$course_id'";
  $result = mysqli_query($conn,$sql);

  if(mysqli_num_rows($result) > 0) {
    $_SESSION["insert_error"] = "Duplicate course";
  } else {
    $sql = "INSERT INTO course(course_id, course_name, teacher_id) VALUES('$course_id','$course_name','$teacher_id')";
    $result = mysqli_query($conn,$sql);
    $course_id = mysqli_insert_id($conn);
  }

  header("Location: dashboard.php");
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
  <meta name="description" content="Add course for teacher in Quizller "/>
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <title>
    Quizller-Add course
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Add course"/>
  <meta property="og:description" content="Teacher add new course with course name and course id here"/>
  <meta property="og:type" content="website"/>
  <meta property="og:locale" content="en"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <div class="col-md-2"></div>  
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Create New Course</h5>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="hidden" name="new_course">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Course ID</label>
                            <input required pattern="\S(.*\S)?" title="no whitespace or tab "type="text" class="form-control" name="course_id" placeholder="Course ID" required/>
                        </div>
                        <div class="form-group">
                          <label>Course Name</label>
                            <input required pattern="\S(.*\S)?" title="no whitespace or tab " type="text" class="form-control" name="course_name" placeholder="Course Name" required/>
                        </div>
                      </div>
                    </div>
                    <div class="row center-element">
                      <div class="col-md-8">
                        <div class="form-group">
                          <button class="btn btn-primary btn-block btn-round">CREATE COURSE</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-2"></div>
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
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
</body>
</html>