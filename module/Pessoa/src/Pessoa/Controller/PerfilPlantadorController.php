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
use Pessoa\Entity\Pessoa;

class PerfilPlantadorController extends AbstractActionController
{

    public function indexAction()
    {
        if ($user = $this->identity()) {
            $view_params = array(
                'pessoa' => $user,
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
                $repositorio = $entityManager->getRepository("Pessoa\Entity\Pessoa");
                $pessoa = $repositorio->find($id);

                $pessoa->setNome($this->request->getPost('nome'));
                $pessoa->setTelefone($this->request->getPost('celular'));
                $pessoa->setEmail($this->request->getPost('email'));
                $pessoa->setSenha($this->request->getPost('senha'));

                $entityManager->persist($pessoa);
                $entityManager->flush();
            }
            return $this->redirect()->toRoute('pessoa', ['controller' => 'perfil', 'action' => 'index']);

        } else {
            return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

        }
    }
}