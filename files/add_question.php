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
    Quizller-Add
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Add Question"/>
  <meta property="og:description" content="Teacher add new question with multiple choice and the correct answer for each course"/>
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
      <!--php code to redirect to the test details php after successfull question add-->
        <?php
          include '../database/config.php';
          $id_course = $_POST['id_course'];
          $user_id = $_SESSION["user_id"];
        ?>
        <form id="form-completed" method="POST" action="course_details.php">
            <input type="hidden" name="id_course" value="<?= $id_course;?>">
        </form>
        <script>
            function completed() {
              document.getElementById("form-completed").submit();
            }
        </script>
        <!-- handle question data -->
        <?php
          if(isset($_POST['add_question'])) {
            
            $title = strip_tags( trim( $_POST['title'] ) );
            $op_a = strip_tags( trim( $_POST['op_a'] ) );
            $op_b = strip_tags( trim( $_POST['op_b'] ) );
            $op_b = strip_tags( trim( $_POST['op_c'] ) );
            $op_d = strip_tags( trim( $_POST['op_d'] ) );
            $op_correct = $_POST['op_correct'];
            $level = $_POST['level'];
            $op_a = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $op_a);
            $op_b = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $op_b);
            $op_c = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $op_b);
            $op_d = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $op_d);
            $title = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $title);

            $op_correct_text = "";

            if($op_correct == "A" || $op_correct == "a") {
              $op_correct_text = "a";
            }
            else if($op_correct == "B" || $op_correct == "b") {
              $op_correct_text = "b";
            }
            else if($op_correct == "C" || $op_correct == "c") {
              $op_correct_text = "c";
            }
            else if($op_correct == "D" || $op_correct == "d") {
              $op_correct_text = "d";
            }
            
            
            $sql = "INSERT INTO Questions(title,optionA,optionB,optionC,optionD,correctAns,level, course_id, teacher_id) values('$title','$op_a','$op_b','$op_c','$op_d','$op_correct_text','$level','$id_course', '$user_id')";
            $result = mysqli_query($conn,$sql);
            if($result) {
              echo '<script type="text/javascript">',
                    'completed();',
                    '</script>';
            }
          }
        ?>

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
                <a class="navbar-brand" href="#pablo">Add New Question</a>
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
                    <h5 class="title">Add New Question</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <input type="hidden" name="add_question">
                      <input type="hidden" name="id_course" value="<?= $id_course;?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Question title</label>
                              <input type="text" class="form-control" name="title" placeholder="Question title" required/>
                          </div>
                          <div class="form-group">
                            <label>Option (A)</label>
                              <input type="text" class="form-control" name="op_a" placeholder="Option (A)" required/>
                          </div>
                          <div class="form-group">
                            <label>Option (B)</label>
                              <input type="text" class="form-control" name="op_b" placeholder="Option (B)" required/>
                          </div>
                          <div class="form-group">
                            <label>Option (C)</label>
                              <input type="text" class="form-control" name="op_c" placeholder="Option (C)" required/>
                          </div>
                          <div class="form-group">
                            <label>Option (D)</label>
                              <input type="text" class="form-control" name="op_d" placeholder="Option (D)" required/>
                          </div>
                          <div class="form-group">
                            <label>Correct Option (A/B/C/D)</label>
                              <select class="form-control" name="op_correct" placeholder="Correct Option" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label>Level (from 1 to 4)</label>
                              <select class="form-control" name="level" placeholder="Level (from 1 o 4)" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                          </div>
                        </div>
                      </div>
                      <div class="row center-element">
                        <div class="col-md-8">
                          <div class="form-group">
                            <button class="btn btn-primary btn-block btn-round">ADD QUESTION</button>
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
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>
</html>