<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
?>
<?php
  include '../database/config.php';

  require_once('../assets/vendor/excel_reader2.php');
  require_once('../assets/vendor/SpreadsheetReader.php');

  if(isset($_POST['general_settings_update'])) {
    $id_course = $_POST['id_course'];
    $course_name = $_POST['course_name'];
    $course_id = $_POST['course_id'];
   
    $course_id = mysqli_real_escape_string($conn,$course_id);
  
    $course_name = mysqli_real_escape_string($conn,$course_name);

    $general_settings = false;

    $sql = "UPDATE course SET course_name = '$course_name', course_id ='$course_id' WHERE id = $id_course";
    $result = mysqli_query($conn,$sql);
    if($result) {
      $general_settings = true;
    }
  }


  if(isset($_POST['id_course'])) {
    $user_id = $_SESSION["user_id"];
    $id_course = $_POST['id_course'];
    
    $sql = "SELECT * from course where id = $id_course";
    $result = mysqli_query($conn,$sql);
    $course_details = mysqli_fetch_assoc($result);
    $course_id = $course_details["course_id"];
    $course_name = $course_details["course_name"];
    
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
    Quizzler-Course Details
  </title>
  <meta property="og:site_name" content="Quizller"/>
  <meta property="og:title" content="Course Details"/>
  <meta property="og:description" content="Show the details of course and manage questions here"/>
  <meta property="og:type" content="website"/>
  <meta property="og:locale" content="en"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" charset="utf-8">
  <link href="../assets/css/main.css" rel="stylesheet" />
</head>

<body>
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
              <a class="navbar-brand" href="#pablo"></a>
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
          <div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">COURSE DETAILS</h5>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="hidden" name="general_settings_update">
                    <input type="hidden" name="id_course" value="<?= $id_course;?>">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Course Name </label>
                          <input type="text" class="form-control" name="course_name" placeholder="Course name" value="<?=$course_name;?>"/>
                        </div>
                        <div class="form-group">
                          <label>Course ID</label>
                          <input type="text" class="form-control" name="course_id" placeholder="Course ID" value="<?= $course_id;?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="row center-element">
                      <div class="col-md-6">
                        <div class="form-group">
                          <button class="btn btn-primary btn-block btn-round">UPDATE</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content" style="min-height: auto;">
          <div class="row">                      
            <div class="col-md-12" style="width:100%">
              <div class="card" style="min-height:400px;">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <h5 class="title">Test Questions</h5>
                    </div>
                    <form id="form-add-questions" method="POST" action="add_question.php">
                      <input type="hidden" name="id_course" value="<?= $id_course;?>">
                    </form>
                    <div class="col-md-3">
                      <button class="btn btn-primary btn-block btn-round" data-toggle="modal" data-target="#exampleModal" style="margin-top:0px;width:200px !important;float:right !important;">UPLOAD</button>
                    </div>

                    <div class="col-md-3">
                      <button class="btn btn-primary btn-block btn-round" onclick="redirect_to_add_question()" style="margin-top:0px;width:200px !important;float:right !important;">ADD NEW QUESTION</button>
                    </div>
                  </div>  
                </div>
                <div class="card-body" style="width:100%">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Question</th>
                              <th>Level</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $sql = "select * from questions where course_id = $id_course and teacher_id = $user_id";
                            $result = mysqli_query($conn,$sql);
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result)) {
                              ?>
                              <tr id = "<?= $row["id"]; ?>">
                                <input type="hidden" id="question_id" value="<?= $row["id"]; ?>">
                                <td><?= $i;?></td>
                                <td data-toggle="modal" data-target="#questionModal<?=$row["id"];?>"><?= $row["title"];?></td>
                                <td><?= $row["level"];?></td>
                                <td><button id="delete" name="delete" class="btn btn-primary btn-block btn-round" onclick="delete_question('<?= $row["id"]; ?>','<?php echo $id_course; ?>')">DELETE</button></td>
                              </tr>

                            <?php
                            $i++;
                            }   
                          ?>

                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <form id="form-file-upload" name="form-file-upload" method="POST" action="file_upload.php" enctype="multipart/form-data">
            <input type="hidden" name="file_upload">
            <input type="hidden" name="id_course" id ="id_course" value="<?= $id_course; ?>">
            <input type="hidden" name="teacher_id" id ="teacher_id" value="<?= $_SESSION["user_id"]; ?>">
            <input type="hidden" name="tmp_name" id="tmp_name">
            <input type="hidden" name="type" id="type"> 
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select spreadsheet to import</h5>
              </div>
              <div class="modal-body">
                <p><b>The spreadsheet column should contain (without header):</b> <br> Question, Option A, Option B, Option C, Option D, Correct Option, Level(from 1 to 4).</p>
                <p><b>Accepted file formats are:</b> .xls, .xlsx and .ods</p>
                <input type="file" name="file" id="file" accept=".xls,.xlsx,.ods">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="file_upload_submit()">Upload</button>
              </div>
            </div>
          </form>
          </div>
        </div>
        <?php     
          $sql = "select * from questions where course_id = $id_course and teacher_id = $user_id";
          $result = mysqli_query($conn,$sql);
          
          while($row = mysqli_fetch_assoc($result)) {
          ?>             
          <div class="modal fade" id="questionModal<?= $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Question</h5>
                </div>
                <div class="modal-body">
                  <h5><?= $row["title"];?></h5>
                  <p>Option A: <?= $row["optionA"];?></p>
                  <p>Option B: <?= $row["optionB"];?></p>
                  <p>Option C: <?= $row["optionC"];?></p>
                  <p>Option D: <?= $row["optionD"];?></p>
                  <p>Correct Answer: <?= $row["correctAns"];?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
          </div>
        <?php
          
          }
        ?>

        <!-- footer -->
        
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    function redirect_to_add_question() {
      document.getElementById("form-add-questions").submit();
    }

    $(document).ready(function() {
      $('#example').DataTable({
            "columns": [
                { "width": "5%" },
                { "width": "80%" },
                { "width": "5%" },
                { "width": "10%" }
            ],
            'columnDefs': [
                {
                        "targets": 3, // your case first column
                        "className": "text-center",
                },
                {
                        "targets": 0,
                        "className": "text-center",
                },
                {
                        "targets": 2,
                        "className": "text-center",
                }
            ]
        });
    });

    function completed() {
      document.getElementById("form-completed").submit();
    }

    function file_upload_submit() {
      document.getElementById("form-file-upload").submit();
    }

    function delete_question(temp,id_course) {
      var temp1 = document.getElementById(temp);
      temp1.style.display = 'none';
      $.ajax({
          type: 'POST',
          url: 'delete_question.php',
          data: {
            'question_id': temp,
            'id_course': id_course,
          },
          success: function (response) {
          }
      });
    }

</script>
<?php
//Checking if general settings updated successfully
if(isset($_POST['general_settings_update'])) {
  if($general_settings == "true")
  {
    ?>

    <script type="text/javascript">
      $.notify({
        message: ' Updated Successfully' 
      },{
        type: 'success'
      });
    </script>

    <?php
  }
  else if($general_settings == "false")
  {
    ?>

      <script type="text/javascript">
        $.notify({
          message: 'There was an error updating course' 
        },{
          type: 'danger'
        });
      </script>

    <?php
  }
  else {}

}
?>

</body>
</html>