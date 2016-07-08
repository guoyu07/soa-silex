<?php

namespace Soa\Sistema\Mapper;

use Soa\Sistema\Entity\Cliente;
use \Pdo;

class ClienteMapper
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
     * @param  Cliente Novo cliente
     * @return Cliente Cliente com o id preenchido
     */
    public function insert(Cliente $cliente): Cliente
    {
        $sql = "INSERT INTO clientes(nome,email,documento) VALUES(:nome,:email,:documento)";
        $params = [
            ':nome' => $cliente->getNome(),
            ':email' => $cliente->getEmail(),
            ':documento' => $cliente->getDocumento(),
        ];

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        $idCliente = $this->connection->lastInsertId();

        $cliente->setId($idCliente);

        return $cliente;
    }

    /**
     *
     * @param  array  $filtros
     * @return Cliente[]
     */
    public function getAll(array $filtros = []): array
    {
        $sql = "SELECT * FROM clientes";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $clientes = [];
        while ($dadosCliente = $statement->fetch(PDO::FETCH_ASSOC)) {
            $clientes[$dadosCliente['id']] = $this->buildObject($dadosCliente);
        }

        return $clientes;
    }

    /**
     *
     * @param  int    $idCliente
     * @return Cliente
     */
    public function get(int $idCliente): Cliente
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':id' => $idCliente]);
        $dadosCliente = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->buildObject($dadosCliente);
    }

    /**
     *
     * @param  array  $dados
     * @return Cliente
     */
    public function buildObject(array $dados): Cliente
    {
        return new Cliente($dados);
    }
}
