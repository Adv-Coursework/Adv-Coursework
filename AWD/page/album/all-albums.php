<!DOCTYPE html>
<?php
session_start();
// Connect to db
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Retrieve data
if ($res = $mysqli->query("SELECT title,comment,imageurl,idphoto FROM photo;")) {
    if ($res->data_seek(0)) {
        $image_array = array();
        while ($rows = $res->fetch_assoc()) {
            $image_array[] = $rows;
        }
    } else {
        echo "No photo found";
    }
} else {
    echo "Query error: please contact your system adminstrator.";
}
?>

<html>
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Instagraham_style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Karma">

<style>
body, h1, h2, h3, h4, h5, h6 {
	font-family: "Karma", sans-serif
}
</style>

<!--Using for loop to display all images with container for each -->

</head>
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
				<li class="nav-item "><a class="nav-link" href="Instagraham_Inc.php"
					style="color: black;">Home <span class="sr-only">(current)</span>
				</a></li>
				<?php
    if (isset($_SESSION["iduser"])) {
        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
    }
    ?>	
				<li class="nav-item active"><a class="nav-link" href="album.php"
					style="color: black;">Album</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="user-prof.php"
							style="color: black;">Profile</a> <a class="dropdown-item"
							href="login-test.php" style="color: black;">Login</a> <a
							class="dropdown-item" href="logout-test.php"
							style="color: black;">Logout</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="delete-account-page-test.php"
							style="color: red;">Delete Account (Login required)</a>
					</div></li>
			</ul>
			<div class="d-inline-block">

				<!--display current logged in account -->
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

	<div class="jumbotron">
		<!-- 	create album -->
		<button type="button" class="btn btn-primary" data-toggle="modal"
			data-target="#create-album">Create new album</button>
		<!-- Modal -->
		<form action="create-album.php" method="post"
			enctype="multipart/form-data">
			<div class="modal" id="create-album" tabindex="-1" role="dialog"
				aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel">Create Album</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label for=input-album-name>Album name</label> <input required
									type="text" class="form-control" id="input-album-name"
									placeholder="Album name" name="album_name">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
							<!-- 						<button type="button" class="btn btn-primary">Create new album</button> -->
							<input class="btn btn-primary" type="submit" name="submit"
								value="submit">
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>

	<div class="container"></div>


	 <?php
// Connect to db
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Retrieve data
if ($res = $mysqli->query("SELECT title,imageurl,idalbum,iduser FROM album WHERE iduser = " . $_SESSION['iduser'] . ";")) {
    if ($res->data_seek(0)) {
        $album_array = array();
        while ($rows = $res->fetch_assoc()) {
            $album_array[] = $rows;
        }
    } else {
        echo "No album found";
    }
} else {
    echo "Query error: please contact your system adminstrator.";
}

echo "<div class=\"container\" >\n";
echo "<div class=\"row\" >\n";
foreach ($album_array as $album) {
    echo "<div class=\"col-4\" >\n";
    echo "<div class='card'>";
    // thumbnail
    echo "<img class='card-img-top' src='".$album['imageurl']."' alt='".$album['title']."'>";
    echo "<div class='card-body'>";
    //album title
    echo "<h5 class='card-title'> ".$album['title']." </h5>";
    // view album detail
    echo "<a href='album-detail.php?id=".$album['idalbum']."' class='btn btn-primary'>Album detail</a>";
    echo "</div></div></div>";
}
echo "</div></div>\n";
?>

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