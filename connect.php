<?php
//connect to the Database
$conn=new mysqli('localhost','root','','hc_clinic_new');
if($conn){
    //echo"connected";
}else{
    die(mysqli_error($conn));
}
?>