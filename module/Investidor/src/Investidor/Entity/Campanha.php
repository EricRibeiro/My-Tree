<?php

namespace Investidor\Entity;
use Doctrine\ORM\Mapping as ORM;
use Application\helper\Data;
use Concedente\Entity\Local;
use Investidor\Entity\Investidor;
use Plantador\Entity\Plantador;
use Administrador\Entity\Muda;
use Administrador\Entity\TipoMuda;

/**
 * @ORM\Entity
 */
class Campanha {
	
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
     * @ORM\Column(type="float")
     */
	private $valor;
	
	/**
     * @ORM\Column(type="date")
     */

	private $dataInicio;
	
	 /**
     * @ORM\Column(type="date")
     */
	 private $dataFinal;

	 /**
     * @ORM\OneToOne(targetEntity="Concedente\Entity\Local", inversedBy="campanha")
     * @ORM\JoinColumn(name="local_id", referencedColumnName="id", onDelete="SET NULL")
     * 
     */
	 private $local;

	 /**
     * @ORM\ManyToOne(targetEntity="Investidor\Entity\Investidor")
     * @ORM\JoinColumn(name="investidor_id", referencedColumnName="id")
     */

	 private $investidor;

	/**
		*@ORM\Column(type="boolean", nullable=true)
	*/
	private $status;

	
	private $estadoCampanha;

	/**
	*@ORM\ManyToOne(targetEntity="Administrador\Entity\Muda", inversedBy="campanha")
	*@ORM\JoinColumn(name="muda_id", referencedColumnName="id")
	*/
	private $estoqueMuda;


	public function __construct($nome, $valor, $dataInicio, $dataFinal, $investidor){
		$this->nome=$nome;
		$this->valor=$valor;
		$this->setDataInicio($dataInicio);
		$this->setDataFinal($dataFinal);
		$this->investidor=$investidor;
	}

	public function getId(){
		return $this->id;
	}

	public function getInvestidor(){
		return $this->investidor;
	}

	public function getLocal(){
		return $this->local;
	}

	public function setInvestidor($investidor){
		$this->investidor=$investidor;
	}

	public function setLocal($local){
		$this->local=$local;

	}

	public function setNome($nome){
		$this->nome=$nome;

	}
	public function getNome(){
		return $this->nome;
	}

	public function setValor($valor){
		$this->valor=$valor;

	}

	public function getValor(){
		return $this->valor;

	}

	public function getDataInicio(){
		return $this->dataInicio;
	}

	public function getDataFinal(){
		return $this->dataFinal;
	}

	public function getDataFinalString(){
		return Data::dataToString($this->getDataFinal());
	}

	public function getDataInicialString(){
		return Data::dataToString($this->getDataInicio());
	}

	public function setDataInicio($data){
		return $this->dataInicio=Data::setData($data);
	}

	public function setDataFinal($data){
		return $this->dataFinal=Data::setData($data);

	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status=$status;
	}

	public function setEstoqueMuda($muda){
		$this->estoqueMuda=$muda;
	}

	public function getEstoqueMuda(){
		return $this->estoqueMuda;
	}

	public function desestocarMuda(){
		$eMudas=$this->getEstoqueMuda();
		$qtdMudas=$eMudas->getQuantidadeMudas();
		$qtdMudas--;
		$eMudas->setQuantidadeMudas($qtdMudas);
	}

	public function estocarMuda(){
		$eMudas=$this->getEstoqueMuda();
		$qtdMudas=$eMudas->getQuantidadeMudas();
		$qtdMudas++;
		$eMudas->setQuantidadeMudas($qtdMudas);
	}
	
	public function suspender(){
		$this->suspensao=true;

	}





}




?>