<?php

    include '../database/config.php';
    require_once('../assets/vendor/excel_reader2.php');
    require_once('../assets/vendor/SpreadsheetReader.php');

    $id_course = $_POST['id_course'];
    $teacher_id = $_POST['teacher_id'];
?>

    <p>You should be redirected in a few seconds.</p>
    <p>If you're not, please check the file format. You can click <a href="http://localhost/Others/Quizller/admin/files/dashboard.php">here</a> to go back.</p>

    <form id="form-completed" method="POST" action="course_details.php">
        <input type="hidden" name="id_course" value="<?= $id_course;?>">
    </form>
    <script>
        function completed() {
          document.getElementById("form-completed").submit();
        }
    </script>

<?php

    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
                $title = "";
                if(isset($Row[0])) {
                    $title = mysqli_real_escape_string($conn,$Row[0]);
                    

                }
                
                $op_a = "";
                if(isset($Row[1])) {
                    $op_a = mysqli_real_escape_string($conn,$Row[1]);
                    

                }

                $op_b = "";
                if(isset($Row[2])) {
                    $op_b = mysqli_real_escape_string($conn,$Row[2]);
                   

                }

                $op_c = "";
                if(isset($Row[3])) {
                    $op_c = mysqli_real_escape_string($conn,$Row[3]);
                    

                }

                $op_d = "";
                if(isset($Row[4])) {
                    $op_d = mysqli_real_escape_string($conn,$Row[4]);
                    

                }

                $op_correct = "";
                $op_correct_text = "";
                if(isset($Row[5])) {
                    $op_correct = mysqli_real_escape_string($conn,$Row[5]);

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
                }

                $level = "";
                if(isset($Row[6])) {
                    $level = mysqli_real_escape_string($conn,$Row[6]);
                }

                if (!empty($title) || !empty($op_a) || !empty($op_b) || !empty($op_c) || !empty($op_d) || !empty($op_correct_text) || !empty($level)) {
                    $sql = "INSERT INTO questions(title,optionA,optionB,optionC,optionD,correctAns,level,teacher_id,course_id) values('$title','$op_a','$op_b','$op_c','$op_d','$op_correct_text','$level', '$teacher_id', '$id_course')";
                    $result = mysqli_query($conn,$sql);
                    if($result) {
                        
                        echo "<script>console.log('success');</script>";
                        echo '<script type="text/javascript">',
                        'completed();',
                        '</script>';
                        
                    }  
                }
            }
        }
    }
?>