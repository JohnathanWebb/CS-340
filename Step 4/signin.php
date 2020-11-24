<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Sign In</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="vets.php" class="nav-link">Vets</a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="pets.php" class="nav-link">Pets</a></li>
                <li class="nav-item"><a href="visits.php" class="nav-link">Visits</a></li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signin.php">Sign In</a>
                    </li>
                </ul>
        </div>
    </nav>
</div>
<?php
    if(isset($_POST['signin'])) {
		$pass = $_POST['password'];
		$email = $_POST['email'];

		$conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT owner_id FROM owner WHERE password ='".$pass."'AND email='".$email."' LIMIT 1";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		if ($result->num_rows == 1) { 
			$_SESSION['email'] = $email;
			$_SESSION['owner_id'] = $rows['owner_id'];
			echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
		} 
		$conn->close();
    }
?>
<div>
<form action="signin.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Sign In</h1>
                    <hr class="mb-3">
                    Email: <input type="text" name="email" required class="form-control">
                    Password: <input type="text" name="password" required class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="signin" value="Sign Up">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>