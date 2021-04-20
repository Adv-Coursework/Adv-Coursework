<?php 
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "Please login to access to the page.";
    exit;
}

?>
<html>
<head>
<title>Delete Account Page</title>
<style>
    body{
    background-color: #e6fff7;
    }
    h1{
    text-align:center;
    }
    #homebutton{
    margin: 0px 675px 0px 675px;
    }
    #content{
    margin-left:25px;
    }
    #blankspace {
    width:250px;
    }

</style>

<link rel="stylesheet" href="Instagraham_style.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Karma">
<script src="https://kit.fontawesome.com/205efccb94.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="navigation-container">
		<ul>
			<li><a class="active" href="Instagraham_Inc.php">Home</a></li>
			<li><a href="upload-form.html">Upload photo</a></li>
			<li><a href="admin.php">Admin</a></li>
		</ul>

	</div>

<h1>Delete Your Account (Please check the username that you want to delete.)</h1>
<div id="content">
<?php 

// create new MySQL interface object
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    // if there is an error, output the details
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$q = "SELECT iduser,username FROM creator;";
// execute SQL query. If there is an error, print an eror message.
if ($res = $mysqli->query($q)) {
    // set the pointer to the first result. If there are no results, tell the user.
    if ($res->data_seek(0)) {
        while ($row = $res->fetch_assoc()) {    // fetch the associative array for the next row
            // output the message stored in that row
            echo "<b>Username:</b>" . $row['username'] . "<br>\n";
            echo "(<a href=\"delete-account-test.php?id=" . $row['iduser'] . "\">Delete</a>)\n";
            echo '<hr>';
        }
    }
    else {
        echo "No messages found";   // no results
    }
}
else {
    echo "Query error: please contact your system adminstrator.";
}
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
