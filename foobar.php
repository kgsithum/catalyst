<?php

$print_str = "";

for($i=1;$i<=100;$i++){

  if(($i%3 == 0) && ($i%5 == 0)){
    $print_str .= "foobar";
  }else if($i%3 == 0){
    $print_str .= "foo";
  }else if($i%5 == 0){
    $print_str .= "bar";
  }else{
    $print_str .= $i;
  }

}
echo "$print_str\n\n";




?>
