<?php
// logout.php: Destroys session and redirects to registration.html
session_start();
session_unset();
session_destroy();
header('Location: registration.html');
exit();
?>
