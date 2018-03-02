<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/2/18
 * Time: 3:48 PM
 */

namespace Pessoa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function cadastrarAction()
    {
        return new ViewModel();
    }
}