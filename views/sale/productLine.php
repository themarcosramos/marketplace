<?php

    $hashProduto = isset($vendaProduto) && !is_null($vendaProduto) ? true : false;

    $opcoesSelectProdutos = '';
    foreach ($produtos as $produto)
    {
        $produtoSelected = $hashProduto && $vendaProduto->produto_id == $produto->id ? 'selected' : '';
        $opcoesSelectProdutos .= '<option value="' . $produto->id . '" ' . $produtoSelected . '>' . $produto->nome . '</option>';
    }
?>

<tr id="produtos-<?=$idProduto?>" class="linha-produto">
    <td>
        <select class="form-control produto" id="produtos_produto-<?=$idProduto?>" name="produtos[<?=$idProduto?>][produto_id]" required>
            <option value="" <?=!$hashProduto ? 'selected' : ''?>>Selecione...</option>
            <?=$opcoesSelectProdutos?>
        </select>
    </td>
    <td>
        <input type="number" class="form-control quantidade mascara-num_int" id="produtos_quantidade-<?=$idProduto?>"
               name="produtos[<?=$idProduto?>][quantidade]" value="<?=($hashProduto ? $vendaProduto->quantidade : '')?>" min="1"
               step="1" autocomplete="off" required>
    </td>
    <td>
        <input type="text" class="form-control valor_unitario mascara-valor" id="produtos_valor_unitario-<?=$idProduto?>"
               name="produtos[<?=$idProduto?>][valor_unitario]" value="<?=($hashProduto ? formatarMoney($vendaProduto->valor_unitario) : '')?>"
               autocomplete="off" required>
    </td>
    <td>
        <input type="text" class="form-control valor_total mascara-valor" id="produtos_valor_total-<?=$idProduto?>" required readonly
               name="produtos[<?=$idProduto?>][valor_total]" value="<?=($hashProduto ? formatarMoney($vendaProduto->valor_total) : '')?>">
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-xs btn-danger btnRemoverProduto">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
