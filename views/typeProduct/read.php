<?php
    use \Source\Models\TypeProduct;

    $dados = (new TypeProduct())->get(null, 'nome');

    $msg = '';

    if (isset($_GET['status']))
    {
        if ($_GET['status'] == 'success') {
            $msg = '<div class="alert alert-success">Procedimento realizado com sucesso!</div>';
        } elseif ($_GET['status'] == 'error') {
            $msg = '<div class="alert alert-danger">Procedimento não realizado!</div>';
        }
    }

    $resul = '';
    
    foreach($dados as $dado)
    {
        $resul.= '<tr>
                          <td>'.htmlentities($dado->nome).'</td>
                          <td>'.htmlentities($dado->descricao).'</td>
                          <td>'.(number_format($dado->percentual_imposto, 2, ',', '.')).'</td>
                          <td>'.($dado->ativo ? 'Ativo' : 'Inativo').'</td>
                          <td>'.date('d/m/Y H:i:s', strtotime($dado->cadastro)).'</td>
                          <td>
                            <a href="update.php?id='.$dado->id.'" class="btn btn-warning btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="delete.php?id='.$dado->id.'" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>';
    }

    $resul = strlen($resul) ? $resul : '<tr>
                                                         <td colspan="7" class="text-center">
                                                            Nenhum tipo de produto foi encontrado
                                                         </td>
                                                       </tr>';

?>

<main>
    <h3 class="margin-top-0"><?=TITLE?></h3>

    <?=$msg?>

    <section class="margin-bottom-15">
        <a href="create.php">
            <button class="btn btn-success">
                 Cadastrar um novo tipo de produto
            </button>
        </a>
    </section>

    <section>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Percentual Imposto (%)</th>
                    <th>Status</th>
                    <th>Cadastrado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resul?>
            </tbody>
        </table>
    </section>
</main>
