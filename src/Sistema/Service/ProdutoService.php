<?php

namespace Soa\Sistema\Service;

use Soa\Sistema\Entity\Produto;
use Soa\Sistema\Mapper\ProdutoMapper;

/**
 * Serviço de Produtos
 */
class ProdutoService
{
    /**
     *
     * @var ProdutoMapper
     */
    private $mapper;

    public function __construct(ProdutoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * @param  array  $dados
     * @return Produto
     */
    public function insert(array $dados)
    {
        $produto = $this->mapper->buildObject($dados);
        return $this->mapper->insert($produto)->toArray();
    }

    /**
     *
     * @param  array  $filtros
     * @return Produto[]
     */
    public function getAll(array $filtros = [])
    {
        $produtos = $this->mapper->getAll($filtros);
        $produtos = array_map(array($this, 'extrairDados'), $produtos);
        return $produtos;
    }

    /**
     *
     * @param  int    $idProduto
     * @return array
     */
    public function get(int $idProduto): array
    {
        return $this->mapper->get($idProduto)->toArray();
    }

    /**
     *
     * @param  Produto $produto
     * @return array
     */
    private function extrairDados(Produto $produto)
    {
        return $produto->toArray();
    }
}
