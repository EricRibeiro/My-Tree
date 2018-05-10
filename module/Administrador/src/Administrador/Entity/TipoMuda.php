<?php 
namespace Administrador\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
*/
class TipoMuda{
	
	/**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
	private $id;

	/**
     * @ORM\Column(type="string")
     */
	private $nomePopular;
	/**
    * @ORM\Column(type="string")
    */
	private $nomeCientifico;


	private $local;

	/**
	*@ORM\ManyToOne(targetEntity="Administrador\Entity\TipoMuda", inversedBy="muda")
	*
	*/
	private $muda;


	public function __construct($nomePopular,$nomeCientifico ){
		$this->nomePopular=$nomePopular;
		$this->nomeCientifico=$nomeCientifico;
	}

	public function getNomeCientifico(){
		return $this->nomeCientifico;
	}

	public function getNomePopular(){
		return $this->nomePopular;
	}

	public function TipoMudaToString(){
		return $this->getNomePopular();

	}

	public function getId(){
		return $this->id;
	}

	public function dadosTipoMudaToString(){
		return $this->getNomePopular().'-'.$this->getNomeCientifico();

	}

}


?>