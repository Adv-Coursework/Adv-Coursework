<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "Please login to access to the page.";
    exit();
}

?>
<html>
<head>
<title>Delete Account Page</title>
<style>
body {
	background-color: #e6fff7;
}

h1 {
	text-align: center;
}

#homebutton {
	margin: 0px 675px 0px 675px;
}

#content {
	margin-left: 25px;
}

#blankspace {
	width: 250px;
}
</style>

<link rel="stylesheet" href="css/Instagraham_style.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Karma">
<script src="https://kit.fontawesome.com/205efccb94.js"
	crossorigin="anonymous"></script>
</head>
<body>
	<!-- Top navigator -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!-- add logo with link to home page -->
		<a class="navbar-brand" style="width: 10%;" href="../page/Instagraham_Inc.php"><img
			src="../InstagrahamInc.png" alt="InstagrahamInc_Logo"
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
					href="../page/Instagraham_Inc.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php
				
    if (isset($_SESSION["iduser"])) {
        
        echo "<li class='nav-item'><a class='nav-link' href='../page/photo/upload-form.php' style='color: black;'>Upload</a></li>";
    }
    ?>
				<li class="nav-item"><a class="nav-link" href="../page/album/all-albums.php"
					style="color: black;">Album</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false" style="color: black;">
						Account </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="../page/account/user-prof.php"
							style="color: black;">Profile</a> 
							<a class="dropdown-item" href="../page/account/login-test.php" style="color: black;">Login</a> 
							<a class="dropdown-item" href="../page/account/logout-test.php" style="color: black;">Logout</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../page/account/delete-account-page-test.php" style="color: red;">Delete Account (Login required)</a>
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

	<h1>Delete Your Account (Please check the username that you want to
		delete.)</h1>
	<div id="content">
<?php

// create new MySQL interface object
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    // if there is an error, output the details
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$q = "SELECT iduser,username FROM users;";
// execute SQL query. If there is an error, print an eror message.
if ($res = $mysqli->query($q)) {
    // set the pointer to the first result. If there are no results, tell the user.
    if ($res->data_seek(0)) {
        while ($row = $res->fetch_assoc()) { // fetch the associative array for the next row
                                             // output the message stored in that row
            echo "<b>Username:</b>" . $row['username'] . "<br>\n";
            echo "(<a href=\"delete-account-test.php?id=" . $row['iduser'] . "\">Delete</a>)\n";
            echo '<hr>';
        }
    } else {
        echo "No messages found"; // no results
    }
} else {
    echo "Query error: please contact your system adminstrator.";
}
?>
</div>
	<script src="../js/jquery-3.6.0.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>