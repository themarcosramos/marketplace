<?php
namespace Source\Models;

use \Source\Core\Connect;
use \PDO;

class Product
{

    /** @var string */
    private $tabela = 'produtos';

    /** @var integer */
    public $id;

    /** @var string */
    public $nome;

    /** @var string */
    public $descricao;

    /** @var integer */
    public $tipo_id;

    /** @var TypeProduct */
    public $typeProduct;

    /** @var boolean */
    public $ativo;

    /** @var string */
    public $cadastro;


    /**
     * @return boolean
     */
    public function create(): bool
    {
        $this->cadastro = date('Y-m-d H:i:s');

        $db = new Connect($this->tabela);

        $this->id = $db->insert([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'tipo_id' => $this->tipo_id,
            'ativo' => $this->ativo,
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
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'tipo_id' => $this->tipo_id,
            'ativo' => $this->ativo,
        ]);
    }

    /**
     * @param integer $id
     * @return Product
     */
    public function find($id): Product 
     {
        $registro = (new Connect($this->tabela))->select('id = '.$id)
            ->fetchObject(self::class);
        $registro->typeProduct = $this->getTipoProduto($registro->tipo_id);
        return $registro;
    }

    /**
     * @param $id
     * @return TypeProduct
     */
    public function getTipoProduto($id): TypeProduct 
    {
        return (new TypeProduct)->find($id);
    }

    /**
     * @param null $where
     * @param null $order
     * @param null $limit
     * @return array
     */
    public function getComTipo($where = null, $order = null, $limit = null): array 
    {
        $registros = $this->get($where = null, $order = null, $limit = null);

        foreach ($registros as $registro) {
            $registro->typeProduct = $this->getTipoProduto($registro->tipo_id);
        }
        return $registros;
    }

    /**
     * @param $data
     * @return $this
     */
    public function fill($data): Product 
    {
        $this->nome = $data['nome'];
        $this->descricao = $data['descricao'];
        $this->tipo_id = $data['tipo_id'];
        $this->ativo = $data['ativo'];

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
