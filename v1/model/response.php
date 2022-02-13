<?php

class Response{
  private $status_code;
  private $messages;
  private $success;
  private $data;

  function __construct($status_code,$success,$messages,$data){
    $this->status_code = $status_code;
    $this->success = $success;
    $this->messages = $messages;
    $this->data = $data;
  }

  function send(){
    header('Content-Type: application/json; charset=utf-8');
    $return_data["status_code"]=$this->status_code;
    $return_data["success"]=$this->success;
    $return_data["messages"]=$this->messages;
    $return_data["data"]=$this->data;
    echo json_encode($return_data);
  }

}

function sendResponse($status_code,$success,$messages,$data=null){
  $response=new Response($status_code,$success,$messages,$data);
  $response->send();
  exit;
}

 ?>
