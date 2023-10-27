<?php
namespace Source\Models;

use \Source\Core\Connect;
use \PDO;

class SaleProduct 
{

    /** @var string */
    private $tabela = 'vendasprodutos';

    /** @var integer */
    public $id;

    /** @var integer */
    public $venda_id;

    /** @var integer */
    public $produto_id;

    /** @var integer */
    public $quantidade;

    /** @var float */
    public $valor_unitario;

    /** @var float */
    public $valor_total;

    /**  @var float */
    public $percentual_imposto;

    /** @var float */
    public $valor_total_imposto;


    /**
     * @return boolean
     */
    public function create(): bool
    {
        $db = new Connect($this->tabela);

        $this->id = $db->insert([
            'venda_id' => $this->venda_id,
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor_unitario' => $this->valor_unitario,
            'valor_total' => $this->valor_total,
            'percentual_imposto' => $this->percentual_imposto,
            'valor_total_imposto' => $this->valor_total_imposto
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
        return (new Connect($this->tabela))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * @return boolean
     */
    public function update(): bool
    {
        $db = new Connect($this->tabela);

        return $db->update('id = ' . $this->id, [
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor_unitario' => $this->valor_unitario,
            'valor_total' => $this->valor_total,
            'percentual_imposto' => $this->percentual_imposto,
            'valor_total_imposto' => $this->valor_total_imposto
        ]);
    }

    /**
     * @param  integer $id
     * @return TypeProduct
     */
    public function find($id)
    {
        return (new Connect($this->tabela))->select('id = '.$id)
            ->fetchObject(self::class);
    }

    /**
     * @param $data
     * @return $this
     */
    public function fill($data) 
    {
        if (array_key_exists('venda_id', $data)) {
            $this->venda_id = $data['venda_id'];
        }
        $this->produto_id = $data['produto_id'];
        $this->quantidade = $data['quantidade'];
        $this->valor_unitario = $data['valor_unitario'];
        $this->valor_total = $data['valor_total'];
        $this->percentual_imposto = $data['percentual_imposto'];
        $this->valor_total_imposto = $data['valor_total_imposto'];

        return $this;
    }

    /**
     * @return boolean
     */
    public function delete(): bool 
    {
        return (new Connect($this->tabela))->delete('id = ' . $this->id);
    }

}
