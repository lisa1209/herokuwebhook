<?php
$method = $_SERVER['REQUEST_METHOD'];


if($method == "POST"){
$requestBody = file_get_contenys('php://input');
&json = json_decode($requestBody);

$text = $json->result->parameters->text;

switch($text){
  case'hi':
  $speech ="Hi,Nice to meet you";
  break;
  case 'byr'
  $speech ="Bye, good night";
  break;

  case'anything'
  $speech ="Yes, you can tpe anythinf here.";

  default:
  $speech="Sorry, Y didn't get that.Please ask me something else,"
}

$response = new\stdClass();
$response-> speech ="";
$response->displayText="";
$response->source="webhook";
echo json_encode($response);
} else

 {
  echo "Method not allowed";


}
?>
