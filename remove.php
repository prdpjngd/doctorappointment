<?php
require 'mvcondb.php';
if($con)
{
  session_start();
  if(!isset($_SESSION['p_id'])) 
  {
      header("Location: login.php");
  }
  if(isset($_GET['yes'])){
      $q1="DELETE FROM app_table WHERE p_id='".$_SESSION['p_id']."'";
      $res=mysqli_query($con,$q1);
      if($res){
        echo "<script>alert('Your Appointment Deleted Successfully!');;
          window.location.href='index.php';</script>";
      }
  }
  if(isset($_GET['no'])){
      echo "<script>alert('Cancel Deletion!');;
          window.location.href='index.php';</script>";
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
    echo '<a href="Logout.php" class="w3-bar-item w3-right w3-button w3-hover-white">Logout</a>';
    
  }
  ?>
    </div>
</div>


  


<center><div class="login-box1">
            <h1 style="font-size: 30px;color: solid black;">Are you sure you want to delete your appointment!</h1><br>
            <form>
              <input style="padding-left: 10px; margin-right: 50px" type="submit" name="yes" value="Yes"> 
              <input style="padding-left: 10px"type="submit" name="no" value="No">
            </form>



</div></center>

  
</table>
<br><br><br>
</div>

<script>

</script>

</body>
</html>
