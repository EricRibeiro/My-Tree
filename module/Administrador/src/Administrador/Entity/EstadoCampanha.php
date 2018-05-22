<?php
namespace Administrador\Entity;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", nullable=true)
     */	
	private $situacaoCampanha;
	/**
     * @ORM\Column(type="string", nullable=true)
     */
	private $motivoCancelamento;

	/**
     * @ORM\Column(type="string", nullable=true)
     */
	private $descricaoCancelamento;

	/**
     * @ORM\Column(type="string", nullable=true)
     */
	private $motivoSuspensao;

	/**
	* @ORM\OneToOne(targetEntity="investidor\Entity\Campanha", mappedBy="estadoCampanha")
	*/
	private $campanha;

	/**
     * @ORM\Column(type="string", nullable=true)
     */
	private $motivoAborto;


	public function getMotivoAborto(){
		return $this->motivoAborto;

	}

	public function setMotivoAborto($motivo){
		$this->motivoAborto=$motivo;
	}

	public function setSituacaoCampanha($descricao){
		$this->situacaoCampanha=$descricao;
	}

	public function getSituacaoCampanha(){
		return $this->situacaoCampanha;
	}
	
	public function setDescricaoCancelamento($descricao){
		$this->motivoCancelamento=$descricao;
	}

	public function getDescricaoCancelamento(){
		return $this->motivoCancelamento;
	}

	public function setMotivoSuspensao($descricao){
		$this->motivoSuspensao=$descricao;
	}

	public function getMotivoSuspensao(){
		return $this->motivoSuspensao;

	}

}






?>