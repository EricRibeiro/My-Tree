<?php 

namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administrador\Entity\TipoMuda;


class MudaAdministradorController extends AbstractActionController
{

	public function indexAction()
	{

		if ($user = $this->identity()) {
			$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$repositorio = $entityManager->getRepository('Administrador\Entity\TipoMuda');
			$tiposMuda = $repositorio->findAll();

			$view_params = array(
                'tiposMuda' => $tiposMuda                
            ); 

			return new ViewModel($view_params);
		}
		return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
	}



	public function cadastrarAction(){
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		if ($this->request->isPost()) {
			
			$nomeCientifico=$this->request->getPost('nomeCientifico');
			$nomePopular=$this->request->getPost('nomePopular');

			$tipoMuda = new TipoMuda($nomePopular,$nomeCientifico);
			$entityManager->persist($tipoMuda);
			$entityManager->flush();
		}

		return $this->redirect()->toRoute('administrador', ['controller' => 'tipomuda', 'action' => 'index']);
	}

}
