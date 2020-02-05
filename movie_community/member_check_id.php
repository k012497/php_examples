<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <style>
        h3 {
            padding-left: 5px;
            border-left: solid 5px #edbf07;
        }
        #close {
            margin: 20px 0 0 80px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h3>CHECK ID</h3>
    <p>
    <?php
    $id = $_GET["id"];

    if(!$id) {
        echo("<li>enter id you want!</li>");
    } else {
      $con = mysqli_connect("localhost", "root", "01240124", "my_page");
 
      $sql = "select * from members where id='$id'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$id." already exists.</li>";
         echo "<li>please use unother id!</li>";
      }
      else
      {
         echo "<li>you can use ".$id."</li>";
      }
    
      mysqli_close($con);
    }
?>
    </p>
    <div id="close">
        <button onclick="javascript:self.close()">X</button>
    </div>
</body>
</html>