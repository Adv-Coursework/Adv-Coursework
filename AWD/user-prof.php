
<!DOCTYPE html>

<html>
<head>
<title>User Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Instagraham_style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/geni.css" type="text/css">
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
session_start();
include 'connection.php';
$id = $_SESSION['iduser'];
$query = mysqli_query($db, "SELECT * FROM users where iduser='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
?>

<body>

	<!-- Top navigator -->
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
				<li class="nav-item "><a class="nav-link"
					href="Instagraham_Inc.php" style="color:black;">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php
    if (isset($_SESSION["iduser"])) {
        
        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
    }
    ?>
				<li class="nav-item"><a class="nav-link" href="upload-form.php"
					style="color: black;">Upload</a></li>
				<li class="nav-item"><a class="nav-link" href="album.php"
					style="color: black;">Album</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="user-prof.php " 
							style="color: black;">Profile</a> 
							<a class="dropdown-item" href="login-test.php" style="color: black;">Login</a> 
							<a class="dropdown-item" href="logout-test.php" style="color: black;">Logout</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="delete-account-page-test.php" style="color: red;">Delete Account (Login required)</a>
					</div></li>
			</ul>
			<div class="d-inline-block">
				<p style="margin: 0px"> Welcome,
                    			<?php
                    if (isset($_SESSION["iduser"])) {
                        echo $_SESSION["username"];
                    }
                    ?>
			</p>
			</div>
		</div>
	</nav>

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
	
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>