<?php
    echo "<table border = 1>";
    echo "<tr align = center>";
    echo "<th>2단</th>";
    echo "<th>3단</th>";
    echo "<th>4단</th>";
    echo "<th>5단</th>";
    echo "<th>6단</th>";
    echo "<th>7단</th>";
    echo "<th>8단</th>";
    echo "<th>9단</th>";

    for($i = 1 ; $i <= 9 ; $i++){
        echo "<tr>";
        for($j = 2 ; $j <= 9 ; $j++){
            $result = $i * $j;
            echo"<td>{$j} * {$i} = {$result}</td>";
        }
        echo "</tr>";
    }
?>