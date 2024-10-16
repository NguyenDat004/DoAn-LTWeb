<?php
session_start();
session_destroy();
header('location: /htdocts/index.php');
?>