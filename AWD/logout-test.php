
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $message = 'Please login first.';
    echo "<script>alert('$message')
window.location.replace('Instagraham_Inc.php');
</script>";
    exit;
}

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
