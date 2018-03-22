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
use Investidor\Entity\Investidor;

class PerfilInvestidorController extends AbstractActionController
{
    public function indexAction()
    {
        if ($user = $this->identity()) {
            $view_params = array(
                'investidor' => $user,
            );
            return new ViewModel($view_params);

        }
        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

    }

    public function editarAction()
    {
        if ($user = $this->identity()) {
            if ($this->request->isPost()) {

                $id = $this->request->getPost('id');
                $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $repositorio = $entityManager->getRepository("Investidor\Entity\Investidor");
                $investidor = $repositorio->find($id);

                $investidor->setNome($this->request->getPost('nome'));
                $investidor->setTelefone($this->request->getPost('telefone'));
                $investidor->setRamo($this->request->getPost('ramo'));
                $investidor->setEmail($this->request->getPost('email'));
                $investidor->setSenha($this->request->getPost('senha'));

                $entityManager->persist($investidor);
                $entityManager->flush();
            }
            return $this->redirect()->toRoute('investidor', ['controller' => 'perfil', 'action' => 'index']);

        } else
            return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

    }
}