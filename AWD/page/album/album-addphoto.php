<!DOCTYPE html>

<html>
<title>Upload photo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/Instagraham_style.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
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
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
		</ul>

	</div>
	<div id="background-container">
	<div id="wrapper-system">
    <?php
    $mysqli = new mysqli("localhost", "root", "", "5114asst1");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    if (isset($_POST["submit"])) {
        $imageID = $_POST["idphoto"];
        $albumID = $_POST["album"];
    }

    //check duplicate
     $check = false;
    
     if ($res = $mysqli->query("SELECT * FROM album_photo WHERE (idphoto =" . $imageID . " AND idalbum =" . $albumID . " );")) {
        if (!$res->data_seek(0)) {
            $check = true;
        } else {
            echo "The photo already in the album";
        }
    } else {
        echo "Query error: please contact your system adminstrator.";
    }
    
    // Create query to insert photo into album
    if ($check){
    $q = "INSERT INTO album_photo (idphoto, idalbum) VALUES (".$imageID." , ".$albumID.")";

    if ($mysqli->query($q)) {
        echo "<p>Photo  added into your album.</p>";
    } else {
        echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
    }
    }
    
    ?>
        <!--Hyperlink to different page-->
	<a href="../../album.php"> Back to Album</a>
    </div>

    </div>
	<script src="../js/jquery-3.6.0.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>

</html>