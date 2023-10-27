<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Excluir Produto');

use \Source\Models\Product;


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

if (isset($_POST['excluir']))
{
    $Produto->delete();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

include_once __DIR__ .'/confirmDeletion.php';

include_once __DIR__ . '/../../theme/footer.php';
