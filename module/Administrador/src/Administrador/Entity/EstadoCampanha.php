<?php
namespace Administrador\Entity;


/**
 * @ORM\Entity
 */
class EstadoCampanha 
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
	private $situacaoCampanha;
	/**
     * @ORM\Column(type="string")
     */
	private $motivoCancelamento;

	/**
     * @ORM\Column(type="string")
     */
	private $descricaoCancelamento;

	
	function __construct($campanha,$descricaoCancelamento)
	{
		$this->campanha=$campanha;
		$this->descricaoCancelamento=$descricaoCancelamento;
	}

	public function getDescricaoCancelamento(){
		

		return $this->descricaoCancelamento;
	}

	public function getSituacaoCampanha(){
			return $this->situacaoCampanha;
	}

	public function cancelarCampanha($descricao){
		$this->situacaoCampanha="cancelada";
		$this->descricaoCancelamento=$descricao;
	}

	public function suspenderCampanha(){
		$this->situacaoCampanha="suspensa";
	}

	public function liberarCampanha(){
		$this->situacaoCampanha="liberada";	
	}





}






?>