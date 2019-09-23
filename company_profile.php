<!DOCTYPE html>
<?php
session_start();
include("includes/cheader.php");

?>
<?php

if(!isset($_SESSION['c_email'])){

	header("location: index.php");

}

else{ ?>
<html>
<head>
	<title>Welcomme to Home</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/homestyle.css" media="all"/>
</head>
<style>
#own_posts{
    border: 5px solid #e6e6e6;
    padding: 40px 50px;
	width:90%;
}
#posts_img {
    height:300px;
   	width:100%;
}
</style>
<body>
<div class="row">
	<?php
	global $con;

			if(isset($_GET['c_id'])){
			$c_id = $_GET['c_id'];
			}
			if($c_id < 0 OR $c_id == ""){
				echo"<script>window.open('comfeed.php','_self')</script>";
			}else{ 

	?>



	<div class="col-sm-12">
		<?php
			if(isset($_GET['c_id'])){

			global $con;

			$c_id = $_GET['c_id'];

			$select = "select * from company where c_id='$c_id'";
			$run = mysqli_query($con,$select);
			$row=mysqli_fetch_array($run);

			$name = $row['cuser_name'];
			}

		?>


		<?php

		if(isset($_GET['c_id'])){

				global $con;

				$c_id = $_GET['c_id'];

				$select = "select * from company where c_id='$c_id'";
				$run = mysqli_query($con,$select);
				$row=mysqli_fetch_array($run);

				$id = $row['c_id'];
				$image = $row['c_image'];
				$name = $row['cuser_name'];
                $f_name = $row['c_name'];
                $user_dis=$row['c_area'];
                $c_tel=$row['c_tel'];
                $c_email=$row['c_email'];
                $c_cat=$row['c_cat'];
                $c_add=$row['c_add'];
				$describe_user = $row['cdescribe_user'];
				$register_date = $row['c_reg_date'];

				echo "
				<div class='row'>
					<div class='col-sm-1'>
					</div>
					<center>
					<div style='background-color: #e6e6e6;' class='col-sm-3'>
					<h2>Information about</h2>
					<img class='img-circle' src='users/$image' width='150' height='150' />
					<br><br>
					<ul class='list-group'>
					  <li class='list-group-item' title='Username'><strong>$f_name</strong></li>
					  <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
					  <li class='list-group-item' title='Area'>$user_dis</li>
					  <li class='list-group-item' title='User Registration Date'>$register_date</li>
					</ul>
					";
					$user = $_SESSION['c_email'];
					$get_user = "select * from company where c_email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);

					$userown_id = $row['c_id'];
					$cuser_name = $row['cuser_name'];
					$user_image = $row['c_image'];

					if($user_id == $userown_id){
						echo"<a href='cedit_profile.php?u_id=$userown_id' class='btn btn-success'/>Edit Profile</a><br><br><br>";
					}

					echo"
					</div>
					</center>
					";
				}
			?>
	<div class='col-sm-8'>
		<center><h1><strong><?php echo "$c_name"; ?></strong> Posts</h1></center>
			<?php
				global $con;

				if(isset($_GET['c_id'])){
				$u_id = $_GET['c_id'];
				}
				$get_posts = "select * from cposts where user_id='$c_id' ORDER by 1 DESC LIMIT 5";

				$run_posts = mysqli_query($con,$get_posts);

				while($row_posts=mysqli_fetch_array($run_posts)){

				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				$user = "select * from company where c_id='$c_id' AND posts='yes'";

				$run_user = mysqli_query($con,$user);
				$row_user=mysqli_fetch_array($run_user);

				$cuser_name = $row_user['cuser_name'];
				$f_name = $row['c_name'];
				
				$user_image = $row_user['c_image'];


				if($content=="No" && strlen($upload_image) >= 1){
				echo "
				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$cuser_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>

						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
						</div>
					</div><br>
					<a href='cp_view.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
					<a href='functions/cdelete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
				</div><br/><br/>
				";


				}
				else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
				echo "
				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$cuser_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>

						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
						</div>
					</div><br>
					<a href='cp_view.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
					<a href='functions/cdelete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
				</div><br/><br/>
				";


				}
				else{

				echo "

				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$cuser_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>

						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content...</p></h3><br>
						</div>
					</div><br>
					<a href='cp_view.php?post_id=$post_id' style='float:right;'><button class='btn'>Comment</button></a><br>
				</div><br><br>
				";


			}
		}
		?>
		</div>
	</div>
</div>
<?php }  ?>
</body>
</html>
<?php } ?>
