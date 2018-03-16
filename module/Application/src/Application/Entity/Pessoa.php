<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/** @ORM\Entity */
class Pessoa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $senha;

    /**
     * @ORM\Column(type="string")
     */
    private $telefone;

    public function __construct($nome, $email, $senha, $telefone)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setRamo($ramo)
    {
        $this->ramo = $ramo;
    }
}


?>