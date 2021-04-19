<!DOCTYPE html>
<?php
// Initialize the session
session_start();

// Get parameter value from url
$albumid = htmlspecialchars($_GET["id"]);

// Connect to db
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


// Retrieve album data
$check = false;

if ($res = $mysqli->query("SELECT idalbum, iduser, title FROM album WHERE idalbum = " . $albumid . ";")) {
    if ($res->data_seek(0)) {
        while ($rows = $res->fetch_assoc()) {
            $album = $rows;
        }
        $check = true;
    } else {
        echo "No album found";
    }
} else {
    echo "Album Query error: please contact your system adminstrator.";
}


?>

<html>
<head>
<title>Album</title>
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

</head>
<body>
		<!-- Top navigator -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!-- add logo with link to home page -->
		<a class="navbar-brand" style="width: 10%;" href="Instagraham_Inc.php" ><img
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
				<li class="nav-item"><a class="nav-link active" href="all-albums.php"
					style="color: black;">Album</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="user-prof.php"
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


	<div class="jumbotron">
		<div class="container d-flex justify-content-between">
			<h2>  <?php echo $album['title'];?>	</h2>
			<a class="btn btn-primary" href="!#">Edit album detail</a>
		</div>
	</div>
	
    <!--view all photos in albums --> 
	 <div class="container">
	 <div class="row">
	 
	 <?php
	 // Retrieve photo data
	 if ($check) {
	     if ($res = $mysqli->query("SELECT P.idphoto, P.imageurl, P.iduser, P.title, P.comment FROM photo P INNER JOIN album_photo AP ON P.idphoto=AP.idphoto WHERE AP.idalbum = " . $albumid . ";")) {
	         if ($res->data_seek(0)) {
	             $image_array = array();
	             while ($rows = $res->fetch_assoc()) {
	                 $image_array[] = $rows;
	             }
	             //fetch all photos
	             foreach ($image_array as $image) {
	                 echo "<div class=\"col-4\" >\n";
	                 echo "<div class=\"photo-frame\" >\n";
	                 echo "<img class=\"photo\" src = \"" . $image["imageurl"] . "\" alt= \"" . $image["title"] . "\" />";
	                 echo "</div>\n";
	                 echo "<h3>Title: " . $image["title"] . "</h3>";
	                 echo "<p>Comment: " . $image["comment"] . "</p>";
	                 if ($image["iduser"] == $_SESSION["iduser"]) {
	                     echo "<a href = \" edit-detail.php?id=" . $image["idphoto"] . " \" > Click to edit detail </a><br>";
	                     echo "<a href = \" delete-photo.php?id=" . $image["idphoto"] . " \" > Delete </a><br>";
	                 }
	                 echo "</div>\n";
	             }
	         } else {
	             echo "No photo found in this album!";
	         }
	     } else {
	         echo "Photo Query error: please contact your system adminstrator.";
	     }
	 }
	 
        
      ?>
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