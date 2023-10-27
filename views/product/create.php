<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Cadastrar um novo produto');


use \Source\Models\Product;
use \Source\Models\TypeProduct;


$Produto = new Product;

if (isset($_POST['nome'], $_POST['tipo_id'], $_POST['ativo']))
{

    $Produto->fill($_POST)->create();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

$cadastro = true;

$tiposProduto = (new TypeProduct)->get('ativo=true', 'nome');

include_once __DIR__ .'/form.php';

include_once __DIR__ . '/../../theme/footer.php';
