<?php

$print_str = "";
$seperator = ",";

for($i=1;$i<=100;$i++){

  if($i == 100){
    $seperator = "";
  }

  if(($i%3 == 0) && ($i%5 == 0)){
    $print_str .= "foobar".$seperator;
  }else if($i%3 == 0){
    $print_str .= "foo".$seperator;
  }else if($i%5 == 0){
    $print_str .= "bar".$seperator;
  }else{
    $print_str .= $i.$seperator;
  }

}
echo "$print_str\n\n";




?>
