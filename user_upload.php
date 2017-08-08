<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("user.php");


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
        $user_obj->create_table();

      break;

      case '--file':

        //check file name passed
        $file_index = array_search("--file",$argv);
        if(isset($argv[$file_index + 1])){
          $file_name = $argv[$file_index + 1];
          //check users table exist
          if(!$user_obj->is_users_table_exist() && !array_search("--create_table",$argv)){
            echo "users table doesn't exist. Use --create_table derective.\n";
          }else{
            //create users table
            $user_obj->create_table();

            //check file
            if(file_exists($file_name)){
              //check file type
              $file_type = mime_content_type ($file_name);
              if($file_type == "text/plain" || $file_type == "text/csv"){
                //read csv file
                $file = fopen($file_name,"r");
                $flag = false;
                $row_number = 0;
                $validation_str_output = "";
                while(!feof($file)){

                  $validation = true;
                  $user_arr = fgetcsv($file);
                  $validation_str = "";

                  if($flag){

                    //validation - check name not null
                    if($user_arr[0] == ""){
                      $validation = false;
                      $validation_str .= " - Name must not null.\n";
                    }
                    //validation - check email
                    if($user_arr[2] == ""){
                      $validation = false;
                      $validation_str .= " - Email must not null.\n";
                    }else if(!filter_var($user_arr[2], FILTER_VALIDATE_EMAIL)){
                      $validation = false;
                      $validation_str .= " - Invalid email address.\n";
                    }else{
                      //check email exist
                      $user_obj->email = strtolower($user_arr[2]);
                      if($user_obj->is_email_exist()){
                        $validation = false;
                        $validation_str .= " - Email already exist.\n";
                      }
                    }

                    //check --dry_run
                    if(!in_array("--dry", $argv)){
                      //insert record
                      if($validation){

                        $user_obj->name = ucwords($user_arr[0]);
                        $user_obj->surname = ucwords($user_arr[1]);
                        $user_obj->email = strtolower($user_arr[2]);
                        $user_obj->created_at = date("Y-m-d H:i:s");
                        $user_obj->status = 1;

                        $insert = $user_obj->save();
                        if($insert){
                          $validation_str_output .= "#Row number:[".$row_number."]-SUCCESS\n - Record inserted.\n";
                        }else{
                          $validation_str_output .= "#Row number:[".$row_number."]-ERROR\n - Error in insert.\n";
                        }

                      }else{
                        //output validation errors
                        $validation_str_output .= "#Row number:[".$row_number."]-ERROR\n".$validation_str."\n";
                      }
                    }

                  }
                  $flag = true;
                  $row_number++;
                }

                //print output
                echo $validation_str_output;

                fclose($file);

              }else{
                echo "Unsupported file type. Only CSV files accepted. \n";
              }

            }else{
              echo "File not found.\n";
            }
          }

        }else{
          echo "Provide file name after --file derective.\n";
        }

      break;

      //process --help derective
      case '--help':
        echo "help called.\n";
      break;

      default:

      break;


    }
  }

}else{
  echo "no args\n";
}






?>
