<?php
require_once("../model/db.php");
require_once("../model/response.php");

($_SERVER['REQUEST_METHOD']!="POST")? sendResponse(400, false, ["Methode request not allowed"]) : false;
(!$jsonData=json_decode(file_get_contents('php://input'))) ? sendResponse(400,false, ["Request body not valid json"]) : false;
$user_id=$jsonData->user_id;
isset($jsonData->movie_id) ? $movie_id=$jsonData->movie_id : false ;
if (array_key_exists("option",$_GET)){
  $option=$_GET["option"];
  switch ($option) {
    case 'add':
        try {
          $InsNewMovie=$db->prepare("INSERT INTO collection VALUES (:userid,:movieid)");
          $InsNewMovie->bindParam(":userid",$user_id,PDO::PARAM_INT);
          $InsNewMovie->bindParam(":movieid",$movie_id,PDO::PARAM_INT);
          $InsNewMovie->execute();
          $InsNewMovie->rowCount()<1 ? sendResponse(500,false,["Insertion into database error"]) : sendResponse(201,true,["Insertion success"]);
        } catch (PDOException $err) {sendResponse(500,false,"DATABASE ERROR");}
      break;
    case 'remove':
      try {
        $DelMovie=$db->prepare("DELETE FROM collection WHERE userid=:userid AND movieid=:movieid");
        $DelMovie->bindParam(":userid",$user_id,PDO::PARAM_INT);
        $DelMovie->bindParam(":movieid",$movie_id,PDO::PARAM_INT);
        $DelMovie->execute();
        $DelMovie->rowCount()<1 ? sendResponse(500,false,["Delete database error"]) : sendResponse(201,true,["Delete success"]);
      } catch (PDOException $err) {sendResponse(500,false,"DATABASE ERROR");}
      break;
    case 'list':
        try {
          $ReqListMovies=$db->prepare("SELECT movieid FROM collection WHERE userid=:userid");
          $ReqListMovies->bindParam(":userid",$user_id,PDO::PARAM_INT);
          $ReqListMovies->execute();
          $ListMovies=$ReqListMovies->fetchAll(PDO::FETCH_ASSOC);
          sendResponse(200,true,null,$ListMovies);
        }catch (PDOException $err) {sendResponse(500,false,"DATABASE ERROR");}
        break;
    default:
      sendResponse(400, false, ["Option request not allowed"]);
      break;
  }
}else{
  sendResponse(404,false,["Option not allowed"]);
}

?>
