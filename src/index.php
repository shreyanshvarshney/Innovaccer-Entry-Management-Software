<?php
     require_once("include/sessions.php");
	 require_once("include/connection.php");
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
	<link href="./css/style.css" rel="stylesheet">
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
					<li class="nav-item active">
					  <a class="nav-link" href="index.php">HOME</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="visitor.php">VISITOR</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="host.php">HOST</a>
					</li>
				  </ul>
				</div>
		</div>
	  </nav>

<div><?php echo Message(); echo SuccessMessage();?></div>

<!--- Image Slider -->

<div id="slides" class="carousel slide" data-ride="carousel">
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
	</ul>
	<div class="carousel-inner">
    	<div class="carousel-item active">
			<img class="d-block w-100" src="./img/background.png" alt="First slide">
			<div class="carousel-caption d-md-block">
				<h1 class="display-2">innovaccer</h1>
				<h3>Welcome to our office</h3>
				<a href="visitor.php"><button type="button" class="btn btn-outline-light btn-lg">VISITOR</button></a>
				<a href="host.php"><button type="button" class="btn btn-outline-light btn-lg">HOST</button></a>
			</div>
    	</div>
    <div class="carousel-item">
	  	<img class="d-block w-100" src="./img/background.png" alt="Second slide">
		<div class="carousel-caption d-md-block">
			<h1 class="display-2">innovaccer</h1>
			<h3>A Silicon Valley-based healthcare company.</h3>
			<!-- <iframe src="https://youtu.be/_Jaw31AdGr4" frameborder="1"></iframe> -->
			<a href="visitor.html"><button type="button" class="btn btn-outline-light btn-lg">VISITOR</button></a>
			<a href="host.html"><button type="button" class="btn btn-outline-light btn-lg">HOST</button></a>
		</div>
	</div>
  </div>
</div>


<!--- Jumbotron -->
<div class="container-fluid">
	<div class="row jumbotron">
		<div class="col-xs-12">
			<p class="lead">
				<span style="color:#E31C79; font-weight:bold; font-size:1.5rem;">Innovaccer</span> provides physician practices, hospitals, health systems, and other healthcare providers with population health management and Pay-for-performance solutions. 
				Innovaccer also provides solutions for care management, referral management, and patient engagement. 
			</p>
		</div>
	</div>
</div>

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




