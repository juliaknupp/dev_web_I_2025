<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
   $linha = $_POST["linha"];
   $coluna = $_POST["coluna"];
   echo "<table>";
    for($i=1; $i <= $linha; $i++){
    echo "<tr>";
     for($j=1;$j<=$coluna;$j++){
        if($i==1){
            echo"<th>C" . $j . "</th>";
        }
        else echo"<td> C" . $j . "L" . $i . "</td>";
     }
     echo "</tr>";
    }
    echo "</table>";
    $_session["linha"]=$linha;
    $_session["coluna"]=$coluna;
    var_dump($_session);
   ?>   
</body>
</html>