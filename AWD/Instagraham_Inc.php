<!DOCTYPE html>
<?php

// Connect to db
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Retrieve data
if ($res = $mysqli->query("SELECT title,comment,imageurl,idphoto FROM photo;")) {
    if ($res->data_seek(0)) {
        $image_array = array();
        while ($rows = $res->fetch_assoc()) {
            $image_array[] = $rows;
        }
    } else {
        echo "No photo found";
    }
} else {
    echo "Query error: please contact your system adminstrator.";
}
?>
    
<html>
<head>
<title>Home</title>
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

    <!--Using for loop to display all images with container for each -->
   
</head>
<body>
	<!-- Top navigator -->
	<div class="navigation-container">
		<ul>
			<li><a class="active" href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
			<li><a href="album.php">Albums</a></li>
		</ul>

	</div>
	
	
	<div class="content">
	 <?php
    foreach ($image_array as $image) {
        echo "<div class=\"photo-container\" >\n";
        echo "<div class=\"photo-frame\" >\n";
        echo "<img class=\"photo\" src = \"" . $image["imageurl"] . "\" alt= \"" . $image["title"] . "\" />";
        echo "</div>\n";
        echo "<h3>Title: " . $image["title"] . "</h3>";
        echo "<p>Comment: " . $image["comment"] . "</p>";
        echo "<a href = \" edit-detail.php?id=" . $image["idphoto"] . " \" > Click to edit detail </a><br>";
        echo "<a href = \" delete-photo.php?id=" . $image["idphoto"] . " \" > Delete </a><br>";
        echo "</div>\n";
    }
    ?>
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
			<h3 style = "text-align:center;">Contact</h3>
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
</body>
</html>