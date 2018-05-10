<?php 
namespace Administrador\Entity;
use Doctrine\ORM\Mapping as ORM;
use Administrador\Entity\TipoMuda;
use Investidor\Entity\Campanha;

//true liber, false não liberado null - nao analisada
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
	*@ORM\ManyToOne(targetEntity="Administrador\Entity\TipoMuda", mappedBy="muda")
	*
	*/
	private $typeMuda;

	
	private $campanha;


	public function __construct($campanha,$typeMuda){

	}

	public function setCampanha($campanha){

	}

	public function getCampanha(){

	}


	
	public function setTipoMuda($typeMuda){
		$this->typeMuda=$typeMuda;
	}
		
	public function getTipoMuda(){
		return $typeMuda;

	}




}



?>