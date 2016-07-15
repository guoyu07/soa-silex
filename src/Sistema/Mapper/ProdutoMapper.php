<?php

namespace Soa\Sistema\Mapper;

use Soa\Sistema\Entity\Produto;
use \Pdo;

/**
 *
 */
class ProdutoMapper
{

    /**
     *
     * @var Pdo
     */
    private $connection;

    /**
     *
     * @param Pdo $connection conexão com o banco
     */
    public function __construct(Pdo $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param  Produto Novo produto
     * @return Produto Produto com o id preenchido
     */
    public function insert(Produto $produto): Produto
    {
        $sql = "INSERT INTO produtos(nome,descricao,valor) VALUES(:nome,:descricao,:valor)";
        $params = [
            ':nome' => $produto->getNome(),
            ':descricao' => $produto->getDescricao(),
            ':valor' => $produto->getValor(),
        ];

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        $idProduto = $this->connection->lastInsertId();

        $produto->setId($idProduto);

        return $produto;
    }

    /**
     *
     * @param  array  $filtros
     * @return Produto[]
     */
    public function getAll(array $filtros = []): array
    {
        $sql = "SELECT * FROM produtos";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $produtos = [];
        while ($dadosProduto = $statement->fetch(PDO::FETCH_ASSOC)) {
            $produtos[$dadosProduto['id']] = $this->buildObject($dadosProduto);
        }

        return $produtos;
    }

    /**
     *
     * @param  int    $idProduto
     * @return Produto
     */
    public function get(int $idProduto): Produto
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':id' => $idProduto]);
        $dadosProduto = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->buildObject($dadosProduto);
    }

    /**
     *
     * @param  Produto $produto
     * @return Produto
     */
    public function update(Produto $produto): Produto
    {
        $params = [
            ':nome' => $produto->getNome(),
            ':descricao' => $produto->getDescricao(),
            ':valor' => $produto->getValor(),
        ];

        $set = [];
        foreach (array_keys($params) as $key) {
            $keyname = substr($key, 1);
            $set[] = "$keyname = $key";
        }

        $params[':id'] = $produto->getId();

        $sql = sprintf("UPDATE produtos SET %s WHERE id = :id", implode(', ', $set));
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        if (!$statement->rowCount()) {
            throw new \Exception("Não foi possível atualizar o produto", 1);
        }

        return $produto;
    }

    /**
     *
     * @param  int    $idProduto
     * @return int Produtos deletados
     */
    public function delete(int $idProduto): int
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':id' => $idProduto]);

        return $statement->rowCount();
    }

    /**
     *
     * @param  array  $dados
     * @return Produto
     */
    public function buildObject(array $dados): Produto
    {
        return new Produto($dados);
    }
}
