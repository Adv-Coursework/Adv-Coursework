<!DOCTYPE html>

<html>
<title>Upload photo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="Instagraham_style.css">
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
    $uploadOk = FALSE;

    // retreive user input
    if (isset($_POST["submit"]) && $_POST["title"] != "") {
        $editTitle = $_POST["title"];
        $imageId = $_POST["id"];
        $editComment = $_POST["comment"];
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
        $q = "UPDATE photo SET title = '" . $editTitle . "' , comment = '" . $editComment . "'WHERE idphoto = " . $imageId . ";";

        // If query executed or failed to do so
        if ($mysqli->query($q)) {
            echo "<p>Update complete.</p>";
        } else {
            echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
        }
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