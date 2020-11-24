<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Vets</title>
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
    if(isset($_POST['create'])) {
        $name = $_POST['name'];
		$animal = $_POST['birthdate'];
		$owner_id = '1';
		$insurance = $_POST['insurance'];


        $sql = "INSERT INTO vet (clinic_name, address, state, zipcode, phone, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$clinic_name, $address, $state, $zipcode, $phone, $email]);
        if(!$result) {
            echo "Failed to create vet";
        } 
	}
	if(isset($_POST['delete'])) {
        $clinic_delete = $_POST['clinic_delete'];
		


        $sql = "DELETE FROM vet WHERE clinic_name = (?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$clinic_delete]);
        if(!$result) {
            echo "Failed to create vet";
        } 
    }
?>
</div>

    <form action="vets.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Add Vet</h1>
                    <hr class="mb-3">
                   	Clinic Name: <input type="text" name="clinic_name" required class="form-control">
                    Address: <input type="text" name="address" required class="form-control">
					State: <input type="text" name="state" required class="form-control">
					Zipcode: <input type="text" name="zipcode" class="form-control">
					Phone: <input type="text" name="phone" class="form-control">
					Email: <input type="text" name="email" class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" value="Add Vet">
                </div>
            </div>
        </div>
	</form>
	<br>
    <form action="vets.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Delete</h1>
                    <hr class="mb-3">
                   	Clinic_Name: <input type="text" name="clinic_delete" required class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="delete" value="Delete">
                </div>
            </div>
        </div>
	</form>
	<br>
	<table class="table table-dark">
  		<thead>
			<tr>
			<th scope="col">Clinic Name</th>
			<th scope="col">Address</th>
			<th scope="col">State</th>
			<th scope="col">Zipcode</th>
			<th scope="col">Phone</th>
			<th scope="col">Email</th>
			</tr>
		</thread>
        <h1>Vets</h1>
		<?php
			$conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT * FROM vet";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["clinic_name"]. "</td><td>" . $row["address"] . "</td><td>". $row["state"]. "</td><td>" . $row["zipcode"]. "</td><td>"  . $row["phone"]. "</td><td>"  . $row["email"]. "</td></tr>";
				}
				echo "</table>";
			} else { echo "0 results"; }
			$conn->close();
		?>
	</table>
</body>
</body>
</html>