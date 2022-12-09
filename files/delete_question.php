<?php

include "../database/config.php";
$question_id = $_POST['question_id'];
$id_course = $_POST['id_course'];

$sql = "DELETE from questions where id = '$question_id' and course_id = '$id_course'";
mysqli_query($conn,$sql);

?>