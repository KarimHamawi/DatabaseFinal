<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($con,"delete from CASHIER where cashierID = '$id'"); // delete query

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