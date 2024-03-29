<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
  
  header("location: index.php");

}
else{ ?>
<html>
<head>
	<?php 
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'"; 
		$run_user = mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
					
		$user_id = $row['user_id']; 
		$user_name = $row['user_name'];
		?>
		<title><?php echo"$user_name"; ?></title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="style/homestyle.css" media="all"/>
		<link rel="stylesheet" href="style/profilestyle.css" media="all"/>
</head>
<style>


</style>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
          <?php
          echo "
         	<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'/></div>
				<form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
					<ul class='nav pull-left' style='position: absolute;top: 10px;left: 40px;'>
				    	<li class='dropdown'>
				        	<button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button> 
							
							<div class='dropdown-menu'>
				        		<center>
				        		<p> Click Select Cover and then click Update Cover</p>
								
								<label class='btn'>Select Cover<input type='file' name='u_cover' size='60' />
						        </label><br><br>
				                <button name='submit' class='btn' >Update cover</button>
				            	</center>
				            </div>
				        </li>
				    </ul>
	          	</form>
			</div>
         	<div id='profile_img'>
	            <img src='users/$user_image' alt='Profile' class='img-circle' width='180px' height='185px' />
	            <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
				
				<label id='update_profile'>Select Image
	            <input type='file' name='u_image' size='60' />
	            </label>
	            <button id='button_profile' name='update' class='btn'>Update Profile</button>
	            </form>
          	</div><br>
          "; ?>

           <?php 

            if(isset($_POST['submit'])){

              $u_cover = $_FILES['u_cover']['name'];
              $image_tmp = $_FILES['u_cover']['tmp_name'];
              $random_number = rand(1,100);

              if($u_cover==''){
                echo "<script>alert('Please Select Cover Image!')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                exit();
              }else{
              
              move_uploaded_file($image_tmp,"cover/$u_cover.$random_number");
              
              $update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";
              
              $run = mysqli_query($con,$update); 
              
              if($run){
              
              echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
              }
            }
            
            }


          ?>
          </div>
          <?php 

            if(isset($_POST['update'])){

              $u_image = $_FILES['u_image']['name'];
              $image_tmp = $_FILES['u_image']['tmp_name'];
              $random_number = rand(1,100);

              if($u_image==''){
                echo "<script>alert('Please Select Profile Image on clicking on the profile image area!')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                exit();
              }else{
              
              move_uploaded_file($image_tmp,"users/$u_image.$random_number");

              
              $update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";
              
              $run = mysqli_query($con,$update); 
              
              if($run){
            
              echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
              }
            }
            
            }


          ?>
    <div class="col-sm-2">
	</div>
</div>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-2" style="background-color: #e6e6e6; text-align: center; left:0.8%; border-radius: 5px;">
		<?php
		echo"
		<center><h1>About</h1></center><br>
		<center><h4>$first_name $last_name</strong></h4></center>
        <p><b>$describe_user</b></p><br>
        <p><strong>Lives In: </strong> $user_dis</p><br>
        <p><strong>Gender: </strong>  $user_gender</p><br>
        <p><strong>Date Of Birth: </strong>  $user_birthday</p><br>
        ";
        ?>
	</div>
	<div class="col-sm-6">


		<?php
			global $con;
	
			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";
			
			$run_posts = mysqli_query($con,$get_posts);
			
			while($row_posts=mysqli_fetch_array($run_posts)){
		
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date'];

			
			$user = "select * from users where user_id='$user_id' AND posts='yes'"; 
			
			$run_user = mysqli_query($con,$user); 
			$row_user=mysqli_fetch_array($run_user);
			
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];
			

			if($content=="No" && strlen($upload_image) >= 1){
			echo "
			<div id='own_posts'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
				<a href='p_view.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
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
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
				<a href='p_view.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
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
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
					</div>
					<div class='col-sm-4'>
						
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-6'>
						<h3><p>$content</p></h3>
					</div>
					<div class='col-sm-4'>
						
					</div>
				</div>
			";
			global $con;
	
			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			$get_posts = "select user_email from users where user_id='$u_id'";
			$run_user = mysqli_query($con,$get_posts);
			$row=mysqli_fetch_array($run_user);

			$user_email = $row['user_email'];

			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['user_id'];
			$u_email = $row['user_email'];

			if($u_email != $user_email){
				echo"<script>window.open('profile.php?u_id=$user_id','_self')</script>";
			}else{

			echo"
				<a href='p_view.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
				<a href='edit_post.php?post_id=$post_id' style='float:right;'><button  class='btn'>Edit</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
			</div><br/><br/><br/>
			";
			}
		}
			include("functions/delete_post.php");
			
		}
	

		?>


	</div>
	<div class="col-sm--2">
		
	</div>
</div>	
</body>
</html>
<?php } ?>