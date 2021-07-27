<?php

session_start ();
session_destroy ();
setcookie('token',$tok, time()-3600*24, "/");
header ("Location: ../index.php");


?>