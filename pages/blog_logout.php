<?php
session_start();

// Remove admin status
$_SESSION['isAdmin'] = false;

// Redirect back to blog page = removes all admin buttons, and login button appears again
header("Location: blog.php");
exit();
?>