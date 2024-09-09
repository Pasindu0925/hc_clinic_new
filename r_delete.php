<?php
  include 'connect.php';
  if(isset($_GET['app_id'])){
    $app_id=$_GET['app_id'];
            $sql="DELETE FROM appointments WHERE app_id='$app_id'";
            if(mysqli_query($conn,$sql)){
                header("location:appointment.php");
            }else{
                echo "error" . mysqli_error($conn);
            }
  }
  ?>