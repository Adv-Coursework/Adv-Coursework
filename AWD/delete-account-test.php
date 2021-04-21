<html>
<head>
<title>Delete Image</title>
<style>
body{
    background-color: #e6fff7;
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


<?php

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();


// connect to database
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

mysqli_query($mysqli,"DELETE FROM creator WHERE iduser=".$_GET['id']);

// Redirect to login page
$message = 'Account deleted succesfully.';
echo "<script>alert('$message')
window.location.replace('signup-test.php');
</script>";
exit;
?>
</body>
</html>