<!DOCTYPE html>
<head>
<title>Destine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
</head>

<style>
	body{
		overflow-x: hidden;
		/*overflow-y: hidden;*/ 
	}

	#centered1{
		position: absolute;
		font-size: 10vw;
		top:34%;
		left:45%;
		transform: translate(-50%, -50px); 
	}
	#centered2{
		position: absolute;
		font-size: 10vw;
		top: 54%;
		left:45%;
		transform: translate(-50%, -50px); 
	}
	#centered3{
		position: absolute;
		font-size: 10vw;
		top: 74%;
		left:45%;
		transform: translate(-50%, -50px); 
	}

	#signup{
		width: 85%;
		border-radius: 30px;
		background-color: #505050;
		border-color: #505050;

	}


	#signup:hover{
		width: 85%;
		background-color: #505050;
		border-color:#505050;
		border-radius: 30px;
	}

	#login{
		width: 85%;
		background-color: #fff;
		border-color: #505050;
		color: #505050;
		border-radius: 30px;

	}

	#login:hover{
		width: 85%;
		background-color: #fff;
		color: #393939;
		border-color:#505050;
		border-radius: 30px;
	}

	.well{
		background-color: #393939;
		height:110px;
	}
</style>

<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><b><h1 style="color: white;">Destine</h1></b></center>
				<center><i><h5 style="color: white;">Build your dream House,Shop or anthing as you expected</h5></i></center>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6" style="Left:1%;">
			<img src="images/isf.jpg" class="img-rounded" title="Destine" width="650px" height="634px">
			
			<div id="centered1" class="centered"><h3 style="color:#e6e6e6;">
				<span class="glyphicon glyphicon-search"></span>
					&nbsp&nbsp<strong>Plan Your Dream</strong></h3></div>

			<div id="centered2" class="centered"><h3 style="color:white;">
				<span class="glyphicon glyphicon-search"></span>
					&nbsp&nbsp<strong>Manage Your Dream</strong></h3></div>

			<div id="centered3" class="centered"><h3 style="color:white;">
				<span class="glyphicon glyphicon-search"></span>		
					&nbsp&nbsp<strong>Success Your Dream</strong></h3></div>

			</div>
		

	<div class="col-sm-6" style="left:1%;">
		<img src="images/logo1.jpg" class="img-rounded" title="Destine" width="120px" height="120px">

		<h2><strong>Plan,Manage and Success<br>your whole life</strong></h2><br><br>
		<h4><strong>Join Destine Today ; )</strong></h4><br>

		<form method="post" action="">

				<button id="signup" class="btn btn-info btn-lg" name="signup">Register</button><br><br>
				<?php
					if (isset($_POST['signup'])) {
						echo "<script>window.open('register_menu.php','_self')</script>";
					}
				?>

				<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>
				<?php
					if (isset($_POST['login'])) {
						echo "<script>window.open('login_menu.php','_self')</script>";
					}
				?>
		</div>
	</div>
</body> 
</html>