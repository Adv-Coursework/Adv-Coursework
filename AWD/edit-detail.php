<!DOCTYPE html>

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

<?php
session_start();
// Get parameter value from url
$imageid = htmlspecialchars($_GET["id"]);

// Retrieve image detail - from view-photo.php
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Retrieve data from user
if ($res = $mysqli->query("SELECT title,imageurl,comment,iduser FROM photo WHERE idphoto =" . $imageid . ";")) {
    if ($res->data_seek(0)) {
        $image = array();
        while ($rows = $res->fetch_assoc()) {
            $image = $rows;
        }
    } else {
        echo "No photo found";
    }
} else {
    echo "Query error: please contact your system adminstrator.";
}
?>
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
				<li class="nav-item"><a class="nav-link"
					href="Instagraham_Inc.php" style="color:black;" >Home <span class="sr-only">(current)</span></a>
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

	<div id="edit-container">    
        <!--Display photo-->
		<img src="<?= $image["imageurl"]?>" alt="<?=$image["title"]?>"
			height="600" />

		<!--Obtain data from user for updating purpsoe-->
		<!--Create a form for user input-->
		<div id="edit-input-container">
		<form action="update-detail.php" method="post" enctype="multipart/form-data">
			<label>Title:</label><br> <input required type="text" id="title" name="title" value="<?=$image["title"]?>"><br> 
			<label>Comment:</label><br>
			<input type="text" id="comment" name="comment" value="<?= $image["comment"]?>"> 
			<input type="submit" name="submit" value="submit"> 
			<input type="hidden" id="id" name="id" value="<?=$imageid?>">
			<input type="hidden" id="iduser" name="iduser" value="<?=$image["iduser"]?>">
			
		</form>
		</div>	

	</div>
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>