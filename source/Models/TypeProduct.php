<?php
namespace Source\Models;

use \Source\Core\Connect;
use \PDO;

class TypeProduct
{

    /** @var string */
    private $tabela = 'tiposprodutos';

    /** @var integer */
    public $id;

    /**  @var string */
    public $nome;

    /** @var string */
    public $descricao;

    /** @var float */
    public $percentual_imposto;

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
            'percentual_imposto' => $this->percentual_imposto,
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
            'percentual_imposto' => $this->percentual_imposto,
            'ativo' => $this->ativo,
        ]);
    }

    /**
     * @param  integer $id
     * @return TypeProduct
     */
    public function find($id): TypeProduct 
    {
        return (new Connect($this->tabela))->select('id = '.$id)
            ->fetchObject(self::class);
    }

    /**
     * @param $data
     * @return $this
     */
    public function fill($data) : TypeProduct 
    {
        $this->nome = $data['nome'];
        $this->descricao = $data['descricao'];
        $this->percentual_imposto = formatarDecimal($data['percentual_imposto']);
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
