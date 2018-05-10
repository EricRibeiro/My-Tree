<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardAdministradorController extends AbstractActionController
{
	public function indexAction()
	{
		if ($user = $this->identity()) {
			return new ViewModel();
		}
		return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
	}
}
