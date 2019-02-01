<?php
require 'mvcondb.php';
if($con)
{


	session_start();
	if(!isset($_SESSION['uid'])) 
	{
  		header("Location: login.php");
	}
	else
	{
  		if(isset($_POST['submit']))
  		{
  			
  			$q1="DELETE FROM app_table WHERE app_table.app_id = 10004";
    		$res1=mysqli_query($con,$q1);
    			if($res1)
        			echo "<script>alert('sucessfully deleted');</script>";
    			else
       			{
       				echo "<script>alert('Sorry,...no deletion');</script>";
       			}
       		}

  		}
	}


?>

<!DOCTYPE html>
<html>
<title>MVLOVERS - Every Thing You Need</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css">  
<head><style>
 .login-box{
    width: 80%;
    max-width: 700px;
    height: 620px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    margin-top: 500px;
    top: 0%;
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
<body id="myPage">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a href="index.php" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
  <?php
  if(!isset($_SESSION['uid'])) {
    echo '<a href="login.php" class="w3-bar-item w3-right w3-button w3-hover-white">Login</a>';
  }
  else
  {  $q="select uname from mvuser where uid=".$_SESSION['uid'];
    $res2=mysqli_query($con,$q);
    $row = $res2->fetch_assoc();
    echo '<div class="w3-dropdown-hover  w3-right">
    <button class="w3-button" title="Notifications">'.$row['uname'].'<i class="fa fa-caret-down"></i></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
      <a href="phpmyadmin/index.php" class="w3-bar-item w3-button">php-admin</a>
      <a href="settingpage.php" class="w3-bar-item w3-button">php-admin</a>
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>'; 
  }
  ?>
    </div>
  </div>



    <div class="login-box">
        <form method="post" enctype='multipart/form-data'>
        <input type="text" name="name" placeholder="Enter Appointment ID"><br>
        
        <br><br><br>
        <input type="submit" name="submit">
        </form>
    </div>


<script>

</script>

</body>
</html>
