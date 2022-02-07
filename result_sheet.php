<?php

$data = array(
    'bangla_1st' => 85,
    'english' => 75,
    'physics' => 80,
    'chemistry' => 50,
    'math' => 40,
    'biology' => 33,
    'social_science' => 34,
);

$subject_main=array_keys($data);
$subject_main_value=array_values($data);


function subject_values($marks){
    if($marks>=80 && $marks<=100){
        return 5.00;
    }elseif ($marks>=70 && $marks<=79) {
        return 4.00;
    }elseif ($marks>=60 && $marks<=69) {
        return 3.50;
    }elseif ($marks>=50 && $marks<=59) {
        return 3.00;
    }elseif ($marks>=40 && $marks<=49) {
        return 2.50;
    }elseif ($marks>=30 && $marks<=39) {
        return 1.00;
    }elseif ($marks>=1 && $marks<=29) {
        return 0.00;
    }
}



$grade_subject_0=subject_values($subject_main_value[0]);
$grade_subject_1=subject_values($subject_main_value[1]);
$grade_subject_2=subject_values($subject_main_value[2]);
$grade_subject_3=subject_values($subject_main_value[3]);
$grade_subject_4=subject_values($subject_main_value[4]);
$grade_subject_5=subject_values($subject_main_value[5]);
$grade_subject_6=subject_values($subject_main_value[6]);

$avareage_gpa = round((($grade_subject_0+$grade_subject_1+$grade_subject_3+$grade_subject_4+$grade_subject_5+$grade_subject_6)/7),2);



$result_comment=$grade_subject_0&&$grade_subject_1&&$grade_subject_3&&$grade_subject_4&&$grade_subject_5&&$grade_subject_6;



if($result_comment>=1 && $result_comment<=5){ 
    $result="Pass";
}elseif($result_comment!=1){
    $result="Failed";
}else{
    echo "Your Result is Pending! Please Contact Your Organization";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Mark Result</title>
</head>
<body>
    <div class="main">
        <h1 style="text-align:center">Student Result Mark Sheet</h1>
    <table border="1" style="margin:0 auto;
    margin-top:50px;font-size:25px;text-align:center; border:2px solid green">
        <tr style="background:yellow">
            <th>Subjects</th>
            <th>Marks</th>
            <th>Grade Point</th>
            <th>CGPA</th>
            <th>COMMENTS</th>
        </tr>

       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[0]));?></td>
           <td><?php echo $subject_main_value[0];?></td>
           <td><?php echo $grade_subject_0;?></td>
           <td rowspan="7"> <?php echo $avareage_gpa ?> </td>
           <td rowspan="7"> <?php echo $result ?> </td>
       </tr>

       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[1]));?></td>
           <td><?php echo $subject_main_value[1];?></td>
           <td><?php echo $grade_subject_1;?></td>
       </tr>
       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[2]));?></td>
           <td><?php echo $subject_main_value[2];?></td>
           <td><?php echo $grade_subject_2;?></td>

       </tr>
       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[3]));?></td>
           <td><?php echo $subject_main_value[3];?></td>
           <td><?php echo $grade_subject_3;?></td>
          
       </tr>
       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[4]));?></td>
           <td><?php echo $subject_main_value[4];?></td>
           <td><?php echo $grade_subject_4;?></td>
           
       </tr>
       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[5]));?></td>
           <td><?php echo $subject_main_value[5];?></td>
           <td><?php echo $grade_subject_5;?></td>
       </tr>

       <tr>
           <td><?php echo ucwords(str_replace('_', ' ', $subject_main[6]));?></td>
           <td><?php echo $subject_main_value[6];?></td>
           <td><?php echo $grade_subject_6;?></td>

       </tr>
    </table>
    </div>

</body>
</html>