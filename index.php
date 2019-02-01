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
            <h1 style="font-size: 30px;color: solid black;">Select option</h1>
            <?php
            $qr1="select p_id from app_table where p_id=".$_SESSION['p_id'];
            $resultqr=mysqli_query($con,$qr1);
            $nr=mysqli_num_rows($resultqr);
            if($nr!=0){
              echo '<button onclick="window.location.href=\'remove.php\'" class="btn">Remove Appointment</button>';
            }
            else{echo '<button onclick="window.location.href=\'menu.php\'" class="btn">New Appointment</button>
            ';}
            ?>
            <button onclick="window.location.href='change_password.php'" class="btn">Change Account Password</button>

</div></center>

<?php
$qrr="select p_id from app_table where p_id=".$_SESSION['p_id'];
    $resultqrr=mysqli_query($con,$qrr);
    $nrr=mysqli_num_rows($resultqrr);
    if($nrr!=0)
    {
echo '<div class="login-boxx2">
	<h1 style="font-size: 40px;color: solid black;background: #fff;">Your Appointment</h1>
<table id="customers" style="margin: auto">
  <tr>
  	
    
    <th>Appointment Token</th>
    <th>Appintment Date</th>
    <th>Contect Number</th>

  </tr>';
  
    
  	 $q="SELECT app_date FROM app_table WHERE p_id='".$_SESSION['p_id']."'";
      $res=mysqli_query($con,$q);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $q2="SELECT mobile_number FROM settings";
      $res2=mysqli_query($con,$q2);
      $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
      $q4="SET @row_number = 0";
      $res2=mysqli_query($con,$q2);
      $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
      $q3="SELECT num from (SELECT (@row_number:=@row_number + 1) AS num, app_id,p_id FROM app_table WHERE app_date='2018-10-24') as t1 where p_id='1004'";
      $res3=mysqli_query($con,$q3);
      $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
    	echo "<tr>
		
    	<td>--</td>
      <td>".$row['app_date']."</td>
    	<td>".$row2['mobile_number']."</td>
  		</tr>";
    }
  
  ?>
  
</table>
<br><br><br>
</div>

<script>

</script>

</body>
</html>
