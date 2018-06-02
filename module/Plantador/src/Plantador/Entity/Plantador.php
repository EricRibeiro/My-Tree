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
     *@ORM\JoinTable(name="HistoricoCampanhas",
     joinColumns={@ORM\JoinColumn(name="plantador_id", referencedColumnName="id")},
     inverseJoinColumns={@ORM\JoinColumn(name="campanha_id", referencedColumnName="id")},
     )
     */
     private $listaCampanhas;

      /**
     *@var \Doctrine\Common\Collections\Collection|campanhasParticipadas[]
     *@ORM\ManyToMany(targetEntity="Investidor\Entity\Campanha", inversedBy="plantador")
     *@ORM\JoinTable(name="CampanhasParticipadas",
     joinColumns={@ORM\JoinColumn(name="plantador_id", referencedColumnName="id")},
     inverseJoinColumns={@ORM\JoinColumn(name="campanha_id", referencedColumnName="id")},
     )
     */
     private $campanhasParticipadas;



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
        $campanha->addPlantador($this);
        $this->listaCampanhas->add($campanha);
    }

    public function removeCampanha(Campanha $campanha){
        $campanha->removePlantador($this);
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

    public function confirmarPresenca(Campanha $campanha){
        $this->campanhasParticipadas->add($campanha);
    }

    public function getCampanhasParticipadas(){
        return $this->campanhasParticipadas;


    }



}

?>