<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
		$repositorio = $entityManager->getRepository('Investidor\Entity\Campanha');
		$campanhas=$repositorio->findAll();
		$view_params = array(
			'campanhas'=>$campanhas
		);
		return new ViewModel($view_params);

	/*
	return $this->redirect()->toRoute('Administrador', array(
		'controller' => 'index',
		'action' => 'index',
	));
	*/
}

public function liberarAction(){

	$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	if ($this->request->isPost()) {
		$idCampanha=$this->request->getPost('idCampanha');
		$campanha= $entityManager->getRepository('Investidor\Entity\Campanha')->find($idCampanha);
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

public function cancelarAction(){

	$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	if ($this->request->isPost()) {
		$idCampanha=$this->request->getPost('idCampanha');
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
