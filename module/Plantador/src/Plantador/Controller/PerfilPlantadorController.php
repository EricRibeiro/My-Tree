<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/3/18
 * Time: 8:42 PM
 */

namespace Plantador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Plantador\Entity\Plantador;

class PerfilPlantadorController extends AbstractActionController
{

    public function indexAction()
    {
        if ($user = $this->identity()) {
            $view_params = array(
                'plantador' => $user,
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
                $repositorio = $entityManager->getRepository("Plantador\Entity\Plantador");
                $plantador = $repositorio->find($id);

                $plantador->setNome($this->request->getPost('nome'));
                $plantador->setTelefone($this->request->getPost('celular'));
                $plantador->setEmail($this->request->getPost('email'));
                $plantador->setSenha($this->request->getPost('senha'));

                $entityManager->persist($plantador);
                $entityManager->flush();
            }
            return $this->redirect()->toRoute('plantador', ['controller' => 'perfil', 'action' => 'index']);

        } else {
            return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

        }
    }
}