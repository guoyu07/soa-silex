<?php

namespace Soa\Sistema\Entity;

class Cliente
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
    private $email;

    /**
     *
     * @var string
     */
    private $documento;

    /**
     *
     * @param array $dados
     */
    public function __construct(array $dados)
    {
        extract($dados);
        if (isset($id)) {
            $this->setId($id);
        }

        $this->setNome($nome);
        $this->setEmail($email);
        $this->setDocumento($documento);
    }

    /**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param int $id the id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param string $nome the nome
     *
     * @return self
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of documento.
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Sets the value of documento.
     *
     * @param string $documento the documento
     *
     * @return self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
