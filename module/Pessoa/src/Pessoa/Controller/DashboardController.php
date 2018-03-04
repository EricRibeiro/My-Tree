<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/3/18
 * Time: 8:42 PM
 */

namespace Pessoa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController
{
    public function indexAction() {
        return new ViewModel();
    }
}