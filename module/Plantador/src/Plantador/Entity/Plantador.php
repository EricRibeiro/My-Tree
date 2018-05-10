<?php

namespace Plantador\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Usuario;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Investidor\Entity\Campanha;


/**
 * @ORM\Entity
 */
class Plantador extends Usuario
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
     *@var \Doctrine\Common\Collections\Collection|listaCampanhas[]
     *@ORM\ManyToMany(targetEntity="Investidor\Entity\Campanha", inversedBy="plantador")
     *@ORM\JoinTable(name="PlantadorCampanha",
     joinColumns={@ORM\JoinColumn(name="plantador_id", referencedColumnName="id")},
     inverseJoinColumns={@ORM\JoinColumn(name="campanha_id", referencedColumnName="id")}
     )
     */
     private $listaCampanhas;

     public function __construct($nome, $email, $senha, $telefone)
     {
        parent::__construct($email, $senha);
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->$listaCampanhas=new ArrayCollection();
    }

    public function getListaCampanhas(){
        return $this->listaCampanhas;
    }
    
    public function addCampanha(Campanha $campanha){
        $this->listaCampanhas->add($campanha);
    }

    public function removeCampanha(Campanha $campanha){
        $this->getListaCampanhas()->removeElement($campanha);
    }

    public function isAderido(Campanha $campanha){
        return $this->getListaCampanhas()->contains($campanha);
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