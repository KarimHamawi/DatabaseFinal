<?php
include "config.php";

$id=$_SESSION['docID'];
$treatmentname = "SELECT * FROM TREATMENT";
$result1 = mysqli_query($con, $treatmentname);
$patientname = "SELECT * FROM PATIENT";
$result2 = mysqli_query($con, $patientname);

if(isset($_POST['adddata']))
{		
    $treatment = $_POST['treatment'];
    $patientID = $_POST['patientID'];
    $startdate = date('Y-m-d', strtotime($_POST['startdate']));
    $mysqltime = date('Y-m-d');
    $enddate = date('Y-m-d', strtotime($_POST['enddate']));
    if ($mysqltime>$startdate){
      echo '<script>alert("You have chosen an invalid start date")</script>';
    }elseif ($mysqltime<$endddate){
      echo '<script>alert("You have chosen an invalid end date")</script>';
    }
    else{   
    $insert = mysqli_query($con,"INSERT INTO PROVIDES VALUES ('$startdate','$enddate','$id','$treatment','$patientID')");
    $sql = "SELECT recordID FROM MEDICALHISTORY WHERE patientID='".$patientID."'";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
    $recordID=$row["recordID"];
    }
    $sql2 = "SELECT name FROM TREATMENT WHERE treatmentID='".$treatment."'";
    $result2 = $con->query($sql2);
    while($row = $result2->fetch_assoc()) {
    $treatmentname2=$row["name"];
    }
    if(!$insert)
    {
      echo '<script>alert("You have not followed the required criteria set in the place holder")</script>';
    }
    else
    {
      $insert2 = mysqli_query($con,"INSERT INTO MEDICALHISTORY VALUES ('$recordID','$treatmentname2','$enddate','$patientID')");
      $insert3 = mysqli_query($con,"INSERT INTO PAYMENT VALUES (DEFAULT,'$treatmentname2',200,'$enddate','N','$id', '$treatment')");
      $insert4 = mysqli_query($con,"INSERT INTO PAYS VALUES ('$patientID',DEFAULT,'CA01')");
        header('Location:doctor.php');
    }}
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

  <title>Give a new treamtent</title>

  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  <script defer src="bars.js"></script>

<body style="background-color:#333;">
          
            <form class="signup-form"  action="givetreatment.php"  method="post" style="margin:1vh;">
<!-- form header -->
<div class="form-header wow slideInDown" data-wow-duration="1s" >
  <h1>Give a new treamtent</h1>
</div>

<!-- form body -->
<div class="form-body wow slideInUp" data-wow-duration="1s">

  <!-- PatientID and Treatment -->
  <div class="horizontal-group">
    <div class="form-group left">
    <label class="label-title" >PatientID</label>
      <select class="form-input" name="patientID" >
      <?php while($row1 = mysqli_fetch_array($result2)):;?>

    <option value="<?php echo $row1[0];?>">  <?php echo $row1[0];?> </option>

      <?php endwhile;?>
      </select>
    </div>
    <div class="form-group right">
    <label class="label-title" >Treatment</label>
      <select class="form-input" name="treatment" >
      <?php while($row1 = mysqli_fetch_array($result1)):;?>

    <option value="<?php echo $row1[0];?>"> <?php echo $row1[1];?> </option>

      <?php endwhile;?>
      </select>
    </div>
  </div>

  <!-- date -->
  <div class="horizontal-group">
    <div class="form-group left">
      <label for="password" class="label-title">Start Date</label>
      <input type="date" name="startdate" class="form-control" />
    </div>
    <div class="form-group right">
      <label for="confirm-password" class="label-title">End Date </label>
      <input type="date" name="enddate" class="form-control" />
    </div>
  </div>
  



<!-- form-footer -->

<div class="form-footer">
  <span>* required</span>
  <button type="submit" name="adddata" class="btn">Give treatment</button>
</div>

</form>


        </div>
      </div>
      
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