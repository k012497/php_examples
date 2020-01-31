<?php
$count = 0;

for($num = 5 ; $num <= 500 ; $num++){
  if($num % 5 == 0){
    echo "$num ";
  }
  $count++;
  if($count % 50 == 0){
      echo "<br>";
  }
}


 ?>
