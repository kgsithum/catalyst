<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("user.php");

//print_r($argc);

//check arguments
if($argc > 1){

  //create user object. create mysql connection with params
  $params = array();
  //get -u if exist
  if($user_index = array_search("-u",$argv)){
    if(isset($argv[$user_index + 1])){
      $db_user = $argv[$user_index + 1];
      $params['DB_USERNAME'] = $db_user;
    }

  }
  //get -p if exist
  if($pass_index = array_search("-p",$argv)){
    if(isset($argv[$pass_index + 1])){
      $db_pass = $argv[$pass_index + 1];
      $params['DB_PASSWORD'] = $db_pass;
    }

  }
  //get -h if exist
  if($host_index = array_search("-h",$argv)){
    if(isset($argv[$host_index + 1])){
      $db_host = $argv[$host_index + 1];
      $params['DB_HOST'] = $db_host;
    }

  }

  //create user object
  $user_obj = new User($params);


  //handle all the derectives
  foreach($argv as $arg){

    switch($arg){

      case '--create_table':
        //create user table 
        echo "create_table called.\n";
        $user_obj->create_table();

      break;

      case '--file':
        echo "file called.\n";
      break;

      case '--help':
        echo "help called.\n";
      break;

      default:
        echo "default called.\n";
      break;


    }
  }

}else{
  echo "no args\n";
}






?>
