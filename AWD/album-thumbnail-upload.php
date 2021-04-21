<!DOCTYPE html>

<html>
<title>Thumbnail upload</title>
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
				session_start();
                    if (isset($_SESSION["iduser"])) {
                        
                        echo "<li class='nav-item'><a class='nav-link' href='upload-form.php' style='color: black;'>Upload</a></li>";
                    }
                    ?>
				<li class="nav-item active"><a class="nav-link" href="all-albums.php"
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


	<div id="background-container">
	<div id="wrapper-system">
    <?php

    $target_dir = "uploads/"; // set target directory
    $target_filename = basename($_FILES["fileToUpload"]["name"]); // set target filename
    $target_file = $target_dir . $target_filename; // concatenate
    $uploadOk = TRUE; // variable to determine if upload was successful
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // get file type/extension
    $image_name = pathinfo($target_file, PATHINFO_FILENAME);

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 160000000) {
        echo "Sorry, your file is too large.(Must be smaller than 2MB) <br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed as thumbnail.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to FALSE by an error
    if ($uploadOk == 0) {
        echo "Failure: your thumbnail was not uploaded.<br>";
    } else {
        // if everything is ok, move the file from the temporary location to its permanent location
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . time() . "." . $imageFileType)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your thumbnail.<br>";
        }
    }

    // Insert into database
    if ($uploadOk == 1) {
        $mysqli = new mysqli("localhost", "root", "", "5114asst1");

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $q = "UPDATE album SET imageurl='" . $target_dir . time() . "." . $imageFileType . "',
             title = '".$_POST['title']."'
             WHERE idalbum = ".$_POST['albumid']."";

        if ($mysqli->query($q)) {
            echo "<p>Thumbnail added to database.</p>";
        } else {
            echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
        }
    }
    ?>
    <!--Hyperlink to different page-->
	<a href="all-albums.php"> Back to Album</a>
	</div>
	</div>
		<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>