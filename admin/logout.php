<?php

setcookie("username", "", time() - 1);

session_unset();
session_destroy();
header("Refresh: 1; url=index.php");

?>