<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $med_id = $_GET['id'];

    // Update the diagnosis and treatment columns to NULL or an empty string
    $sql = "UPDATE medical_info SET diagnosis=NULL, treatment=NULL WHERE med_id='$med_id'";
    $run = mysqli_query($conn, $sql);

    if ($run) {
        header("Location: medinfo.php");  // Redirect to the records page after successful update
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
