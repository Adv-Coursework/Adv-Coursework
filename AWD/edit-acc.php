<!DOCTYPE html>
<html>
<head>
<title>Edit Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Instagraham_style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1, h2, h3, h4, h5, h6 {
	font-family: "Karma", sans-serif;
	overflow:hidden;
}

body, html {
	height: 100%;
	margin: 0;
}
</style>
</head>

<!-- Retrieve data from user -->
<?php
session_start();

include 'connection.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "Please login to access to the page.";
    exit;
}

$id = $_SESSION['iduser'];
$query = mysqli_query($db, "SELECT * FROM creator where iduser='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
?>

<!-- change password -->  
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE creator SET password = ? WHERE iduser = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["iduser"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                $message = 'Password changed succesfully.';
                echo "<SCRIPT>
                    alert('$message')
                    window.location.replace('login-test.php');
                </SCRIPT>";
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
 
<body>
	<!-- Top navigator -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!-- add logo with link to home page -->
		<a class="navbar-brand" style="width: 10%;" href="Instagraham_Inc.php"><img
			src="InstagrahamInc.png" alt="InstagrahamInc_Logo"
			style="width: 100%; object-fit: contain;"></a>
		<!-- responsive collapse navbar -->
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link"
					href="Instagraham_Inc.php" style="color:black;">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php
                    if (isset($_SESSION["iduser"])) {
                        
                        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
                    }
                    ?>
				<li class="nav-item"><a class="nav-link" href="all-albums.php"
					style="color: black;">Album</a></li>
	
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
						
					 <!-- display different dropdown item based on guest/logged in user -->
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php 
						if (isset($_SESSION["iduser"])) {
						    echo "<a class='dropdown-item' href='user-prof.php' style='color: black;''>Profile</a> ";
						    echo "<div class='dropdown-divider'></div>";						    
						}
						
						if (empty($_SESSION["iduser"])) {
						    echo "<a class='dropdown-item' href='login-test.php' style='color: black;''>Login</a> ";
						}
						
						if (isset($_SESSION["iduser"])) {
						    echo "<a class='dropdown-item' href='logout-test.php' style='color: black;''>Logout</a>";
						}
						?>
							
						
					</div></li>
			</ul>
			<div class="d-inline-block">
				<p style="margin: 0px"> Welcome,
			<?php
            if (isset($_SESSION["iduser"])) {
                echo $_SESSION["username"];
            } else{
                echo "guest user!";
            }
            ?>
			</p>
			</div>
		</div>
	</nav>


	<!-- Modal for delete account-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <?php 
        /*When in user is logged in in session, delete user account according to iduser*/
        $id=$_SESSION['iduser'];
        $q = "SELECT iduser,username FROM creator WHERE iduser = $id";
        $rs = mysqli_query($db,$q);
        $getRowAssoc = mysqli_fetch_assoc($rs);
       
        echo "<p><h5>Deleting user". "&nbsp;<b>".$getRowAssoc["username"]. "</b>&nbsp;"."from database! Are you sure?"."</h5></p>";
        echo "<br>";
        echo "<h5><center><a href = \"delete-account-test.php?id=" . $getRowAssoc["iduser"] . " \" > Delete </a></center></h5>";
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

	<!-- edit profile tab -->

	<div class="container" style="width:70%; margin-top: 40px;" >
	<div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
		<div class="tab">
			<button class="tablinks" onclick="openStatus(event, 'edit-profile')"
				id="defaultOpen">Edit Profile</button>
			<button class="tablinks" onclick="openStatus(event, 'edit-passwrd')">Edit
				Password</button>
		</div>

		<!-- edit username & email tab content -->
		<div id="edit-profile" class="tabcontent">
			<form action="#" method="post" enctype="multipart/form-data">
				<h3>Edit Profile</h3>
				<label>Username :</label> 
				<input type="text" id="username" name="Uname" value="<?= $row["username"]?>" required><br> <br> 
				<label>Nickname :</label> 
				<input type="text" id="nickname" name="Nname" value="<?= $row["nickname"]?>"><br> <br> 
				<label>Gender :</label> 
				<input type="text" id="gender" name="Gender" value="<?= $row["gender"]?>"><br> <br> 
				<label>E-mail :</label> 
				<input type="email" id="email" name="Email" value="<?= $row["email"]?>"><br> <br> 
				<input type="submit" name="submit-1" value="Submit" class="user-submit">
			</form>
		</div>

		<!-- edit password tab content -->
		<div id="edit-passwrd" class="tabcontent" style="padding: 15px 20px;">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
				method="post">
				<h3>Edit Password</h3>
				<label>New Password:</label> <input type="password" name="new_password" id="new-password"
					<?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
				<span class="invalid-feedback"><?php echo $new_password_err; ?></span><br><br> 
				<label>Confirm Password:</label> <input type="password" name="confirm_password" id="confirm-password"<?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
				<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><br>
				<br> <input type="submit" class="user-submit" value="Submit">
			</form>
		</div>
		</div>
</div>

<?php 
echo "<a class='btn btn-danger offset-8' style='margin-top:10px;' href='delete-account-test.php?id=" . $_SESSION['iduser'] . "'>Delete Account</a>";
?>

		
		<!--tab function-->
		<script>
function openStatus(evt, statusName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(statusName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

		<!-- Footer -->
		<!-- Footer boarderline -->

		<hr class="footer-line">

		<footer class="footer">
			<div class="footer-about">
				<h3>About Us</h3>
				<p>Instagraham Inc.'s main product is a thinly-veiled copy of
					Instagram.</p>
			</div>
			<div class="footer-contact">
				<h3 style="text-align: center;">Contact</h3>
				<ul>
					<li>Email: instagrahaminc@insta.com</li>
					<li>Tel: +603-12345678</li>
				</ul>
			</div>
			<div class="footer-office">
				<h3>Office Hour</h3>
				<p>9:00AM to 6:00PM</p>
				<p>Monday to Saturday</p>
			</div>
		</footer>
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<!-- set username and email -->
<?php
if (isset($_POST['submit-1'])) {
    $username = $_POST['Uname'];
    $email = $_POST['Email'];
    $nickname=$_POST['Nname'];
    $gender=$_POST['Gender'];
    $query = "UPDATE creator SET username = '$username',
                      email = '$email', nickname='$nickname', gender='$gender'
                      WHERE iduser = '$id'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
       ?>
	<script type="text/javascript">
            alert("Update Successfull.");
            window.location = "edit-acc.php";
     </script>
<?php
}
?>