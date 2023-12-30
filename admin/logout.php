<?php
session_start();

setcookie("username", "", time() - 1);
//session_unset("user");
session_destroy();
header("Refresh: 1; url=index.php");

?>