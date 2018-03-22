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

class PerfilConcedenteController extends AbstractActionController
{
    public function indexAction() {
        if ($user = $this->identity()) {
            
        		$view_params=array(
				'concedente'=>$user,
			);
            return new ViewModel($view_params);

        }

        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
    }

    public function editarAction(){
          if ($user = $this->identity()) 
          {  	
            if($this->request->isPost())
            {

        		$id=$this->request->getPost('id');
        
                
        		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            	$repositorio = $entityManager->getRepository("Concedente\Entity\Concedente");
          		$concedente=$repositorio->find($id);

             	$concedente->setNome($this->request->getPost('nome'));
             	$concedente->setTelefone($this->request->getPost('celular'));
                $concedente->setEmail($this->request->getPost('email'));
                $concedente->setSenha($this->request->getPost('senha'));

                $entityManager->persist($concedente);
                $entityManager->flush();
               return  $this->redirect()->toRoute('Investidor', ['controller' => 'perfil', 'action' => 'index']);
            }
            else 
            {
                return $this->redirect()->toRoute('pessoa', ['controller' => 'perfil', 'action' => 'index']);
            }

        }

          else 
        {
            return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
        }

		return new ViewModel();
    }





}