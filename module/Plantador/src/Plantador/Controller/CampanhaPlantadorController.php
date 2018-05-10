<?php
namespace Plantador\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CampanhaPlantadorController extends AbstractActionController
{

	public function indexAction(){


		return new ViewModel();
	}

	public function aderirAction(){
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		
		if($this->request->isPost()){
			
			$idCampanha=$this->request->getPost('id');
			$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
			$campanha=$repositorio->find($idCampanha);

			$user=$this->identity();
			$user->addCampanha($campanha);
			$entityManager->persist($user);
			$entityManager->flush();
		}else {
			$repositorio = $entityManager->getRepository("Investidor\Entity\Campanha");
			$campanhas=$repositorio->findAll();
			$user=$this->identity();
			$view_params = array(
				'campanhas' => $campanhas,
				'plantador'=> $user
			);
			return new ViewModel($view_params);
		}
		return $this->redirect()->toRoute('plantador', array(
			'controller' => 'campanha',
			'action' => 'aderir',
		));		
	}

	public function sairAction(){

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		
		if($this->request->isPost()){
			
			$idCampanha=$this->request->getPost('id');
			$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
			$campanha=$repositorio->find($idCampanha);

			$user=$this->identity();
			$user->removeCampanha($campanha);

			$entityManager->persist($user);
			$entityManager->flush();
		}
		return $this->redirect()->toRoute('plantador', array(
			'controller' => 'campanha',
			'action' => 'aderir',
		));
		
	}

}


?>