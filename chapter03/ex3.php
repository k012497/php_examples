<?php
    $socre =90;
    echo "시험 점수 : {$socre}점 <br>";

    if($socre >=90 && $socre<=100){
      echo "등급 : 수 <br>";
    }elseif ($socre >=80 && $socre<=89) {
      echo "등급 : 우 <br>";
    }elseif ($socre >=70 && $socre<=89) {
        echo "등급 : 미 <br>";
    }elseif ($socre >=60 && $socre<=69) {
        echo "등급 : 양 <br>";
    }elseif ($socre >=0 && $socre<=59) {
      echo "등급 : 가 <br>";
    }else{
        echo "점수를 잘못 입력하셨습니다. <br>";
    }
?>