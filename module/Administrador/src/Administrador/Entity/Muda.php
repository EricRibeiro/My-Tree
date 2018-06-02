<?php 
namespace Administrador\Entity;
use Doctrine\ORM\Mapping as ORM;
use Administrador\Entity\TipoMuda;
use Investidor\Entity\Campanha;

/**
 * @ORM\Entity
 */
class Muda {


	/**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
	private $id;

	/**
	*@ORM\Column(type="integer")
	*
	*/
	private $estoqueMuda;
	
	/**
	*@ORM\Column(type="integer")
	*
	*/
	private $qtdInicialMuda;


	/**
	*@ORM\ManyToOne(targetEntity="Administrador\Entity\TipoMuda", inversedBy="muda" )
	*
	*/
	private $typeMuda;

	/**
	*@ORM\OneToMany(targetEntity="Investidor\Entity\Campanha", mappedBy="campanha")
	*/
	private $campanha;


	public function __construct($typeMuda,$quantidade){
		$this->estoqueMuda=$quantidade;
		$this->typeMuda=$typeMuda;
		$this->qtdInicialMuda=$quantidade;
	}

	public function getId(){
		return $this->id;
	}

	public function setTipoMuda($typeMuda){
		$this->typeMuda=$typeMuda;
	}

	public function getTipoMuda(){
		return $this->typeMuda;
	}

	public function setQuantidadeMudas($qtdMudas){
		$this->estoqueMuda=$qtdMudas;

	}

	public function getQuantidadeMudas(){
		return $this->estoqueMuda;
	}

	public function totalPlantadoresInscritos(){
		return ($this->qtdInicialMuda-$this->estoqueMuda);
	}

	public function getTotalMudasDisponibilizadas(){
		return $this->qtdInicialMuda;


	}

}



?>