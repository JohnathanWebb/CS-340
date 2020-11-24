<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Profile</title>
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
        </div>
    </nav>
</div>
<div>
<br>
<?php

    if(isset($_POST['update'])) {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone_number'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $owner = $_SESSION['owner_id'];

		$sql = "UPDATE owner SET first_name = (?), last_name = (?), phone = (?), address = (?), state = (?), zipcode = (?) WHERE owner_id = ?";
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute([$fname, $lname, $email, $phone, $address, $state, $zipcode, $owner]);

		if($result) {
			echo "Update succesful";
		} else {
			echo "Failed to update profile";
		}

    }
    if(isset($_POST['delete'])) {
        $email_delete = $_SESSION['email'];
        
        $sql = "DELETE FROM owner WHERE email = (?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$email_delete]);
        if($result) {
            $_SESSION['owner_id'] = NULL;
            $_SESSION['email'] = NULL;
        } 
    }
    
?>
</div>
            <?php
                $conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $owner = $_SESSION['owner_id'];
                $sql = "SELECT * FROM pet WHERE owner_id = ".$owner;
                $result = $conn->query($sql);
                $sql2 = "SELECT * FROM owner WHERE owner_id = ".$owner;
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    if($row = $result2->fetch_assoc()) {
                        echo '<form action="profile.php" method="post">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-3">';
                        echo '<h1>Update</h1>';
                        echo '<hr class="mb-3">';
                        echo 'First Name: <input type="text" name="first_name" required class="form-control" value='.$row["first_name"].'>';
                        echo ' Last Name: <input type="text" name="last_name" required class="form-control"value='.$row["last_name"].'>';
                        echo 'Email: <input type="text" name="email" required class="form-control"value='.$row["email"].'>';
                        echo 'Phone Number: <input type="text" name="phone_number" required class="form-control"value='.$row["phone"].'>';
                        echo 'Address: <input type="text" name="address" required class="form-control"value='.$row["address"].'>';
                        echo 'State: <input type="text" name="state" required class="form-control"value='.$row["state"].'>';
                        echo 'Zipcode: <input type="text" name="zipcode" required class="form-control"value='.$row["zipcode"].'>';
                        echo '<hr class="mb-3">';
                        echo '<input class="btn btn-primary" type="submit" name="update" value="Update">';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                    }
                } 
                $conn->close();
            ?>

    <form action="profile.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Delete Profile</h1>
                    <input class="btn btn-primary" type="submit" name="delete" value="Delete">
                </div>
            </div>
        </div>
	</form>
    <br>
</body>
</body>
</html>