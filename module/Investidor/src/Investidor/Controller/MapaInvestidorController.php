<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/3/18
 * Time: 11:29 PM
 */

namespace Investidor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MapaInvestidorController extends AbstractActionController
{
    public function indexAction() {
        if ($user = $this->identity()) {
            return new ViewModel();
        }
        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
    }
}