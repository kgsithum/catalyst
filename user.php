<?php

include("config.php");

class User {

  public $id;
  public $name;
  public $surname;
  public $email;
  public $created_at;
  public $updated_at;
  private $db_connection;


  public function __construct($array_params=array()) {

    //check params
    if(!isset($array_params['DB_HOST'])){
      //set default host
      $array_params['DB_HOST'] = DB_HOST;
    }
    if(!isset($array_params['DB_USERNAME'])){
      //set default host
      $array_params['DB_USERNAME'] = DB_USERNAME;
    }
    if(!isset($array_params['DB_PASSWORD'])){
      //set default host
      $array_params['DB_PASSWORD'] = DB_PASSWORD;
    }
    // establish connection
    if(!$this->db_connection = mysqli_connect($array_params['DB_HOST'], $array_params['DB_USERNAME'], $array_params['DB_PASSWORD'])) {
      throw new Exception('Error connecting to MySQL: '.mysqli_error());
    }

    // select database
    if(!mysqli_select_db($this->db_connection,DB_NAME)) {
      throw new Exception('Error selecting database: '.mysqli_error());
    }
  }


  public function test(){

    $query = "SELECT * FROM test";
    $result = mysqli_query($this->db_connection,$query);

    // Fetch all
    return mysqli_fetch_all($result,MYSQLI_ASSOC);

  }



}

?>
