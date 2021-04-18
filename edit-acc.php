<!DOCTYPE html>
<html>
<head>
<title>User Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="Instagraham_style.css">
<link rel="stylesheet" href="geni.css" type="text/css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1, h2, h3, h4, h5, h6 {
	font-family: "Karma", sans-serif
}

body, html {
	height: 100%;
	margin: 0;
}
</style>
</head>

<!-- Retrieve data from user -->
<?php
include 'connection.php';
session_start();
$id = $_SESSION['iduser'];
$query = mysqli_query($db, "SELECT * FROM users where iduser='$id'") or die(mysqli_error());
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
        $sql = "UPDATE users SET password = ? WHERE iduser = ?";

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
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
			<li><a href="login-test.php">Login</a></li>
			<li><a href="logout-test.php">Logout</a></li>
			<li><a class="active" href="user-prof.php">User</a></li>
			<li><a href="delete-account-page-test.php">Delete account</a></li>
		</ul>
	</div>

	<!-- edit profile tab -->
	<div class="content">
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
		<div id="edit-passwrd" class="tabcontent">
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

		<!--validate password-->


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

</body>
</html>

<!-- set username and email -->
<?php
if (isset($_POST['submit-1'])) {
    $username = $_POST['Uname'];
    $email = $_POST['Email'];
    $nickname=$_POST['Nname'];
    $gender=$_POST['Gender'];
    $query = "UPDATE users SET username = '$username',
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


        

