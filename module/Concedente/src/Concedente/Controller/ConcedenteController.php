<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Concedente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Concedente\Entity\Concedente;

class ConcedenteController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;

    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            $nome = $this->request->getPost('nome');
            $email = $this->request->getPost('email');
            $senha = $this->request->getPost('senha');
            $telefone = $this->request->getPost('celular');

            $concedente = new Concedente($nome, $email, $senha, $telefone);

            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $entityManager->persist($concedente);
            $entityManager->flush();

            return $this->redirect()->toUrl('/application/login');

        }
    }
}
