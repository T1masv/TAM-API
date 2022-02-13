<?php
try {
  require_once("../model/identifiants.php");
  $db=new PDO($dns,$user,$password);
} catch (PDOException $err) {
  error_log("Database connection error : ".$err);
}
?>
