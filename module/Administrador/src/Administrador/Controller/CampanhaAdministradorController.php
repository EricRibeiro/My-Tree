<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administrador\Entity\Muda;
use Administrador\Entity\TipoMuda;

class CampanhaAdministradorController extends AbstractActionController
{
	public function indexAction()
	{

		if ($user = $this->identity()) {
			return new ViewModel();
		}
		return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
	}

	public function gerenciarAction(){
		
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$qb=$entityManager->createQueryBuilder();
		$qb->select("c")
		->from('Investidor\Entity\Campanha','c')
		->innerJoin("Administrador\Entity\EstadoCampanha","ec","WITH","ec.id=c.estadoCampanha")
		->andWhere('ec.situacaoCampanha = :situacao')
		->setParameter('situacao',"Aliberacao");
		$campanhas=$qb->getQuery()->getResult();

		$view_params = array(
			'campanhas'=>$campanhas
		);
		return new ViewModel($view_params);
	}

	public function liberarAction(){

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		if ($this->request->isPost()) {
			$idCampanha=$this->request->getPost('idCampanhaLiberar');
			$campanha= $entityManager->getRepository('Investidor\Entity\Campanha')->find($idCampanha);
			$qtdMudas=$this->request->getPost('qtdMudas');
			$idTMuda=$this->request->getPost('idTipoMuda');
			$campanha->setEstoqueMuda($this->associarMuda($idTMuda,$qtdMudas));
			$campanha->getEstadocampanha()->setSituacaoCampanha("liberada");
			$entityManager->persist($campanha);
			$entityManager->flush();
		}

		return $this->redirect()->toRoute('administrador', array(
			'controller' => 'campanha',
			'action' => 'gerenciar',
		));

	}

	public function associarMuda($idTmuda,$qtdMudas){

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$tipoMuda=$entityManager->getRepository('Administrador\Entity\TipoMuda')->find($idTmuda);
		$muda = new Muda($tipoMuda,$qtdMudas);
		$entityManager->persist($muda);
		$entityManager->flush();
		
		return $entityManager->getRepository('Administrador\Entity\Muda')->find($muda->getId()); 
		
	}

	public function cancelarAction(){

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		if ($this->request->isPost()) {
			$idCampanha=$this->request->getPost('idCampanhaCancelar');
			$descricaoCancel=$this->request->getPost('descricaoCancelamento');
			$campanha= $entityManager->getRepository('Investidor\Entity\Campanha')->find($idCampanha);

			$campanha->getEstadocampanha()->setSituacaoCampanha("cancelada");
			$campanha->getEstadocampanha()->setDescricaoCancelamento($descricaoCancel);
			$entityManager->persist($campanha);
			$entityManager->flush();
		}

		return $this->redirect()->toRoute('administrador', array(
			'controller' => 'campanha',
			'action' => 'gerenciar',
		));

	}

	public function finalizarAction(){

		$idCampanha=$this->params()->fromRoute('id');

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
		$campanha=$repositorio->find($idCampanha);

		$campanha->getEstadocampanha()->setSituacaoCampanha("finalizada");
		$entityManager->persist($campanha);
		$entityManager->flush();

		return $this->redirect()->toRoute('administrador', array(
			'controller' => 'participacao',
			'action' => 'index',
		));
	}



	public function campanhasfinalizadasAction(){
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		if ($user = $this->identity()) {
			
			$qb=$entityManager->createQueryBuilder();
			$qb->select("c")
			->from('Investidor\Entity\Campanha','c')
			->innerJoin('Administrador\Entity\EstadoCampanha','ec','WITH','ec.id=c.estadoCampanha')
			->andWhere('ec.situacaoCampanha = :situacao')
			->andWhere('c.local is NOT NULL')
			->setParameter('situacao', "finalizada");
			$campanhas=$qb->getQuery()->getResult();

			return new ViewModel(['campanhas'=>$campanhas]);

		}
		return $this->redirect()->toRoute('administrador', ['controller' => 'login', 'action' => 'index']);
	}

}

?>
