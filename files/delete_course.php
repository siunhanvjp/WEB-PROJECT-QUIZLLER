<?php

include "../database/config.php";
$id_course = $_POST['id_course'];

$sql = "DELETE from course where id = '$id_course'";
mysqli_query($conn,$sql);

?>