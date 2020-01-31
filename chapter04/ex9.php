<?php
echo "--------------------<br>";
echo "평 제곱미터<br>";
echo "--------------------<br>";

for($pyeong = 10 ; $pyeong <= 200 ; $pyeong = $pyeong + 10){
  $squareMeter = $pyeong * 0.3025;
  echo "$pyeong $squareMeter<br>";
}
echo "--------------------<br>";

?>
