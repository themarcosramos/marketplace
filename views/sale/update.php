<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Editar Venda');

use \Source\Models\Product;
use \Source\Models\Sale;


if (!isset($_GET['id']) or !is_numeric($_GET['id']))
{
    header('location: index.php?status=error');
    exit;
}

$Venda = (new Sale)->find($_GET['id'], true);

if (!$Venda instanceof Sale)
{
    header('location: index.php?status=error');
    exit;
}

if (isset($_POST['cadastro'], $_POST['valor_total_compra'], $_POST['produtos']))
{
    $Venda->fillAndSave($_POST);

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../..//theme/header.php';

$cadastro = false;

$produtos = (new Product)->get(null, 'nome');

include_once __DIR__ .'/form.php';

include_once __DIR__ . '/../../theme/footer.php';
