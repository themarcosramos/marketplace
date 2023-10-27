<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Nova Venda');

use \Source\Models\Product;
use \Source\Models\Sale;


$Venda = new Sale;


if (isset($_POST['cadastro'], $_POST['valor_total_compra'], $_POST['produtos']))
{
    $Venda->fillAndSave($_POST);

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

$cadastro = true;

$produtos = (new Product)->get(null, 'nome');

include_once __DIR__ .'/form.php';

include_once __DIR__ . '/../../theme/footer.php';
