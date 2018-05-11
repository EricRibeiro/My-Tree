<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administrador\Entity\Muda;

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
		$campanhas=$entityManager->createQuery('select c from Investidor\Entity\Campanha  c where c.status is null and DATE_DIFF(CURRENT_DATE(), c.dataFinal) <= 0')
		->getResult();

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
			$liberar=true;
			$campanha->setStatus($liberar);
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
			$idCampanha=$this->request->getPost('idCampanha');
			$descricaoCancel=$this->request->getPost('descricaoCancelamento');
			$campanha= $entityManager->getRepository('Investidor\Entity\Campanha')->find($idCampanha);
			$cancelar=false;
			$campanha->setStatus($cancelar);
			$entityManager->persist($campanha);
			$entityManager->flush();
		}

		return $this->redirect()->toRoute('administrador', array(
			'controller' => 'campanha',
			'action' => 'gerenciar',
		));




	}





}
