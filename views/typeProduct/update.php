<?php
require_once __DIR__ . '/../../vendor/autoload.php';

define('TITLE', 'Editar Tipo de Produto');

use \Source\Models\TypeProduct;


if (!isset($_GET['id']) or !is_numeric($_GET['id'])) 
{
    header('location: index.php?status=error');
    exit;
}

$Tipo = (new TypeProduct)->find($_GET['id']);


if(!$Tipo instanceof TypeProduct)
{
    header('location: index.php?status=error');
    exit;
}


if (isset($_POST['nome'], $_POST['percentual_imposto'], $_POST['ativo'])) 
{
    $Tipo->fill($_POST)->update();

    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/../../theme/header.php';

$cadastro = false;

include_once __DIR__ .'/form.php';

include_once __DIR__ . '/../../theme/footer.php';
