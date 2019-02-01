<?php
require 'mvcondb.php';
if($con)
{
  session_start();
  if(!isset($_SESSION['p_id'])) 
  {
      header("Location: login.php");
  }
}
?>




<!DOCTYPE html>
<html>
<title>Medical - Appointment</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="w3-theme-black.css">
<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-1.12.4.js"></script>
<script src="jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
<head><style>


.btn{
  margin: 5px 5px 5px 5px;
}

.login-box1{
    width: 100%;
    height: auto;
    color: solid black;
    top: 10%;
    bottom: 90%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    
}
.login-box1 button{
    border: none;
    outline: none;
    height: 40px;
    background: #009688;
    color: #fff;
    font-size: 18px;
    border-radius: 20px;
}

.login-boxx2{
    width: 100%;
    top:40%;
    bottom: 60%;
    left: 50%;
    position: absolute; 
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background: #fff;
    
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #009688;
    color: white;
}


@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 900px) {
  .text {font-size: 11px}
}
</style></head>
<body id="myPage">



<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a href="index.php" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
  <?php
  if(!isset($_SESSION['p_id'])) {
    echo '<a href="login.php" class="w3-bar-item w3-right w3-button w3-hover-white">Login</a>';
  }
  else
  {  $q="select uname from mvuser where p_id=".$_SESSION['p_id'];
    $res2=mysqli_query($con,$q);
    $row = $res2->fetch_assoc();
    echo '<a href="logout.php" class="w3-bar-item w3-right w3-button w3-hover-white">Logout</a>';
    
  }
  ?>
    </div>
</div>


  


<center><div class="login-box1">
  <form method="get">
            <h1 style="font-size: 30px;color: solid black;">Select Your Appointment Date</h1>
            <p>Date: <input type="date" name="date1" min=<?php $date=date("Y-m-d"); echo "'$date'"; ?> id="datepicker" required></p>
            <input type="submit" name="submit" value="Search"> 
  </form>
</div></center>

<?php 

  if(isset($_GET['date1']))
  {
      $qr2="select app_limit from settings";
      $res2=mysqli_query($con,$qr2);
      $row3=mysqli_fetch_row($res2);
      $qr="select COUNT(p_id) from app_table where app_date='".$_GET['date1']."'";
      $res=mysqli_query($con,$qr);
      $row2=mysqli_fetch_row($res);
      $row2=$row3[0]-$row2[0];
      echo '<div class="login-boxx2">
      <h1 style="font-size: 20px;color: solid black;background: #fff;">Available Appointments on '.$_GET['date1'].' is: '.$row2.'</h1>';
      if($row2<=$row3[0])
      {
        echo '<form method="get">
            <center><input type="submit" name="Place" value="Place Appointment"></center>
            <input type="hidden" name="date2" value="'.$_GET['date1'].'">;
        </form></div>';
      }
      else
      {
        echo '<p>No Appointmnets are available for this date, Choose Another Date or Go Back to your Home.</p>';
      }
        


  }
  if(isset($_GET['Place']))
  {

        $q2="insert into app_table (p_id,app_date) VALUES (".$_SESSION['p_id'].",'".$_GET['date2']."')";
        $res3=mysqli_query($con,$q2);
        if($res3){
          echo "<script>alert('appointment placed');;
          window.location.href='index.php';</script>";
        }
        else
        {
          echo "<script>alert('Someting Went Wrong & Duplicate Data Found');</script>";
        }
            
  }

  
?>






</body>
</html>