<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Sign Up Form</title>
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
<?php
   if(isset($_POST['create'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $pass = $_POST['password'];


    $sql = "INSERT INTO owner (first_name, last_name, email, phone, password, address, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$fname, $lname, $email, $phone, $address, $state, $zipcode, $pass]);

    
    if($result) {
        $conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT owner_id FROM owner WHERE password ='".$pass."'AND email='".$email."' LIMIT 1";
        $result2 = $conn->query($sql);
        $rows = $result2->fetch_assoc();
        if ($result2->num_rows == 1) { 
            $_SESSION['owner_id'] = $rows['owner_id'];
            echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
        } 
        $conn->close();
    } else {
        echo "Failed to create profile";
    }

}
?>
</div>

    <form action="signup.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Create Profile</h1>
                    <hr class="mb-3">
                    First Name: <input type="text" name="first_name" required class="form-control">
                    Last Name: <input type="text" name="last_name" required class="form-control">
                    Email: <input type="text" name="email" required class="form-control">
                    Phone Number: <input type="text" name="phone_number" required class="form-control">
                    Address: <input type="text" name="address" required class="form-control">
                    State: <input type="text" name="state" required class="form-control">
                    Zipcode: <input type="text" name="zipcode" required class="form-control">
                    Password: <input type="text" name="password" required class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                </div>
            </div>
        </div>
    </form>
</body>
</body>
</html>