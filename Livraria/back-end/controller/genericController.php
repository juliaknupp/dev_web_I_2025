<?php
interface GenericController {
    function cadastrar($dadosRecebidos);
    function listar($dadosRecebidos);
    function alterar($dadosRecebidos);
    function remover($dadosRecebidos);
}
?>
