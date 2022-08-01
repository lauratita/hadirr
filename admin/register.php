<?php 

include '../koneksi.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE username='$username'";
		$result = mysqli_query($koneksi, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, password)
					VALUES ('$username', '$password')";
			$result = mysqli_query($koneksi, $sql);
			if ($result) {
				echo '<script>alert("Wow! User Registration Completed.");window.location.href="login.php"</script>';
				$username = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.');window.location.href='register.php'</script>";
			}
		} else {
			echo "<script>alert('Woops! Username Already Exists.');window.location.href='register.php'</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.');window.location.href='register.php'</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hadirr</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<!-- Sweetalert 2 CSS -->
	<link rel="stylesheet" href="../assets/plugins/sweetalert2/sweetalert2.min.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="../img/wave.png">
	<div class="container">
		<div class="img">
			<img src="../img/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="POST" class="login-email">
				<img src="../img/smea.jpg">
				<h2 class="title">Register</h2>

           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div>
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input" value="<?php echo $username; ?>" required>
           		   </div>
				</div>

				<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
					</div>
					<div class="input-group">
           		   		<h5>Password</h5>
           		   		<input type="password" name="password" class="input" value="<?php echo $_POST['password']; ?>" required>
           		 	</div>
				</div>

				<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
					<div class="input-group">
           		   		<h5>Confirm Password</h5>
           		   		<input type="password" name="cpassword" class="input" value="<?php echo $_POST['cpassword']; ?>" required>
           		 	</div>
				</div>

					<a href="login.php">Have Account?</a>

					<div class="input-group">
					<input type="submit" name="submit" class="btn" value="Create">
					</div>
            </form>
        </div>
    </div>

<!-- Must put our javascript files here to fast the page loading -->
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Sweetalert2 JS -->
	<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Page Script -->
	<script src="../assets/js/scripts.js"></script>S
    <script type="text/javascript" src="../js/main.js"></script>

</body>
</html>
