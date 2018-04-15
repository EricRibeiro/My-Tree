<?php

namespace Investidor\Entity;

use Application\Entity\Usuario;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Investidor extends Usuario
{
    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="string")
     */
    private $telefone;

    /**
     * @ORM\Column(type="string")
     */
    private $ramo;

    /**
     * @ORM\OneToMany(targetEntity="Investidor\Entity\Campanha", mappedBy="investidor")
     */
    private $campanha;



    public function __construct($nome, $email, $senha, $telefone, $ramo)
    {
        parent::__construct($email, $senha);
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->ramo = $ramo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getRamo()
    {
        return $this->ramo;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
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