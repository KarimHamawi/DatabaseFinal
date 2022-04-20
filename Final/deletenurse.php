<?php

include "config.php"; // Using database connection file here
$id = $_GET['id']; 
$del = mysqli_query($con,"delete from nurse where nurseID='$id'"); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:manager2.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>