<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     $a=$_POST['a'];
     $b=$_POST['b'];
     $op=$_POST['op'];

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
     }
?>
</body>
</html>