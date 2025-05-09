<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method"_GET">
        <label>Numero 1</label><input type="text" name="a">
        <label>Numero 2</label><input type="text" name="b">
        <select name="op">
            <option value="">OP</option>
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

    switch($op){
       case 1:
           echo $a+$b;
           break;
       case 2:
           echo $a-$b;
           break;
       case 3:
           echo $a*$b;
           break;
           case 4:
               echo $a/$b;
               break;
        case "":
            echo "invalido";
            break;       
    }
?>
</body>
</html>