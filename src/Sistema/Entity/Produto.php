<?php

namespace Soa\Sistema\Entity;

/**
 *
 */
class Produto
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $nome;

    /**
     *
     * @var string
     */
    private $descricao;

    /**
     *
     * @var float
     */
    private $valor;

    /**
     * @param array $dados
     */
    public function __construct(array $dados)
    {
        extract($dados);
        if (isset($id) && $id) {
            $this->setId($id);
        }
        if (isset($nome) && $nome) {
            $this->setNome($nome);
        }
        if (isset($descricao) && $descricao) {
            $this->setDescricao($descricao);
        }
        if (isset($valor) && $valor) {
            $this->setValor($valor);
        }
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param float $valor
     */
    public function setValor(float $valor)
    {
        $this->valor = $valor;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
