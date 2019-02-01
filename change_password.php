<?php
require 'mvcondb.php';
if($con)
{

	session_start();
	if(!isset($_SESSION['p_id'])) 
	{  
    header("Location: login.php");	
  }
  if(isset($_POST['submit']))
  {
      $opass=$_POST['opass'];
      $n1pass=$_POST['n1pass'];
      $n2pass=$_POST['n2pass'];
      $vp="SELECT password from mvuser where p_id=".$_SESSION['p_id']."";
      $res=mysqli_query($con,$vp);
      $vrow=mysqli_fetch_array($res,MYSQLI_ASSOC);
      if($n1pass==$n2pass && $opass==$vrow['password'])
      {
        $q="UPDATE mvuser SET password = '".$n1pass."' WHERE p_id = ".$_SESSION['p_id']."";
        $res=mysqli_query($con,$q);
        if($res!=0)//if not zero it means that we found one entry with the username and password
        {
            echo "<script>alert('Password Succesfully changed!');
          window.location.href='index.php';</script>";
        }

      }
      else 
      {
        echo "<script>alert('Password Did not match!');</script>";
      }
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
<!--<link rel="stylesheet" type="text/css" href="style.css">  -->
<head><style>

.login-box{
    width: 320px;
    height: 420px;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
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

<body id="myPage">
    <div class="login-box">
        <h2>Password Change!</h2>
            <form method="post">
            <p>Old Password</p>
            <input type="text" name="opass" placeholder="Old Password" required>
            <p>New Password</p>
            <input type="password" name="n1pass" placeholder="Enter new Password" minlength="8" maxlength="16" required>
            <p>Re-Enter New Password</p>
            <input type="password" name="n2pass" placeholder="Re-Enter New Password" minlength="8" maxlength="16" required><br><br>
            <input type="submit" name="submit" value="Change Password">  
            </form>
    </div>


<script>
//place your Scripts here
</script>

</body>
</html>