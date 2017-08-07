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

    try{
      // establish connection
      if($this->db_connection = @mysqli_connect($array_params['DB_HOST'], $array_params['DB_USERNAME'], $array_params['DB_PASSWORD'])) {
        // select database
        if(!@mysqli_select_db($this->db_connection,DB_NAME)) {
          throw new Exception('Error selecting database.\n');
        }
      }else{
        throw new Exception('Error connecting to MySQL\n');
      }

    }catch(Exception $e){
      echo $e->getMessage();
    }


  }


  public function test(){

    $query = "SELECT * FROM test";
    $result = mysqli_query($this->db_connection,$query);

    // Fetch all
    return mysqli_fetch_all($result,MYSQLI_ASSOC);

  }


  //check user table exist
  public function is_users_table_exist(){
    //check table exist
    $query_chk = "SELECT id FROM users";
    $result_chk = mysqli_query($this->db_connection,$query_chk);

    if(empty($result_chk)){
      return false;
    }else{
      return true;
    }

  }

  //create table
  public function create_table(){

    if(!$this->is_users_table_exist()){
      //create new table
      $query_create = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(35) NOT NULL,
                surname VARCHAR(35) DEFAULT NULL,
                email VARCHAR(255) NOT NULL UNIQUE KEY,
                created_at DATETIME NOT NULL,
                updated_at DATETIME DEFAULT NULL,
                status INT(1) NOT NULL
                )";
      $result = mysqli_query($this->db_connection,$query_create);

      if($result){
        echo "users table created.\n";
      }

    }

  }

  //check email exist
  public function is_email_exist(){
    $query_chk = "SELECT id FROM users WHERE email = '".$this->email."'";
    $result_chk = mysqli_query($this->db_connection,$query_chk);

    if(@mysqli_num_rows($result_chk) == 0){
      return false;
    }else{
      return true;
    }
  }

  //insert Record
  public function save(){
    //$query = "INSERT INTO users ('name','surname','email','created_at','status') VALUES ('".$this->name."','".$this->surname."','".$this->email."','".$this->created_at."',".$this->status.")";
    $query = "INSERT INTO users (name, surname, email, created_at, status) VALUES (
              '".mysqli_real_escape_string($this->db_connection,$this->name)."',
              '".mysqli_real_escape_string($this->db_connection,$this->surname)."',
              '".mysqli_real_escape_string($this->db_connection,$this->email)."',
              '".$this->created_at."',
              ".$this->status.")";
    $result = mysqli_query($this->db_connection,$query);
    echo $query."\n";
    return $result;
  }



}

?>
