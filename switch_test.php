<?php

    $value = 150;
    $money = 100000;

    switch($value){
        case ($value <= 100):
            $computeVlaue = $money * 0.15;
            echo "\$value값은 100 이하, {$computeVlaue}";
            break;

        case ($value > 100 && $value <= 200):
            $computeVlaue = $money * 0.1;
            echo "\$value값은 101~200, {$computeVlaue}";
            break;

        default:
            break;
    }

?>