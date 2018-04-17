<?php

namespace Concedente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Concedente\Entity\Concedente;


/**
 * @ORM\Entity
 */
class Local
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
    private $uf;
    /**
     * @ORM\Column(type="string")
     */
    private $municipio;
    /**
     * @ORM\Column(type="string")
     */    
    private $cep;
    /**
     * @ORM\Column(type="string")
     */  
    private $bairro;
    /**
     * @ORM\Column(type="string")
     */
    private $logradouro;
    /**
     * @ORM\Column(type="string")
     */
    private $numero;
    /**
     * @ORM\Column(type="string")
     */
    private $complemento;
    /**
     * @ORM\Column(type="string")
     */
    private $latitude;
    /**
     * @ORM\Column(type="string")
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="Concedente\Entity\Concedente", inversedBy="local")
     * @ORM\JoinColumn(name="concedente_id", referencedColumnName="id")
     */
    private $concedente;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ocupado;


    public function __construct($uf, $municipio, $cep, $bairro, $logradouro, $numero, $complemento, $latitude, $longitude, $concedente, $ocupado)
    {
        $this->uf = $uf;
        $this->municipio = $municipio;
        $this->bairro = $bairro;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->cep = $cep;
        $this->concedente = $concedente;
        $this->ocupado = $ocupado;
    }
    
    public function getConcedente(){
        return $this->concedente;

    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getUF()
    {
        return $this->uf;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    public function setUF($uf)
    {
        $this->uf = $uf;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }


}

?>