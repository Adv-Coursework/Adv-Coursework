<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();


include 'connection.php';

mysqli_query($db,"DELETE FROM users WHERE iduser=".$_GET['id']);

// Redirect to login page
$message = 'Account deleted succesfully.';
echo "<script>alert('$message')
window.location.replace('signup-test.php');
</script>";
exit;
?>