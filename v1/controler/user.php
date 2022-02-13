<?php
require_once("../model/db.php");
require_once("../model/response.php");

($_SERVER['REQUEST_METHOD']!="POST")? sendResponse(400, false, ["Methode request not allowed"]) : false;
(!$jsonData=json_decode(file_get_contents('php://input'))) ? sendResponse(400,false, ["Request body not valid json"]) : false;

$username=strtolower($jsonData->username);
try {
  $ReqExiUser=$db->prepare("SELECT * FROM user WHERE username=:username");
  $ReqExiUser->bindParam(":username", $username, PDO::PARAM_STR);
  $ReqExiUser->execute();
  $ReqExiUser->rowCount()<1? sendResponse(404,false,["User not found"]) : false;
  $user=$ReqExiUser->fetch(PDO::FETCH_ASSOC);
  sendResponse(200,true,null,$user);
} catch (PDOException $err) {
  sendResponse(500,false,"DATABASE ERROR");
}

?>
