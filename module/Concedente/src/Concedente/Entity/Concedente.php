<?php

namespace Concedente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Usuario;
use Concedente\Entity\Local;




/**
 * @ORM\Entity
 */
class Concedente extends Usuario
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
     * @ORM\OneToMany(targetEntity="Concedente\Entity\Local", mappedBy="concedente")
     */
    private $local;

    public function __construct($nome, $email, $senha, $telefone)
    {
        parent::__construct($email, $senha);
        $this->nome = $nome;
        $this->telefone = $telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
}

?>