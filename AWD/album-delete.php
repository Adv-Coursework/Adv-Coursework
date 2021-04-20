<!DOCTYPE html>
<?php 
// Connect to db
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>

<html>
<head>
<title>Albums</title>
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
					style="color: black;">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php
    session_start();
    if (isset($_SESSION["iduser"])) {

        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
    }
    ?>
				<li class="nav-item active"><a class="nav-link"
					href="all-albums.php" style="color: black;">Album</a></li>

				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php
    if (isset($_SESSION["iduser"])) {
        echo "<a class='dropdown-item' href='user-prof.php' style='color: black;''>Profile</a> ";
    }
    ?>
							<a class="dropdown-item" href="login-test.php"
							style="color: black;">Login</a> <a class="dropdown-item"
							href="logout-test.php" style="color: black;">Logout</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="delete-account-page-test.php"
							style="color: red;">Delete Account (Login required)</a>
					</div></li>
			</ul>
			<div class="d-inline-block">
				<p style="margin: 0px"> Welcome,
			<?php
if (isset($_SESSION["iduser"])) {
    echo $_SESSION["username"];
} else {
    echo "guest user!";
}
?>
			</p>
			</div>
		</div>
	</nav>

    <div id="background-container">
    <div id="wrapper-system">
    <?php
    // retreive user input
    if (isset($_POST["submit"])) {
        $albumid = $_POST["idalbum"];
    }
    
    // get parameter value from url
    $albumid = htmlspecialchars($_GET["id"]);
    
    // Query remove relation btwn album and album_photo
    $q1 = "DELETE FROM album_photo WHERE idalbum =" . $albumid . ";";
    $q2 = "DELETE FROM album WHERE idalbum =". $albumid.";";
    if ($mysqli->query($q1)) {
        if ($mysqli->query($q2)){
        echo "<p>Album deleted.</p>";
        }
        else{
            echo "Something went wrong. Please try again later.";
        }
    } else {
        echo "Something went wrong. Please try again later.";
    }
    ?>
    <!--Hyperlink to different page-->
    <a href="all-albums.php" class="btn btn-primary btn-lg">Back to Albums</a>
    </div>
    </div>
    <script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>