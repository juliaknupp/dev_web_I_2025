<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
         <label>Numero 1</label><input type="text" name="a">
    <label>Numero 2</label><input type="text" name="b">
    <select name="op">
    <option value=""></option>
     <option value="1">+</option>
      <option value="2">-</option>
       <option value="3">*</option>
        <option value="4">/</option>
    </select>
    <button>Calcular</button>
    </form>
    <?php
     $a=$_GET['a'];
    $b=$_GET['b'];
    $op=$_GET['op'];
    if(isset($_GET[$a]) && isset($_GET[$b]) && isset($_GET[$op])){
    function soma($a,$b){
        return $a+$b;
    }

     function subtracao($a,$b){
        return $a-$b;
     }

      function multiplicacao($a,$b){
        return $a*$b;
     }

      function divisao($a,$b){
        return $a/$b;
     }
    }
    
        if(!is_numeric($a) || !is_numeric($b)){
            echo "numero invalido";}

else{
      switch($op){
        case 1:
            echo soma($a,$b);
            break;
        case 2:
            echo subtracao($a,$b);
            break;
        case 3:
            echo multiplicacao($a,$b);
            break;
            case 4:
                echo divisao($a,$b);
                break;
            }
        }        
        
    ?>
</body>
</html>
