
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

<body>

	<!-- Top navigator -->
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
			<li><a href="login-test.php">Login</a></li>
			<li><a href="logout-test.php">Logout</a></li>
			<li><a class="active" href="user-prof.php">User</a></li>
			<li><a href="delete-account-page-test.php">Delete account</a></li>>
		</ul>
	</div>

	<div class="content">
		<div id="top-layer">
				<img id="user-img" src="user-prof icon.png"></img>
			<div id="name">
			<?php 
			echo "<h1>" . $row["username"] . "&nbsp;" . "(" . $row["nickname"] . ")". "</h1>";
			?>
			</div>
			<button onclick="document.location='edit-acc.php'" id="editacc-btn"
				type="button">
				<i class="fa fa-cog"></i> Edit Account
			</button>
		</div>

	</div>


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