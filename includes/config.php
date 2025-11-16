<?php
// Php session files will go here
// __DIR__ makes sure it works regardless of where includes/ is located, which I need as index.php and the others are not on the same level
ini_set('session.save_path', __DIR__ . '/../sessions/');
?>