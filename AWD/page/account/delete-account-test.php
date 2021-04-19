<html>
<head>
<title>Delete Image</title>
<style>
body{
    background-color: #e6fff7;
}
#adminbutton{
margin: 50px 650px 50px 650px;
}
</style>
</head>
<body>
<h1>Delete Image</h1>
<?php

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();


// connect to database
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

mysqli_query($mysqli,"DELETE FROM users WHERE iduser=".$_GET['id']);

// Redirect to login page
$message = 'Account deleted succesfully.';
echo "<script>alert('$message')
window.location.replace('signup-test.php');
</script>";
exit;
?>

</body>
</html>