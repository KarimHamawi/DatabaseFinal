
<?php
include "config.php";
$id=$_SESSION['cashierID'];






?>
<!doctype html>

<html lang="en">

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

  <title>Cashier</title>

  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  <script defer src="bars.js"></script>

  <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("mainNav").style.top = "0";
      } else {
        document.getElementById("mainNav").style.top = "-100vh";
      }
      prevScrollpos = currentScrollPos;
    }
  </script>
</head>

<body>
  <!-- Navbar-->

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" style="background-color: #333 !important;" href="#page-top">
          <span class="logo" style="margin-right:10vw; text-transform: uppercase;">WELCOME, <?php 
          $result = mysqli_query($con,"select fname, lname from cashier where cashierID='".$id."'");
          while($row = $result->fetch_assoc()) {
            echo  $row["fname"]." " .$row["lname"] ;
            };?></span>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
          data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Toggle navigation" style="margin:auto; margin-right:5vw;">Menu
          <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
           
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#payments">Payments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger"  href="index.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="home">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <div class="banner" style="background-image: url(img/manager.jpg);"></div>
            <div class="carousel-caption">
              <h2 class="animated bounceInRight" style="animation-delay: 1s">We <span>CANCERVIVE</span></h2>

            </div>
          </div>
          <div class="item">
            <div class="banner" style="background-image: url(img/manager2.jpg);"></div>
            <div class="carousel-caption">
              <h2 class="animated slideInDown" style="animation-delay: 1s">We Are Here For <span>YOU</span></h2>
              

            </div>
          </div>
          <div class="item">
            <div class="banner" style="background-image: url(img/manager3.jpg);"></div>
            <div class="carousel-caption">
              <h2 class="animated zoomIn" style="animation-delay: 1s">We Are <span>Risk's hospital</span></h2>
        

            </div>
          </div>

        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>
  </header>


  <!-- Paymetns-->
  <section class="mt-5 page-section" id="payments">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase font-weight-bold">Payments</h2>

      </div>
                <div class="wrapper wow slideInRight" data-wow-duration="1s" style=" overflow: scroll;
    overflow: auto;">
                        <table>
            <tr>
            <th>PaymentID</th>
            <th>PatientID</th>
            <th>Purpose</th>
            <th>Total</th>
            <th>Due Date</th>
            <th>Check</th>
            </tr>
            <?php
            $sql = "SELECT * FROM PAYMENT P NATURAL JOIN TREATMENT T NATURAL JOIN DOCTOR D NATURAL JOIN PAYS WHERE processed IN ('n','N') AND P.docID=D.docID AND P.treatmentID=T.treatmentID  ";
            $result = $con->query($sql);


            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["paymentID"]. "</td><td>" . $row["patientID"]. "</td><td>". $row["purpose"]. "</td><td>" . $row["price"]+$row["doctor_rate"] ."</td><td>" .  $row["datePaid"]. "</td>";?>
            <td><a href="deletepayment.php?id=<?php echo $row['paymentID']; ?>">Close payment</a></td></tr><?php
            }

            ?>

            </table>
            </br>
            </br>
    </div>
    
  </section>
  <!-- End of Payments-->


        
 
  
  
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