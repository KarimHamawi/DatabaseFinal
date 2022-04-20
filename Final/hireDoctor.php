<?php
include "config.php";



if(isset($_POST['adddata']))
{		
    $id = $_POST['ID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $doclevel=$_POST['doclevel'];
    $areaofexpertise=$_POST['areaofexpertise'];
    $yearofbirth=date('Y-m-d', strtotime($_POST['yearofBirth']));
    $doccharge=$_POST['doctorcharge'];
    $sex=$_POST['gender'];
    $insert = mysqli_query($con,"INSERT INTO DOCTOR VALUES ('$id','$firstname','$lastname','$password','$yearofbirth','$sex','$email','$address','$doclevel','$doccharge','$areaofexpertise')");

    if(!$insert)
    {
      echo '<script>alert("You have not followed the required criteria set in the place holder")</script>';
    }
    else
    {
        header('Location:manager2.php');
    }
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

  <title>Hire a Doctor</title>

  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  <script defer src="bars.js"></script>

<body style="background-color:#333;">
          
            <form class="signup-form"  action="hireDoctor.php"  method="post" style="margin:1vh;">
<!-- form header -->
<div class="form-header wow slideInDown" data-wow-duration="1s">
  <h1>Hire a doctor</h1>
</div>

<!-- form body -->
<div class="form-body wow slideInUp" data-wow-duration="1s" >

  <!-- Firstname and Lastname -->
  <div class="horizontal-group">
    <div class="form-group left">
      <label for="firstname" class="label-title">First name </label>
      <input type="text" name="firstname" class="form-input" placeholder="enter the first name" required="required" />
    </div>
    <div class="form-group right">
      <label for="lastname" class="label-title">Last name</label>
      <input type="text"  name="lastname" class="form-input" placeholder="enter the last name" />
    </div>
  </div>

  <!-- Email -->
  <div class="horizontal-group">
  <div class="form-group">
    <label for="email" class="label-title">Email</label>
    <input type="email"  name="email" class="form-input" placeholder="XXXXXX@hos.com" required="required">
  </div>
   </div>

  <!-- Passwrod and confirm password -->
  <div class="horizontal-group">
    <div class="form-group left">
      <label for="password" class="label-title">Password</label>
      <input type="password" name="password" class="form-input" placeholder="enter the password" required="required">
    </div>
    <div class="form-group right">
    <label class="label-title" >Doctor Level</label>
      <select class="form-input" name="doclevel" >
    <option value="Head"> Head </option>
    <option value="Assistant"> Assistant</option>
      </select>
    </div>
  </div>
  

  <div class="horizontal-group">
    <div class="form-group left">
      <label for="firstname" class="label-title">ID</label>
      <input type="text" name="ID" class="form-input" placeholder="example D01" required="required" />
    </div>
    <div class="form-group right">
      <label for="lastname" class="label-title">Address</label>
      <input type="text" name="address" class="form-input" placeholder="enter the address" />
    </div>
  </div>

  <!-- Gender and Area of Expertise  -->
  <div class="horizontal-group">
    <div class="form-group left">
      <label class="label-title">Gender:</label>
      <div class="input-group">
        <label for="male" style="color:white;"><input type="radio" name="gender" value="M" id="male"> M</label>
        <label for="female"style="color:white;"><input type="radio" name="gender" value="F" id="female"> F</label>
      </div>
    </div>
    <div class="form-group right">
    <label class="label-title" >Area of Expertise</label>
      <select class="form-input" name="areaofexpertise" >
      <option value="Cardiology"> Cardiology </option>
    <option value="Neurology"> Neurology</option>
    <option value="Amnesia"> Amnesia</option>
      </select>
    </div>
  </div>

  <!-- Source of Income and Income -->
 
  

  <!-- Profile picture and Age -->
  <div class="horizontal-group">
    <div class="form-group left" >
      <label for="experience" class="label-title">Date Of Birth</label>
      <input type="date" name="yearofBirth" class="form-control" />
    </div>
    <div class="form-group right">
      <label for="experience" class="label-title">Doctor Charge</label>
      <input type="range" min="0" max="900" step="1"  value="0" id="experience" name="doctorcharge" class="form-input" onChange="change();" style="height:28px;width:78%;padding:0;">
      <span id="range-label">0$</span>
    </div>
  </div>



<!-- form-footer -->

<div class="form-footer">
  <span>* required</span>
  <button type="submit" name="adddata" class="btn">Hire</button>
</div>

</form>

<!-- Script for range input label -->
<script>
var rangeLabel = document.getElementById("range-label");
var experience = document.getElementById("experience");

function change() {
rangeLabel.innerText = experience.value + "$";
}
</script>
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