 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <?php
    $Nome=$_POST["Nome"];
    $Categoria=$_POST["Categoria"];
    $Fabricante=$_POST["Fabricante"];

    if(!isset($_SESSION) && !isset ($_SESSION["Produtos"])){
    }
        array_push($_SESSION["Produtos"],["Nome"=>$Nome, "Categoria"=>$Categoria, "Fabricante"=>$Fabricante])
    
     ?>
 </body>
 </html>