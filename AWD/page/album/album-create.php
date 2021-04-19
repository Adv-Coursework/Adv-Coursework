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
				<li class="nav-item "><a class="nav-link" href="Instagraham_Inc.php">Home
						<span class="sr-only">(current)</span>
				</a></li>
				<?php
    if (isset($_SESSION["iduser"])) {
        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
    }
    ?>
				<li class="nav-item	active"><a class="nav-link"
					href="upload-form.php" style="color: black;">Upload</a></li>
				<li class="nav-item"><a class="nav-link" href="album.php"
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


	<div id="background-container">
		<div id="wrapper-system">
    <?php
    session_start();

    $uploadOk = FALSE;

    // retreive user input
    if (isset($_POST["submit"])) {
        $album_name = $_POST["album_name"];
        $uploadOk = 1;
    }

    // update to datebase
    if ($uploadOk == 1) {
        $mysqli = new mysqli("localhost", "root", "", "5114asst1");
        // if failed to connect to db
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        // Create query to update detail according to image id
        $q = "INSERT INTO album (title,iduser) VALUES ('" . $album_name . "', " . $_SESSION['iduser'] . ") ";

        // If query executed or failed to do so
        if ($mysqli->query($q)) {
            echo "<p>Album: " . $album_name . "  created.</p>";
        } else {
            echo "<p>Something went wrong11111. Please contact your system adminstrator.</p>";
		    var_dump($mysqli->error);
        }
    } else {
        echo "<p>Something went wrong222. Please contact your system adminstrator.</p>";
    }

    ?>
    <!--Hyperlink to different page-->
			<a href=" album.php"> Back to Album</a>
		</div>
	</div>
</body>
</html>