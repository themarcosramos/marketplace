<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Excluir Tipo de Produto');

use \Source\Models\TypeProduct;


if (!isset($_GET['id']) or !is_numeric($_GET['id']))
{
    header('location: index.php?status=error');
    exit;
}

$Tipo = (new TypeProduct)->find($_GET['id']);

if (!$Tipo instanceof TypeProduct)
{
    header('location: index.php?status=error');
    exit;
}

if (isset($_POST['excluir'])) 
{

    $Tipo->delete();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

include_once __DIR__ .'/confirmDeletion.php';

include_once __DIR__ . '/../../theme/footer.php';
