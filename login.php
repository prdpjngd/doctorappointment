<?php
require 'mvcondb.php';
if($con)
{

	session_start();
	if(!isset($_SESSION['p_id'])) 
	{
		if(isset($_POST['submit']))
  		{
  			if(isset($_POST['username']))
			{$uname=$_POST['username'];
			$pass=$_POST['Password'];
			$q='select p_id from mvuser where uname="'.$uname.'" and password="'.$pass.'"';
			$res=mysqli_query($con,$q);
			$arr=mysqli_num_rows($res);//count rows
			$arr2=mysqli_fetch_array($res,MYSQLI_ASSOC);//get columns names
			if($arr!=0)//if not zero it means that we found one entry with the username and password
			{
       			 $_SESSION['p_id']=$arr2['p_id'];
        		header("Location: index.php");
			}
			else 
			{
				echo "<script>alert('Wrong Password');</script>";
			}

			}

  		}
	}
	else
	{
  		echo "<script>alert('you Are logout,Login Again');</script>";
  		header("Location: logout.php");
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


<body id="myPage">
    <div class="login-box">
        <h1>Login Here</h1>
            <form method="post">
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Service ID" required>
            <p>Password</p>
            <input type="password" name="Password" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="Login">  
            </form>
    </div>


<script>
//place your Scripts here
</script>

</body>
</html>
