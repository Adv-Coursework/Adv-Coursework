<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
$message = 'Logged out succesfully.';
echo "<script>alert('$message') 
window.location.replace('Instagraham_Inc.php');
</script>";
exit;
?>