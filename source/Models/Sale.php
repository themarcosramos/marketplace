<?php
namespace Source\Models;

use \Source\Core\Connect;
use \PDO;

class Sale
{

    /** @var string */
    private $nomeTabela = 'vendas';

    /** @var integer*/
    public $id;

    /** @var string */
    public $observacoes;

    /** @var float */
    public $valor_total_compra;

    /** @var float */
    public $valor_total_imposto;

    /** @var string */
    public $cadastro;

    /* * @var Collection SaleProduct */
    public $saleProduct;


    /**
     * @return boolean
     */
    public function create(): bool 
    {
        $db = new Connect($this->nomeTabela);

        $this->id = $db->insert([
            'observacoes' => $this->observacoes,
            'valor_total_compra' => $this->valor_total_compra,
            'valor_total_imposto' => $this->valor_total_imposto,
            'cadastro' => $this->cadastro
        ]);
        return true;
    }

    /**
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function get($where = null, $order = null, $limit = null): array 
    {
        return (new Connect($this->nomeTabela))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * @param integer $id
     * @param bool $with_relationship
     * @return Product
     */
    public function find($id, $with_relationship = false)
    {
        $registro = (new Connect($this->nomeTabela))->select('id = '.$id)
            ->fetchObject(self::class);

        if ($with_relationship) {
            $registro-> saleProduct = (new  SaleProduct)->get('venda_id='.$id);
        }

        return $registro;
    }

    /**
     * @return boolean
     */
    public function update(): bool 
    {
        $db = new Connect($this->nomeTabela);

        return $db->update('id = ' . $this->id, [
            'observacoes' => $this->observacoes,
            'valor_total_compra' => $this->valor_total_compra,
            'valor_total_imposto' => $this->valor_total_imposto
        ]);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fillAndSave(array $data): Sale  
    {
    
        $cadastrando = array_key_exists('cadastrando', $data) && $data['cadastrando'];

        $data = $this->formatData($data);

        $this->fill($data);

        if ($cadastrando) {
    
            $this->create();

            foreach ($data['produtos'] as $key => $value) {
         
                $value['venda_id'] = $this->id;
                $saleProduct = new  SaleProduct;
                $saleProduct->fill($value)->create();
            }

        } else { 
            $this->update();
            $idAux = [];

            foreach ($this->saleProduct as $aux) {
                $idAux[] = $aux->id;
            }

            $idAtaul = [];

            foreach ($data['produtos'] as $key => $value) {
                $value['venda_id'] = $this->id;

                if (!in_array($key, $idAux)) { 
                    (new  SaleProduct)->fill($value)->create();
                } else {
                    (new  SaleProduct)->find($key)->fill($value)->update();
                }
                $idAtaul[] = $key;
            }
            $aux_removidos = array_diff($idAux, $idAtaul);
            if (count($aux_removidos)) {

                foreach ($aux_removidos as $removido) {
                    (new SaleProduct)->find($removido)->delete();
                }
            }
        }

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fill(array $data): Sale
     {
        $this->cadastro = $data['cadastro'];
        $this->observacoes = $data['observacoes'];
        $this->valor_total_compra = $data['valor_total_compra'];
        $this->valor_total_imposto = $data['valor_total_imposto'];

        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    public function formatData(array $data): array 
    {

        $valor_total_imposto = 0;

        foreach ($data['produtos'] as $key => $value) {
            $data['produtos'][$key]['valor_unitario'] = formatarDecimal($value['valor_unitario']);
            $data['produtos'][$key]['valor_total'] = formatarDecimal($value['valor_total']);

            $produto = (new Product())->find( $value['produto_id'] );

            $data['produtos'][$key]['percentual_imposto'] = $produto->typeProduct->percentual_imposto;

            $data['produtos'][$key]['valor_total_imposto'] = Percentage(
                $data['produtos'][$key]['valor_total'], $data['produtos'][$key]['percentual_imposto']
            );

            $valor_total_imposto += $data['produtos'][$key]['valor_total_imposto'];
        }

        $data['cadastro'] = formatarDateTime($data['cadastro']);
        $data['valor_total_compra'] = formatarDecimal($data['valor_total_compra']);
        $data["valor_total_imposto"] = $valor_total_imposto;

        return $data;
    }


    /**
     * @return boolean
     */
    public function delete(): bool 
    {
        return (new Connect($this->nomeTabela))->delete('id = ' . $this->id);
    }
}
