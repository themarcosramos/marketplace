<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Editar Produto');

use \Source\Models\Product;
use \Source\Models\TypeProduct;

if (!isset($_GET['id']) or !is_numeric($_GET['id']))
{
    header('location: index.php?status=error');
    exit;
}

$Produto = (new Product)->find($_GET['id']);

if (!$Produto instanceof Product)
{
    header('location: index.php?status=error');
    exit;
}

if (isset($_POST['nome'], $_POST['tipo_id'], $_POST['ativo']))
{

    $Produto->fill($_POST)->update();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

$cadastro = false;

$tiposProduto = (new TypeProduct)->get('ativo=true', 'nome');

include_once __DIR__ .'/form.php';

include_once __DIR__ . '/../../theme/footer.php';
