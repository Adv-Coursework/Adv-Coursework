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
// Get parameter value from url
$imageid = htmlspecialchars($_GET["id"]);

// Retrieve image detail - from view-photo.php
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Retrieve data from user
if ($res = $mysqli->query("SELECT title,imageurl,comment FROM photo WHERE idphoto =" . $imageid . ";")) {
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
	<div class="navigation-container">
		<ul>
			<li><a href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
		</ul>

	</div>

	<div id="edit-container">    
        <!--Display photo-->
		<img src=" <?= $image["imageurl"]?>" alt="<?=$image["title"]?>"
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
		</form>
		</div>	

	</div>
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>