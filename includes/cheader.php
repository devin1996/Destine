<?php
include("includes/connection.php");
include("functions/functions.php");

?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapsed" area-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		 	<span class="icon-bar"></span>
		 	</button>
		 	<a href="uforc.php" class="navbar-brand">Destine</a>
		</div>
		<div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php
				$email = $_SESSION['c_email'];
				$get_user = "select * from company where c_email='$email'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$c_id = $row['c_id'];
				$c_name = $row['c_name'];
				$cu_name = $row['cuser_name'];
				$describe_user = $row['cdescribe_user'];
				$c_pass = $row['c_pass'];
				$c_email = $row['c_email'];
				$c_area = $row['c_area'];
				$c_tel = $row['c_tel'];
				$c_add = $row['c_add'];
				$c_cat=$row['c_cat'];
				$c_image = $row['c_image'];
				$c_cover = $row['c_cover'];			
				$crecovery_account = $row['crecovery_account'];
				$register_date = $row['c_reg_date'];

				$user_posts = "select * from cposts where user_id='$c_id'";
				$run_posts = mysqli_query($con, $user_posts);
				$posts = mysqli_num_rows($run_posts);
				?>
				<li><a href='cprofile.php?<?php echo "c_id=$c_id" ?>'><?php echo"$c_name"?></a></li>
				<li><a href="uforc.php">Home</a></li>
				<li><a href="findcforc.php">Find Companies</a></li>
				<li><a href="findiforc.php">Find Induviduals</a></li>
				<li><a href="finduforc.php">Find Users</a></li>
				<?php
					echo"
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
							<ul class='dropdown-menu'>

								<li>
									<a href='cedit.php?u_id=$c_id'>Edit Account 
									</a>
								</li>
								<li role='separator' class='driver'></li>
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
				";
				?>
			</ul>
		 	
		</div>
	</div>
</nav>
