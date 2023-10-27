<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Excluir Venda');

use \Source\Models\Sale;


if (!isset($_GET['id']) or !is_numeric($_GET['id']))
{
    header('location: index.php?status=error');
    exit;
}

$Venda = (new Sale)->find($_GET['id']);

if (!$Venda instanceof Sale)
{
    header('location: index.php?status=error');
    exit;
}


if (isset($_POST['excluir']))
{
    $Venda->delete();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

include_once __DIR__ .'/confirmDeletion.php';

include_once __DIR__ . '/../../theme/footer.php';
