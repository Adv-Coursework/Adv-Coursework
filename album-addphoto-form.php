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
				<li class="nav-item active"><a class="nav-link"
					href="Instagraham_Inc.php">Home <span class="sr-only">(current)</span></a>
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
							style="color: black;">Profile</a> <a class="dropdown-item"
							href="login-test.php" style="color: black;">Login</a> <a
							class="dropdown-item" href="logout-test.php"
							style="color: black;">Logout</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" data-toggle="modal" data-target="#myModal"
							style="color: red;">Delete Account (Login required)</a>
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

	<!-- Modal for delete account-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <?php 
        /*When in user is logged in in session, delete user account according to iduser*/
        include "connection.php";
        $id=$_SESSION['iduser'];
        $q = "SELECT iduser,username FROM creator WHERE iduser = $id";
        $rs = mysqli_query($db,$q);
        $getRowAssoc = mysqli_fetch_assoc($rs);
       
        echo "<p><h5>Deleting user". "&nbsp;<b>".$getRowAssoc["username"]. "</b>&nbsp;"."from database! Are you sure?"."</h5></p>";
        echo "<br>";
        echo "<h5><center><a href = \"delete-account-test.php?id=" . $getRowAssoc["iduser"] . " \" > Delete </a></center></h5>";
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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
    if ($check) {
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
                foreach ($album_array as $key => $album) {
                    echo "<option value='" . $album['idalbum'] . "'> " . $album['title'] . "</option>";
                }
                echo "</select><br><br>";
                echo "<input type='hidden' id='idphoto' name='idphoto' value='" . $imageid . "'>";
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
			<a href="Instagraham_Inc.php"> Back to Home</a>
		</div>

	</div>
	<script src="js/jquery-3.6.0.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>