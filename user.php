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


  public function __construct() {

    // establish connection
    if(!$this->db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD)) {
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
