
<?php
include "config.php";
/*create an array with all username*/
$doctor_array = array();
$result = mysqli_query($con,"SELECT docID FROM doctor where docID  LIKE 'D%' ");
while ($row = mysqli_fetch_array($result)) {
$doctor_array[] = $row['docID'];
}


$manager_array = array();
$result2 = mysqli_query($con,"SELECT managerID FROM manager where managerID  LIKE 'M%' ");
while ($row = mysqli_fetch_array($result2)) {
$manager_array[] = $row['managerID'];
}

$nurse_array = array();
$result3 = mysqli_query($con,"SELECT nurseID FROM NURSE where nurseID LIKE 'N%' ");
while ($row = mysqli_fetch_array($result3)) {
$nurse_array[] = $row['nurseID'];
}


$cashier_array = array();
$result4 = mysqli_query($con,"SELECT cashierID FROM CASHIER where cashierID LIKE 'C%' ");
while ($row = mysqli_fetch_array($result4)) {
$cashier_array[] = $row['cashierID'];
}
/*print_r( $cashier_array);*/




/*$_POST is a PHP super global variable which is used to collect form data after submitting an HTML form with method="post". 
$_POST is also widely used to pass variables. */
if(isset($_POST['btn_submit'])){

	$id = mysqli_real_escape_string($con,$_POST['id']);
	/*used to escape all special characters for use in an SQL query.
	 It is used before inserting a string in a database, as it removes any special characters that may interfere with the query operations*/
    $password = mysqli_real_escape_string($con,$_POST['password']);


    if ($id != "" && $password != ""){
			if(in_array($id,$manager_array)){
				$sql_query = "select count(*) as cntUser from MANAGER where managerID='".$id."' and password='".$password."'";
				$result = mysqli_query($con,$sql_query);
				/*used to execute the following query type, insert,update, delete,select*/
				$row = mysqli_fetch_array($result);
				/*to fetch rows from the database and store them as an array.*/
				$count = $row['cntUser'];
				/*Session variables solve this problem by storing user information to be used across multiple pages (e.g. username, favorite color, etc). 
				By default, session variables last until the user closes the browser*/
				if ($count >0 ){
				$_SESSION['managerID'] = $id;	
            	header('Location:manager2.php');}}
		elseif(in_array($id,$doctor_array)){
			$sql_query = "select count(*) as cntUser from doctor where docID='".$id."' and password='".$password."'";
			$result = mysqli_query($con,$sql_query);
			$row = mysqli_fetch_array($result);
			$count = $row['cntUser'];
			if ($count >0 ){
			$_SESSION['docID'] = $id;	
			header('Location:doctor.php');}}
			elseif(in_array($id,$nurse_array)){
				$sql_query = "select count(*) as cntUser from nurse where nurseID='".$id."' and password='".$password."'";
				$result = mysqli_query($con,$sql_query);
				$row = mysqli_fetch_array($result);
				$count = $row['cntUser'];
				if ($count >0 ){
				$_SESSION['nurseID'] = $id;	
				header('Location:nurse.php');}}
				elseif(in_array($id,$cashier_array)){
					$sql_query = "select count(*) as cntUser from cashier where cashierID='".$id."' and password='".$password."'";
					$result = mysqli_query($con,$sql_query);
					$row = mysqli_fetch_array($result);
					$count = $row['cntUser'];
					if ($count >0 ){
					$_SESSION['cashierID'] = $id;	
					header('Location:cashier.php');}
				}else{

					echo '<script>alert("Invalid username and password")</script>';
				}				
			
        }else{
	
			echo '<script>alert("Invalid username and password")</script>';
		}	
		

    }



?>



<!DOCTYPE html>

<html lang="en">


<head>
	<meta charset="UTF-8">
	<title>Hospital Managment</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="./style.css">
	<script defer src="wow.js"></script>
  <link rel="stylesheet" href="animate.css">
  <script>
    new WOW().init();
  </script>

</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="box-form">
		<div class="left wow slideInLeft" data-wow-duration="1s">
			<div class="overlay">
				<h1>Hospital Managment</h1>
				<p>Welcome to our new online hospital managment website where you can manage all your work online</p>
			</div>
		</div>


		<div class="right wow slideInRight" data-wow-duration="1s">
			<h5>Login</h5>
			<form action="index.php" method="post">
				<div class="inputs">
					<input type="text" id="id" name="id" placeholder="ID">
					<br>
					<input type="password" id="password" name="password" placeholder="password">
				</div>
				<br><br>
				<br>
				<button type="submit" name="btn_submit">Login</button>
			</form>
		</div>
	</div>

</body>

</html>