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

    /**
     *
     * @param ClienteMapper $mapper
     */
    public function __construct(ClienteMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * @param  array  $dados
     * @return array dados: cliente, status e message
     */
    public function save(array $dados): array
    {
        $cliente = $this->mapper->buildObject($dados);

        if (!isset($dados['id']) || !$dados['id']) {
            $clienteRetorno = $this->mapper->insert($cliente);
        }

        if (isset($dados['id'])) {
            $clienteRetorno = $this->mapper->update($cliente);
        }

        if ($clienteRetorno instanceof Cliente) {
            $retorno = [
                'success' => true,
                'message' => 'Dados do cliente alterados com sucesso!',
                'cliente' => $clienteRetorno->toArray(),
            ];

            return $retorno;
        }

        $retorno = [
            'success' => false,
            'message' => 'Não foi possível inserir/alterar os dados do cliente.',
        ];

        return $retorno;
    }

    /**
     *
     * @param  array  $filtros
     * @return Cliente[]
     */
    public function getAll(array $filtros = []): array
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
     * @param  int    $idCliente
     * @return array dados: success, message
     */
    public function delete(int $idCliente): array
    {
        $rows = $this->mapper->delete($idCliente);

        if ($rows > 0) {
            $retorno = [
                'success' => true,
                'message' => "Cliente #$idCliente deletado",
            ];

            return $retorno;
        }

        $retorno = [
            'success' => false,
            'message' => "Erro ao deletar cliente #$idCliente",
        ];

        return $retorno;
    }

    /**
     *
     * @param  Cliente $cliente
     * @return array
     */
    private function extrairDados(Cliente $cliente): array
    {
        return $cliente->toArray();
    }
}
