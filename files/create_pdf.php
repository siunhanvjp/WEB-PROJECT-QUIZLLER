<?php
ob_start();
include('../lib/tcpdf.php');

session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

include '../database/config.php';

$test_name = $_POST['test_name'];
$time = $_POST['time'];
$id_course = $_POST['id_course'];
$question_list = $_POST['question_list'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * from course where id = $id_course";
$result = mysqli_query($conn,$sql);
$course_details = mysqli_fetch_assoc($result);
$course_id = $course_details["course_id"];
$course_name = $course_details["course_name"];
$arr ;

$count = 0;

if(strlen($question_list) != 0){
    $string = substr($question_list, 1);
    echo "
        <script>
            console.log($test_name);
        </script>
        ";
    $arr = explode("(", $string);
    for($j = 0; $j <count($arr); $j++){
        $arr[$j] = substr($arr[$j], 0, -1);
    }
    $count = count($arr);
}


$i = 1;

$html = "    
<div>
<h2>DAI HOC BACH KHOA TPHCM1</h2>
<h2>$test_name</h2>
<h4>Mon thi: $course_name - $course_id </h4>
<h5>Bai kiem tra co $count cau</h5>
<h5>Thoi gian lam bai: $time phut</h5>
<hr>
</div>
<div style='margin: 20px;'>
<h4>Ho ten thi sinh:..........................................</h4>
<h4>So bao danh:..............................................</h4>
</div>
";

foreach ($arr as $question_id){
    $sql = "select * from questions where id = $question_id";
    $result = mysqli_query($conn,$sql);
    
    $row = mysqli_fetch_assoc($result);
    $title = $row["title"];
    $opA = $row["optionA"];
    $opB = $row["optionB"];
    $opC = $row["optionC"];
    $opD = $row["optionD"];
    
    $tmp = "
        <h4>$i. $title:</h4>
        <span><strong>A</strong>. $opA</span>
        <p><strong>B</strong>. $opB</p>
        <span><strong>C</strong>. $opC</span>
        <p><strong>D</strong>. $opD</p>
    "; 
    $html = $html . $tmp;
    $i += 1;
}


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// $pdf->setPrintFooter(false);
// $pdf->setPrintHeader(false);

$pdf->AddPage();
$pdf->writeHTML($html);

ob_end_clean();
$pdf->Output("test.pdf", "I");
?>
