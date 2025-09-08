<?php
require_once("../../service/produto.service.php");

header('Content-Type: application/json');

$produtos = listarProdutos("");
echo json_encode($produtos);
