<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/3/18
 * Time: 8:42 PM
 */

namespace Concedente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardConcedenteController extends AbstractActionController
{
    public function indexAction() {
        if ($user = $this->identity()) {
            return new ViewModel();
        }
        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
    }
}