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
	private $qtdMuda;
	
	/**
	*@ORM\ManyToOne(targetEntity="Administrador\Entity\TipoMuda", inversedBy="muda")
	*
	*/
	private $typeMuda;

	
	/**
	*@ORM\OneToMany(targetEntity="Investidor\Entity\Campanha", mappedBy="campanha")
	*/
	private $campanha;


	public function __construct($typeMuda,$quantidade){
		$this->qtdMuda=$quantidade;
		$this->typeMuda=$typeMuda;
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
		$this->qtdMuda=$qtdMudas;

	}

	public function getQuantidadeMudas(){
		return $this->qtdMudas;
	}

}



?>