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

<?php
  include 'connection.php';
  session_start();
$id=$_SESSION['iduser'];
$query=mysqli_query($db,"SELECT * FROM users where iduser='$id'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>
<body>

	<!-- Top navigator -->
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
			<li><a class="active" href="user-prof.html">User</a></li>
		</ul>
	</div>

	<div class="content">
		<div class="tab">
			<button class="tablinks" onclick="openStatus(event, 'edit-profile')"
				id="defaultOpen">Edit Profile</button>
			<button class="tablinks" onclick="openStatus(event, 'edit-passwrd')">Edit
				Password</button>
		</div>

		<div id="edit-profile" class="tabcontent">

			<form action="#" method="post"
				enctype="multipart/form-data">
				<h3>Edit Profile</h3>
				<label>Username :</label> <input type="text" id="username"
					name="Uname"><br>
				<br> <label>E-mail :</label> <input type="text" id="email"
					name="Email"><br>
				<br> <input type="submit" name="submit-1" value="Submit" class="user-submit">
			</form>
		</div>

		<div id="edit-passwrd" class="tabcontent">
			<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
				<h3>Edit Password</h3>
				<label>Old Password :</label> <input type="text" id="old-password"
					name="old-password"><br>
				<br> <label>New Password :</label> <input type="text"
					id="new-password" name="new-password"><br>
				<br> <label>Confirm Password :</label> <input type="text"
					id="confirm-password" name="confirm-password"><br>
				<br> <input type="submit" name="submit-2" value="Submit" class="user-submit">
			</form>
		</div>
	</div>

<?php /*tab function*/?>
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

<?php /*validate password*/?>
<script>
function validatePassword() {
var old-password,new-password,confirm-password,output = true;

old-password = document.frmChange.old-password;
new-password = document.frmChange.new-password;
confirm-password = document.frmChange.confirm-password;

if(!old-password.value) {
old-password.focus();
document.getElementById("old-password").innerHTML = "required";
output = false;
}
else if(!new-password.value) {
new-password.focus();
document.getElementById("new-password").innerHTML = "required";
output = false;
}
else if(!confir-password.value) {
confirm-password.focus();
document.getElementById("confirm-password").innerHTML = "required";
output = false;
}
if(new-password.value != confirm-password.value) {
new-password.value="";
confirm-password.value="";
new-password.focus();
document.getElementById("confirm-password").innerHTML = "not same";
output = false;
} 	
return output;
}
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
</body>
</html>

<?php
      if(isset($_POST['submit-1'])){
        $username = $_POST['Uname'];
        $email = $_POST['Email'];
      $query = "UPDATE users SET username = '$username',
                      email = '$email'
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

<?php
session_start();
$_SESSION["userId"] = "9";
$db = mysqli_connect("localhost", "root", "test", "blog_samples") or die("Connection Error: " . mysqli_error($conn));

if (count($_POST) > 0) {
    $result = mysqli_query($db, "SELECT *from users WHERE iduser='" . $_SESSION["iduser"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["old-password"] == $row["password"]) {
        mysqli_query($db, "UPDATE users set password='" . $_POST["new-password"] . "' WHERE iduser='" . $_SESSION["iduser"] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
