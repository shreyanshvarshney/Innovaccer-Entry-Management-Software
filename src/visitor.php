<?php
	require_once("./include/connection.php");
	require_once("./include/sessions.php");
	require_once("./include/patterns.php");
	global $connection;

	

	if(isset($_POST['CheckIn'])){
		$Name = mysqli_real_escape_string($connection,$_POST['Name']);
        $Email = mysqli_real_escape_string($connection,$_POST['Email']);
		$Number = mysqli_real_escape_string($connection,$_POST['Number']);

		$query = "SELECT email FROM hosts ORDER BY time_added DESC";
		$execute_query = mysqli_query($connection,$query);
		$row = mysqli_fetch_array($execute_query);
					

		$sub = "Innovaccer: New Visitor Details";
		$msg = "New Visitor Detials: <br> Name:".$Name."<br> Email".$Email."<br> Number: ".$Number;
		$rec = $row['email'];
		mail($rec,$sub,$msg);

		
	// Authorisation details.
	$username = "shreyanshvarshney.sv@gmail.com";
	$hash = "028ed665c6322600d3a81102d127e3f11674b3a98074c059000e669a4eac04bd";

	// Config variables. Consult http://api.txtlocal.com/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "Innovaccer: New Visitor Details"; // This is who the message appears to be from.
	$numbers = $row['phone']; // A single number or a comma-seperated list of numbers
	$message = "New Visitor Detials: <br> Name:".$Name."<br> Email".$Email."<br> Number: ".$Number;

	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.txtlocal.com/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);

		if(!empty($_POST['Name']) && !empty($_POST['Email'])){
			if((preg_match($NamePattern,$_POST['Name']) == true) && (preg_match($EmailPattern,$_POST['Email']) == true) && (preg_match($NumberPattern,$_POST['Number']) == true)){
				
				$query = "INSERT INTO visitors(name,email,phone) VALUES('$Name','$Email','$Number')";

				$execute_query = mysqli_query($connection,$query);
				
            	if($execute_query){
					$_SESSION["SuccessMessage"] = "Greetings! You Checked In successfully, Click the check out button once you done.";
					header("Location:visitor.php");
					$query = "SELECT id,checkin_time FROM visitors ORDER BY checkin_time DESC";
					$execute_query = mysqli_query($connection,$query);
					$row = mysqli_fetch_array($execute_query);
					$_SESSION['id'] = $row["id"];
					$_SESSION['checkin_time'] = $row["checkin_time"];
					exit;
            	}
            	else{
					$_SESSION["ErrorMessage"] = "Failed to store your details, Try again!";
					header("Location:visitor.php");
					exit;
            	}
			}
			else{
				$_SESSION["ErrorMessage"] = "Fill correct details.";
            	header("Location:visitor.php");
            	exit;
			}
		}else{
			$_SESSION["ErrorMessage"] = "All fields must be filled.";
            header("Location:visitor.php");
            exit;
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inovaccer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="./css/visitor.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><img src="./img/innovaccer_logo.jpg" alt="Innovaccer Logo"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				  <span class="navbar-toggler-icon"></span>
				</button>
			  
				<div class="collapse navbar-collapse" id="navbarResponsive">
				  <ul class="navbar-nav ml-auto">
					<li class="nav-item">
					  <a class="nav-link" href="index.php">HOME</a>
					</li>
					<li class="nav-item  active">
					  <a class="nav-link" href="visitor.php">VISITOR</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="host.php">HOST</a>
					</li>
				  </ul>
				</div>
		</div>
	  </nav>


<!--- Jumbotron -->
<div class="container-fluid">
        <div class="row jumbotron">
            <div class="col-xs-12 container">
                <p class="lead">
                    Welcome to <span style="color:#E31C79; font-weight:bold; font-size:1.5rem; text-align:center;">Innovaccer!</span> 
                </p>
            </div>
        </div>
</div>
<div><?php echo Message(); echo SuccessMessage();?></div>
<div class="container">
    <!--- Visitor Form -->
    <form action="visitor.php" method="POST" enctype="multipart/form-data" class="col-sm-9">
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="Name" class="form-control" id="Name" placeholder="Name">
            </div>
            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" name="Email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="Number">Phone Number</label>
              <input type="text" name="Number" class="form-control" id="Number" placeholder="Enter Phone number">
            </div>
            <button type="submit" name="CheckIn" class="btn btn-primary col-sm-2">Check in</button>
			<button type="submit" name="CheckOut" class="btn btn-primary col-sm-2">Check out</button>
    </form>
	<!-- <form action="index.php" method="POST">
	</form> -->
</div>
<br><br>
    


<!--- Connect -->
<div class="container-fluid">
	<div class="row text-center padding">
		<div class="col-12">
			<h3>Connect</h3>
		</div>
		<div class="col-12 social padding">
			<a href="https://www.facebook.com/InnovAccer"><i class="fab fa-facebook"></i></a>
			<a href="https://www.youtube.com/channel/UCl3JT1Wm_MHu20T37UgZs8w"><i class="fab fa-youtube"></i></a>
			<a href="https://twitter.com/innovaccer"><i class="fab fa-twitter"></i></a>
			<a href="https://www.linkedin.com/company/innovaccer/"><i class="fab fa-linkedin"></i></a>
		</div>
	</div>
</div>

<br>
<br>
<!--- Footer -->
<footer>
	<div class="container-fluid padding">
		<div class="row text-center">
			<div class="col-sm-12">
				<img src="./img/innovaccer-logo-black.svg" alt="Innovaccer Logo">
				<hr class="light">
				<p>555-555-5555</p>
				<p>team@innovaccer.com</p>
				<p>Noida</p>
				<p>Uttar Pradesh, 201309</p>
			</div>
		</div>
	</div>
</footer>



</body>
</html>
