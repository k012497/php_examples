<?php
    $numArray = array(15, 13, 9, 7, 6, 12, 19, 30, 28, 26);
    $count = count($numArray);

    function bubble_sort(){
        global $numArray;
        global $count;

        for($i = $count - 2 ; $i >= 0 ; $i--){
            for($j = 0 ; $j <= $i ; $j++){
                if($numArray[$j] > $numArray[$j + 1]){
                    $tmp = $numArray[$j];
                    $numArray[$j] = $numArray[$j+1];
                    $numArray[$j+1] = $tmp;
                }
            }
        }
    }
    
    function echo_all($array){
        for($i = 0 ; $i < count($array) ; $i++){
            echo "{$array[$i]} ";
        }
        echo "<br>";
    }
    
    echo "정렬 전 ";
    echo_all($numArray);

    bubble_sort();

    echo "정렬 후 ";
    echo_all($numArray);
?>