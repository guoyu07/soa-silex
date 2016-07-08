<?php

namespace Soa\Sistema\Service;

use Soa\Sistema\Entity\Cliente;
use Soa\Sistema\Mapper\ClienteMapper;

/**
 * Serviço de Clientes
 */
class ClienteService
{
    /**
     *
     * @var ClienteMapper
     */
    private $mapper;

    public function __construct(ClienteMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * @param  array  $dados
     * @return Cliente
     */
    public function insert(array $dados)
    {
        $cliente = $this->mapper->buildObject($dados);
        return $this->mapper->insert($cliente)->toArray();
    }

    /**
     *
     * @param  array  $filtros
     * @return Cliente[]
     */
    public function getAll(array $filtros = [])
    {
        $clientes = $this->mapper->getAll($filtros);
        $clientes = array_map(array($this, 'extrairDados'), $clientes);
        return $clientes;
    }

    /**
     *
     * @param  int    $idCliente
     * @return array
     */
    public function get(int $idCliente): array
    {
        return $this->mapper->get($idCliente)->toArray();
    }

    /**
     *
     * @param  Cliente $cliente
     * @return array
     */
    private function extrairDados(Cliente $cliente)
    {
        return $cliente->toArray();
    }
}
