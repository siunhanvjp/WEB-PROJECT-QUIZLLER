

<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

if(!isset($_POST["test_name"]) || !isset($_POST["time"]) || !isset($_POST["id_course"]))
  header("Location:add_test.php");
  echo ($_POST["test_name"]);
?>
<?php
    include '../database/config.php';
    $id_course = $_POST["id_course"];
    $user_id = $_SESSION["user_id"];

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
          <div class="row">                      
            <div class="col-md-12" style="width:100%">
              <div class="card" style="min-height:200px;">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <h5 class="title">Chosen Questions</h5>
                    </div>
                    <div class="col-md-6">
                      <form method="POST" action="create_pdf.php">
                          <input type="hidden" name="test_name" value="<?= $_POST["test_name"]; ?>">
                          <input type="hidden" name="time" value="<?= $_POST["time"]; ?>">
                          <input type="hidden" name="id_course" value="<?= $_POST["id_course"]; ?>">
                          <input type="hidden" id="question_list" name="question_list" value="">
                          <button class="btn btn-primary btn-block btn-round" style="margin-top:0px;width:100px !important;float:right !important;">SUBMIT</button>
                      </form>
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
                              <tr id = "added<?= $row["id"]; ?>" style="display:none;">
                                <input type="hidden" id="question_id" value="<?= $row["id"]; ?>">
                                <td><?= $i;?></td>
                                <td data-toggle="modal" data-target="#questionModal<?=$row["id"];?>"><?= $row["title"];?></td>
                                <td><?= $row["level"];?></td>
                                <td><button id="delete" name="delete" class="btn btn-primary btn-round" onclick="delete_question('<?= $row["id"]; ?>')">DELETE</button></td>
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
          <div class="row">                      
            <div class="col-md-12" style="width:100%">
              <div class="card" style="min-height:200px;">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <h5 class="title">Course Questions</h5>
                    </div>
                  </div>  
                </div>
                <div class="card-body" style="width:100%">
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
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
                              <tr id = "init<?= $row["id"]; ?>">
                                <input type="hidden" id="question_id" value="<?= $row["id"]; ?>">
                                <td><?= $i;?></td>
                                <td data-toggle="modal" data-target="#questionModal<?=$row["id"];?>"><?= $row["title"];?></td>
                                <td><?= $row["level"];?></td>
                                <td><button id="add" name="add" class="btn btn-primary btn-round" onclick="add_question('<?= $row["id"]; ?>')">ADD</button></td>
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
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->

<script>  
  $(document).ready(function() {
        $('#example1').DataTable({
            paging: false,
            ordering: false,
            info: false,
            stripe: false,
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
        $('#example').DataTable({
            paging: false,
            ordering: false,
            info: false,
            stripe: false,
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
    
    function delete_question(id){
        let init_temp = "init" + String(id);
        let added_temp = "added" + String(id);
        let init_target = document.getElementById(init_temp);
        let added_target = document.getElementById(added_temp);
        init_target.style.display = "";
        added_target.style.display = "none";

        let target = document.getElementById("question_list");
        let text = target.getAttribute("value");
        let tmp = "(" + String(id) + ")";

        text = text.replace(tmp,"");
        target.setAttribute("value", text);
    }

    function add_question(id){
        let init_temp = "init" + String(id);
        let added_temp = "added" + String(id);
        let init_target = document.getElementById(init_temp);
        let added_target = document.getElementById(added_temp);
        init_target.style.display = "none";
        added_target.style.display = "";

        let target = document.getElementById("question_list");
        let text = target.getAttribute("value");

        let tmp = text+ "(" + String(id) + ")";
        target.setAttribute("value", tmp);

    }
</script>
</body>
</html>