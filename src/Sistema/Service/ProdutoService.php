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

    /**
     *
     * @param ProdutoMapper $mapper
     */
    public function __construct(ProdutoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * @param  array  $dados
     * @return array dados: produto, status e message
     */
    public function save(array $dados): array
    {
        $produto = $this->mapper->buildObject($dados);

        if (!isset($dados['id']) || !$dados['id']) {
            $produtoRetorno = $this->mapper->insert($produto);
        }

        if (isset($dados['id'])) {
            $produtoRetorno = $this->mapper->update($produto);
        }

        if ($produtoRetorno instanceof Produto) {
            $retorno = [
                'success' => true,
                'message' => 'Dados do produto alterados com sucesso!',
                'produto' => $produtoRetorno->toArray(),
            ];

            return $retorno;
        }

        $retorno = [
            'success' => false,
            'message' => 'Não foi possível inserir/alterar os dados do produto.',
        ];

        return $retorno;
    }

    /**
     *
     * @param  array  $filtros
     * @return Produto[]
     */
    public function getAll(array $filtros = []): array
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
     * @param  int    $idProduto
     * @return array dados: success, message
     */
    public function delete(int $idProduto): array
    {
        $rows = $this->mapper->delete($idProduto);

        if ($rows > 0) {
            $retorno = [
                'success' => true,
                'message' => "Produto #$idProduto deletado",
            ];

            return $retorno;
        }

        $retorno = [
            'success' => false,
            'message' => "Erro ao deletar produto #$idProduto",
        ];

        return $retorno;
    }

    /**
     *
     * @param  Produto $produto
     * @return array
     */
    private function extrairDados(Produto $produto): array
    {
        return $produto->toArray();
    }
}
