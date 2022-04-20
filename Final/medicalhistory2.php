<?php
include "config.php";
$id = $_GET['patientID']; 

if(isset($_POST['adddata']))
{		

        header('Location:nurse.php');
    
}

?>
<!doctype html>

<html lang="en" >

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/78060/animate.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" rel="stylesheet">
  <script defer src="wow.js"></script>
  <link rel="stylesheet" href="animate.css">
  <script>
    new WOW().init();
  </script>


  <link rel="stylesheet" href="manager2.css">

  <title>Medical History </title>

  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  <script defer src="bars.js"></script>

<body style="background-color:#333;">
          
            <form class="signup-form"  action="medicalhistory.php"  method="post" style="margin:1vh;">
<!-- form header -->
<div class="form-header">
  <h1>Medical History</h1>
</div>

<!-- form body -->
<div class="form-body">

<section class="mt-5 page-section" id="Doctors">
    <div class="container">
      
                <div class="wrapper wow slideInLeft" data-wow-duration="1s" style=" overflow: scroll;
    overflow: auto;">
                        <table>
            <tr>
            <th>Patient ID</th>
            <th>Record ID</th>
            <th>Treatments</th>
            <th>Date Taken</th>
            </tr>
            <?php
           
            $sql = "SELECT*FROM MEDICALHISTORY WHERE patientID='".$id."'";
            $result = $con->query($sql);


            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["patientID"]. "</td><td>" . $row["recordID"]. "</td><td>". $row["previousTreatments"]. "</td><td>" . $row["dateTaken"]."</td></tr>";
            
            }?>
        
            

            

            </table>
          
            <form action="medicalhistory.php" method="post">
				<br><br>
				<br>
				<button class="hire" type="submit" name="adddata">Go back</button>
			</form>

<!-- Script for range input label -->

        
      
    </div>
    
  </section>
      
    </div>
    
  </section>

  
  <!-- End of Nurses-->
 
  
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
  <script>
    baguetteBox.run('.compact-gallery',{animation:'slideIn'});
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
    crossorigin="anonymous"></script>
</body>

</html>