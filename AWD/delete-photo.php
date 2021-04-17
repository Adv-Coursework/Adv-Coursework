<!DOCTYPE html>

<html>
<title>Upload photo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Instagraham_style.css">
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

    // get parameter value from url
    $imageid = htmlspecialchars($_GET["id"]);

    if ($res = $mysqli->query("SELECT imageurl FROM photo WHERE idphoto =" . $imageid . ";")) {
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

    // Delete file from folder according to id acquired
    unlink($image["imageurl"]);
    // Create query to delete according to image id
    $q = "DELETE FROM photo WHERE idphoto =" . $imageid . ";";

    if ($mysqli->query($q)) {
        echo "<p>Delete complete.</p>";
    } else {
        echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
    }
    ?>
        <!--Hyperlink to different page-->
	<a href=" Instagraham_Inc.php"> Back to Home</a>
    </div>

    </div>

</body>

</html>