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
    if ($_FILES["fileToUpload"]["size"] > 80000000) {
        echo "Sorry, your file is too large.(Must be smaller than 10MB) <br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to FALSE by an error
    if ($uploadOk == 0) {
        echo "Failure: your file was not uploaded.<br>";
    } else {
        // if everything is ok, move the file from the temporary location to its permanent location
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . time() . "." . $imageFileType)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }

    // Insert into database
    if ($uploadOk == 1) {
        $mysqli = new mysqli("localhost", "root", "", "5114asst1");

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $q = "INSERT INTO photo (imageurl,title,comment) VALUES ('" . $target_dir . time() . "." . $imageFileType . "','" . $image_name . "','" . addslashes($_POST['comment']) . "')";

        if ($mysqli->query($q)) {
            echo "<p>File added to database.</p>";
        } else {
            echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
        }
    }
    ?>
    <!--Hyperlink to different page-->
	<a href=" Instagraham_Inc.php"> Back to Home</a>
	</div>
	</div>
</body>
</html>