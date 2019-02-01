<?php
require 'mvcondb.php';
if($con)
{
  session_start();
  if(!isset($_SESSION['uid'])) 
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
<link rel="stylesheet" href="../jquery-ui.css">
<script src="../jquery-1.12.4.js"></script>
<script src="../jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>

<head><style>


.login-box1{
    width: 100%;
    height: auto;
    color: #fff;
    top: 10%;
    bottom: : 90%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    
}

.login-boxx2{
    width: 100%;
    top:20%;
    bottom: 80%;
    left: 50%;
    position: absolute; 
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 30px;
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
  if(!isset($_SESSION['uid'])) {
    echo '<a href="login.php" class="w3-bar-item w3-right w3-button w3-hover-white">Login</a>';
  }
  else
  {  
    echo '<a href="logout.php" class="w3-bar-item w3-right w3-button w3-hover-white">Logout</a>';
    
  }
  ?>
    </div>
</div>

<center><div class="login-box1">
  <form method="get">
            <p>Date: <input type="date" name="date1" id="datepicker" required></p>
            <input type="submit" name="submit" value="Change Date"> 
  </form>
</div></center>

<?php 

  
  	if(isset($_GET['submit']))
  	{
  		echo '<div class="login-boxx2">
	<h1 style="font-size: 20px;color: solid black;background: #fff; border: 3px solid #ddd;padding: 0px"> Appointments on '.$_GET['date1'].'</h1>

<table id="customers" style="margin: auto">
  <tr>
  	
    <th>Paitent Name</th>
    <th>City</th>
    <th>Contect Number</th>

  </tr>';
  		  	$q= "SELECT mvuser.mobile, mvuser.uname FROM app_table INNER JOIN mvuser ON app_table.p_id=mvuser.p_id WHERE app_table.app_date='".$_GET['date1']."'";
    $res=mysqli_query($con,$q);

    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
    	echo "<tr>
		
    	<td>".$row['uname']."</td>
    	<td>jodhpur</td>
    	<td>".$row['mobile']."</td>
  		</tr>";
    	}
  	}
  	else{
  		echo '<div class="login-boxx2">
	<h1 style="font-size: 20px;color: solid black;background: #fff; border: 3px solid #ddd;padding: 0px">Today\'s Appointments</h1>

<table id="customers" style="margin: auto">
  <tr>
  	
    <th>Paitent Name</th>
    <th>City</th>
    <th>Contect Number</th>

  </tr>';
  		$date=date("Y-m-d");
  	$q= "SELECT mvuser.mobile, mvuser.uname FROM app_table INNER JOIN mvuser ON app_table.p_id=mvuser.p_id WHERE app_table.app_date='".date("Y-m-d")."'";
    $res=mysqli_query($con,$q);

    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
    	echo "<tr>
		
    	<td>".$row['uname']."</td>
    	<td>jodhpur</td>
    	<td>".$row['mobile']."</td>
  		</tr>";
    	}
  	}
  	
  
  ?>
  
</table>
<br><p>Download PDF : </p><input type="button" id="btnExport" value="Export"><br><br>
</div>

    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="pdfmake.min.js"></script>
    <script type="text/javascript" src="html2canvas.min.js"></script>
    <script type="text/javascript">
            $("body").on("click", "#btnExport", function () {
                html2canvas($('#customers')[0], {
                    onrendered: function (canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("Table.pdf");
                    }
                });
            });
    </script>


</body>

</html>
