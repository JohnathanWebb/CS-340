<?PHP
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<?php
    $ServerName = "classmysql.engr.oregonstate.edu";
    $UserName = "cs340_webbjohn";
    $pass = "3043";
    $db = "cs340_webbjohn";

    $conn = new mysqli($ServerName, $UserName, $pass, $db);

    if ($conn->connect_error) {
        die("Connection Failed: ".$conn->connect_error);
    }

	if(isset($_POST['sign_up_button'])) {
        $password = $_POST['password'];
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO owner (first_name, last_name, phone, email, password) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$password."')";
        
        if($conn->query($sql) == TRUE) {
            echo "Created Profile";
            $sql = "SELECT owner_id FROM owner WHERE email = '".$email."'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($result->num_rows == 1) {
                $_SESSION['owner_id'] = $row['owner_id'];
                $_SESSION['email'] = $email;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $conn->close();
            }
        }

    }
    if(isset($_POST['sign_in_button'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql = "SELECT owner_id, first_name, last_name FROM owner WHERE email = '".$email."' AND password = '".$password."'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1) {
            $_SESSION['owner_id'] = $row['owner_id'];
            $_SESSION['email'] = $email;
            $_SESSION['fname'] = $row['first_name'];
            $_SESSION['lname'] = $row['last_name'];
            $conn->close();
        }
    }

    if(isset($_POST['pcreate'])) {
        $pet_name = $_POST['pname'];
        $breed = $_POST['breed'];
        $bday = $_POST['bday'];
        $owner = $_SESSION['owner_id'];
        $weight = $_POST['weight'];
        $sex = $_POST['sex'];
  

        $sql = "INSERT INTO pet (pet_name, species, birthdate, pet_weight, sex, owner_id) 
        VALUES ('".$pet_name."', '".$breed."', '".$bday."', '".$weight."', '".$sex."', '".$owner."')";
        if($conn->query($sql) == TRUE) {
            echo $sex;
            echo "Pet Created!";
            $sql = null;
            $conn->close();
        }
        
    }

    if(isset($_POST['DeletePet'])) {
        $pet_id = $_POST['DeletePet'];
  

        $sql = "DELETE FROM pet WHERE pet_id = ".$pet_id;
        if($conn->query($sql) == TRUE) {
            $sql = null;
            $conn->close();
        }
        
    }

?>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a href="home.php" class="navbar-brand">Dogtor</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="vets.php" class="nav-link">Vets</a>
                </li>
                <li class="nav-item">
                    <a href="visits.php" class="nav-link">Visits</a>
                </li>
                <li class="nav-item active disabled">
                    <a href="pets.php" class="nav-link">Pets</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#SignInModal">Sign In</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#SignUpModal">Sign Up</button>
                </li>
            </ul>
        </div>
    </nav>
    
	<div class="modal fade" id="SignUpModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="pets.php" method="POST">
                    <div class="form-row m-3">
                        <div class="form-group col-md-12">
                            <hr class="mb-3">
                            <label for="Email_Input">Email</label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="form-group col-md-6">
                            <label for="First_Name_input">First Name</label>
                            <input type="text" class="form-control" id="First_Name_Input" placeholder="First Name" name="first_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="First_Name_input">Last Name</label>
                            <input type="text" class="form-control" id="Last_Name_Input" placeholder="Last Name" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="form-group col-md-6">
                            <label for="Password_Input">Phone Number</label>
                            <input type="tel" class="form-control" id="Phone_Input_Form" placeholder="555-555-5555" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"> 
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="form-group col-md-6">
                            <label for="Password_Input">Password</label>
                            <input type="password" class="form-control" id="Password_Input_Form" placeholder="Password" name="password" required> 
                        </div>
                    </div>
                    <div class="form-row mx-5 my-2">
                        <div class="form-group col-md-12 mx-auto">
                            <hr class="mb-3">
                            <button type="submit" class="btn btn-primary" name="sign_up_button">Sign Up!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
        <div class="modal fade" id="SignInModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="pets.php">
                    <div class="form-row m-3">
                        <div class="form-group col-md-12">
                            <hr class="mb-3">
                            <label for="Email_Input">Email</label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="form-group col-md-12">
                            <label for="Password_Input">Password</label>
                            <input type="password" class="form-control" id="Password_Input_Form" placeholder="Password" name="password"> 
                        </div>
                    </div>
                    <div class="form-row mx-5 my-2">
                        <div class="form-group col-md-12 mx-auto">
                            <hr class="mb-3">
                            <button type="submit" class="btn btn-primary" name="sign_in_button">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 m-5">
                <?php
                echo "<h1>".$_SESSION['fname']." ".$_SESSION['lname']."'s Pets</h1>";
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-5">
                <table class="table mr-5">
                    <thead>
                        <tr>
                            <th>Pet Name</th>
                            <th>Breed</th>
                            <th>Weight</th>
                            <th>Birthdate</th>
                            <th>Sex</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                        $conn = mysqli_connect("classmysql.engr.oregonstate.edu", "cs340_webbjohn", "3043", "cs340_webbjohn");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT pet_name, species, birthdate, pet_weight, sex, pet_id FROM pet WHERE owner_id = ".$_SESSION['owner_id'];
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["pet_name"]. "</td><td>" . $row["species"] . "</td><td>". $row["pet_weight"]. "</td><td>" . $row["birthdate"]. "</td><td>"  . $row["sex"]. "</td><td><form method='POST' action='pets.php'><button class='btn btn-primary' value=".$row['pet_id']." name='DeletePet'>Delete Pet</form></td></tr>";
                            }
                           
                        } 
                        $conn->close();
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-5">
                <form action="pets.php" method="POST">
                    <div class="form-row m-2">
                        <div class="form-group col-3 m-2">
                            <label>Pet Name</label>
                            <input type="text" class="form-control" placeholder="Spot" name="pname" required>
                        </div>
                        <div class="form-group col-3 m-2">
                            <label>Breed</label>
                            <input type="text" class="form-control" placeholder="Labrador" name="breed" required>
                        </div>
                    </div>
                    <div class="form-row m-2">
                        <div class="form-group col-3 m-2">
                            <label>Birthdate</label>
                            <input type="date" class="form-control" name="bday" required>
                        </div>
                        <div class="form-group col-3 m-2">
                            <label>Weight (in pounds)</label>
                            <input type="number" class="form-control" placeholder="10.00" name="weight" step=".01" required>
                        </div>
                    </div>
                    <div class="form-row m-2">
                        <div class="form-group col-3 m-2">
                            <label>Sex</label>
                            <input type="text" class="form-control" placeholder="Male/Female" name="sex" required>
                        </div>
                    </div>
                    <div class="form-row m-2">
                        <div class="fomr-group col-4 m-2">
                            <input class="btn btn-primary" type="submit" name="pcreate" value="Add Pet!">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>