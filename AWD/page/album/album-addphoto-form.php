<!DOCTYPE html>

<html>
<title>Upload photo</title>
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
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
		</ul>

	</div>
	<div id="background-container">
	<div id="wrapper-system">
    <?php
    session_start();
    $mysqli = new mysqli("localhost", "root", "", "5114asst1");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // get parameter value from url
    $imageid = htmlspecialchars($_GET["id"]);
    $check = false;
    
    if ($res = $mysqli->query("SELECT imageurl FROM photo WHERE idphoto =" . $imageid . ";")) {
        if ($res->data_seek(0)) {
            $image = array();
            while ($rows = $res->fetch_assoc()) {
                $image = $rows;
            }
            $check = true;
        } else {
            echo "No photo found";
        }
    } else {
        echo "Query error: please contact your system adminstrator.";
    }

    // Create query to insert photo into album
    if ($check){
    $q = "SELECT idalbum, title FROM album WHERE iduser = " . $_SESSION['iduser'] . ";";

    if ($res2 = $mysqli->query($q)) {
        if ($res2->data_seek(0)) {
            $album_array = array();
            while ($rows2 = $res2->fetch_assoc()) {
                $album_array[] = $rows2;
            }
                echo "<form action='album-addphoto.php' method='post' enctype='multipart/form-data' >";
                echo "<label for='album'>Choose an album:</label>";
                echo "<select name='album' id='album'>";
                foreach ($album_array as $key => $album){
                    echo "<option value='".$album['idalbum']."'> ".$album['title']."</option>";
                }
                echo "</select><br><br>";
                echo "<input type='hidden' id='idphoto' name='idphoto' value='".$imageid."'>";
                echo "<input type='submit' name='submit' value='Submit'>";
                echo "</form>";

        } else {
            echo "No album found";
        }
    } else {
        echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
    }
    }
    ?>
        <!--Hyperlink to different page-->
	<a href=" Instagraham_Inc.php"> Back to Home</a>
    </div>

    </div>
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>