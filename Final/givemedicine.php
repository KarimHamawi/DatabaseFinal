<?php
include "config.php";

$id=$_SESSION['nurseID'];
$treatmentname = "SELECT * FROM MEDICINE";
$result1 = mysqli_query($con, $treatmentname);
$patientname = "SELECT * FROM PATIENT";
$result2 = mysqli_query($con, $patientname);

if(isset($_POST['adddata']))
{		
    $medicine = $_POST['medicine'];
    $sql3 = "SELECT quantity FROM MEDICINE WHERE medicineID='".$medicine."'";
    $result3 = $con->query($sql3);
    while($row = $result3->fetch_assoc()) {
    $quantityin=$row["quantity"];
    }
    $patientID = $_POST['patientID'];
    $quantitygiven=$_POST['quantitygiven'];
    $finalquantity=$quantityin-$quantitygiven;
    $startdate = date('Y-m-d', strtotime($_POST['startdate']));
    $mysqltime = date('Y-m-d');
    if ($mysqltime>$startdate){
        echo '<script>alert("You have chosen an invalid date")</script>';
      }else{
    $time = date('H:m:s', strtotime($_POST['timegiven']));
    $insert = mysqli_query($con,"INSERT INTO GIVES VALUES ('$quantitygiven','$time','$startdate','$medicine','$id','$patientID')");
   
    if(!$insert)
    {
      echo '<script>alert("You have not followed the required criteria set in the place holder")</script>';
    }
    else
    {
        $update = mysqli_query($con,"UPDATE MEDICINE SET quantity='".$finalquantity."' WHERE medicineID='".$medicine."'" );
        $update = mysqli_query($con,"UPDATE STORAGE SET nbrOfItems=nbrOfItems-$quantitygiven WHERE storageID='S01'" );
        header('Location:nurse.php');
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

  <title>Give a new medicine</title>

  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  <script defer src="bars.js"></script>

<body style="background-color:#333;">
          
            <form class="signup-form"  action="givemedicine.php"  method="post" style="margin:1vh;">
<!-- form header -->
<div class="form-header wow slideInDown" data-wow-duration="1s" >
  <h1>Give a new medicine</h1>
</div>

<!-- form body -->
<div class="form-body wow slideInUp" data-wow-duration="1s">

  <!-- PatientID and Treatment -->


  <div class="wrapper wow slideInRight" data-wow-duration="1s" style=" overflow: scroll;
                    overflow: auto;">
                        <table >
            <tr>
            <th>MedicineID</th>
            <th>Medicine Name</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            </tr>
            <?php
            $sql = "SELECT * FROM MEDICINE ";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["medicineID"]. "</td><td>" . $row["medicineName"]. "</td><td>" . $row["quantity"] . "</td><td>" . $row["expiryDate"] . "</td></tr>";
            }
            $con->close();  
            ?>
            </table>
            </br>
            </br>
            
          
        </div>


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
    <label class="label-title" >Medicine</label>
      <select class="form-input" name="medicine">   
      <?php while($row1 = mysqli_fetch_array($result1)):;?>

    <option value="<?php echo $row1[0];?>"> <?php echo $row1[1];?> </option>

      <?php endwhile;?>
      </select>
    </div>
  </div>

  <div class="horizontal-group">
  <div class="form-group">
  <label class="label-title">Given Quantity</label>
      <input type="number" name="quantitygiven" class="form-input" placeholder="enter the amount you want to give" />
  </div>
   </div>

  <!-- date -->
  <div class="horizontal-group">
    <div class="form-group left">
      <label for="password" class="label-title">Date</label>
      <input type="date" name="startdate" class="form-control" />
    </div>
    <div class="form-group right">
      <label for="confirm-password" class="label-title">Time Given </label>
      <input type="time" name="timegiven" class="form-control" />
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