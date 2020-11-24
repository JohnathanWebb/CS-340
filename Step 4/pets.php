<?php
require_once('php/config.php');
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Pets</title>
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
		$animal = $_POST['animal'];
        $insurance = $_POST['insurance'];
        $birthdate = $_POST['birthdate'];

        $sql = "INSERT INTO pet (name, animal, owner_id, insurance, birthdate) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$name, $animal, $_SESSION['owner_id'], $insurance, $birthdate]);
        if(!$result) {
            echo "Failed to create pet";
        } 
	}
	if(isset($_POST['delete'])) {
        $pet_name = $_POST['name'];
		$owner = $_SESSION['owner_id'];


        $sql = "DELETE FROM pet WHERE name = (?) AND owner_id = (?) LIMIT 1";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$pet_name, $owner]);
        if(!$result) {
            echo "Failed to delete pet";
		} 
	}

?>
</div>

    <form action="pets.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Add Pet</h1>
                    <hr class="mb-3">
                   	Name: <input type="text" name="name" required class="form-control">
                    Breed: <input type="text" name="animal" required class="form-control">
					Birthdate: <input type="date" name="birthdate" required class="form-control">
					Insurance: <input type="text" name="insurance" class="form-control">
                    Picture(Optional): <input type="file" name="file_input" class="form-control">
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" value="Add Pet">
                </div>
            </div>
        </div>
	</form>
	<br>
	<form action="pets.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Delete Pet</h1>
                    <hr class="mb-3">
                   	Pet name: <input type="text" name="name" required class="form-control">
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
			<th scope="col">Pet ID</th>
			<th scope="col">Name</th>
			<th scope="col">Breed</th>
			<th scope="col">Date of Birth</th>
			<th scope="col">Insurance</th>
			</tr>
		</thread>

		<?php
			$conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
            }
            $owner = $_SESSION['owner_id'];
			$sql = "SELECT * FROM pet WHERE owner_id = ".$owner;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["pet_id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["animal"] . "</td><td>". $row["birthdate"]. "</td><td>" . $row["insurance"]. "</td></tr>";
				}
				echo "</table>";
			} 
			$conn->close();
		?>
	</table>
</body>
</body>
</html>