<?php
    use \Source\Models\Sale;

    $dados = (new Sale())->get(null,'cadastro');

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
    $valor_total = $valor_imposto = 0;
    
    foreach ($dados as $dado)
    {
        $valor_total += $dado->valor_total_compra;
        $valor_imposto += $dado->valor_total_imposto;

        $resul .= '<tr>
                          <td>'.(formatarMoney($dado->valor_total_compra)).'</td>
                          <td>'.(formatarMoney($dado->valor_total_imposto)).'</td>
                          <td>'.htmlentities($dado->observacoes).'</td>
                          <td>'.(formatarMoment($dado->cadastro)).'</td>
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

    $totais = !strlen($resul) ? '' : '<tr class="info">
                                               <th>TOTAL</th>
                                               <th>'.(formatarMoney($valor_total)).'</th>
                                               <th>'.(formatarMoney($valor_imposto)).'</th>
                                               <th colspan="3"></th>
                                           </tr>';

    $resul = strlen($resul) ? $resul : '<tr>
                                                           <td colspan="5" class="text-center">
                                                              Nenhum venda foi encontrada
                                                           </td>
                                                       </tr>';
?>

<main>
    <h3 class="margin-top-0"><?=TITLE?></h3>

    <?=$msg?>

    <section class="margin-bottom-15">
        <a href="create.php">
            <button class="btn btn-success">
               Realizar uma nova venda 
            </button>
        </a>
    </section>

    <section>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Valor Total</th>
                    <th>Valor Imposto</th>
                    <th>Observações</th>
                    <th>Cadastrado </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resul?>
            </tbody>
            <tfoot>
                <?=$totais?>
            </tfoot>
        </table>
    </section>
</main>
