<?php

namespace Investidor\Entity;
use Doctrine\ORM\Mapping as ORM;
use Application\helper\Data;
use Concedente\Entity\Local;
use Investidor\Entity\Investidor;


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
     * @ORM\OneToOne(targetEntity="Concedente\Entity\Local")
     * @ORM\JoinColumn(name="local_id", referencedColumnName="id")
     * 
     */
	 private $local;

	 /**
     * @ORM\ManyToOne(targetEntity="Investidor\Entity\Investidor")
     * @ORM\JoinColumn(name="investidor_id", referencedColumnName="id")
     */

	 private $investidor;


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

	  public function getDataIncialString(){
	 	return Data::dataToString($this->getDataInicio());
	 }

	 public function setDataInicio($data){
	 	return $this->dataInicio=Data::setData($data);
	 }

	 public function setDataFinal($data){
	 	return $this->dataFinal=Data::setData($data);

	 }


	}




	?>