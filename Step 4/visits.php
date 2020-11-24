<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Visits</title>
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
	<h1>Services</h1>
	<table class="table table-dark">
  		<thead>
			<tr>
			<th scope="col">Service ID</th>
			<th scope="col">Service Description</th>
			</tr>
		</thread>

		<?php
		if(isset($_POST['create'])) {
			$pname = $_POST['pet_name'];
			$vname = $_POST['vet_name'];
			$date = $_POST['date'];
			$cost = $_POST['cost'];
			$service = $_POST['service'];
			$fileup = $_POST['file_upload'];
			$owner = $_SESSION['owner_id'];
		

		}
		$conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT service_id, type FROM service";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["service_id"]. "</td><td>" . $row["type"] . "</td></tr>";
			}
			echo "</table>";
		}
		$conn->close();
		
		?>
	</table>

	<h1>Visits</h1>
	<table class="table table-dark">
  		<thead>
			<tr>
			<th scope="col">Date</th>
			<th scope="col">Pet ID</th>
			<th scope="col">Vet ID</th>
			<th scope="col">Cost</th>
			<th scope="col">Service ID</th>
			<th scope="col">File Upload</th>
			</tr>
		</thread>

		<?php
			$conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT * FROM visit";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["date"]. "</td><td>" . $row["pet_id"] . "</td><td>". $row["vet_id"]. "</td><td>" . $row["cost"]. "</td><td>"  . $row["service_id"]. "</td><td>"  . $row["file_upload"]. "</td></tr>";
				}
				echo "</table>";
			} 
			$conn->close();
		?>
	</table>
	<form action="visits.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Add Visit</h1>
                    <hr class="mb-3">
                    Pet Name: <input type="text" name="pet_name" required class="form-control">
                    Date: <input type="date" name="date" required class="form-control">
                    Vet Name: <input type="text" name="vet_name" required class="form-control">
                    Cost: <input type="text" name="cost" required class="form-control">
                    Service Type: <input type="text" name="service" required class="form-control">
                    Document(s): <input type="file" name="file_upload" class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" value="Add Visit">
                </div>
            </div>
        </div>
    </form>
</body>
</html>