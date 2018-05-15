<?php
namespace Investidor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Concedente\Entity\Local;
use Concedente\Entity\Concedente;
use Investidor\Entity\Investidor;
use Investidor\Entity\Campanha;

class CampanhaInvestidorController extends AbstractActionController
{
  public function indexAction() {

    if ($user = $this->identity()) {
      $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      $qb=$entityManager->createQueryBuilder();
      $qb->select("c")
      ->from('Investidor\Entity\Campanha','c')
      ->andWhere('c.suspensao IS NULL')
      ->andWhere('c.investidor = :investidor')
      ->setParameter('investidor',$user);
      $campanhas=$qb->getQuery()->getResult();

      $view_params= array(
        "campanhas"=> $campanhas,

      );      

      return new ViewModel($view_params);
    }
    return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
  }


  public function cadastrarAction(){

   $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

   if ($this->request->isPost()) {

    $idLocal=$this->request->getPost('idLocal');
    $nome = $this->request->getPost('nome');
    $valor = $this->request->getPost('valor');
    $dataInicio = $this->request->getPost('dataInicio');
    $dataTermino= $this->request->getPost('dataTermino');

    $user = $this->identity();
    $campanha = new Campanha($nome,$valor,$dataInicio,$dataTermino,$user);
    
    if($idLocal!=""){
      $local=$entityManager->getRepository('Concedente\Entity\Local')->find($idLocal);

      $campanha->setLocal($local);
      
      $entityManager->persist($campanha);
      $entityManager->flush();

      $local->setCampanha($campanha);
      
      $entityManager->persist($local);
      $entityManager->flush();

    } else {
      $entityManager->persist($campanha);
      $entityManager->flush();
    }


    return $this->redirect()->toRoute('investidor', array(
      'controller' => 'campanha',
      'action' => 'index',
    ));
  }

  $repositorio = $entityManager->getRepository('Concedente\Entity\Local');

  $locais = $repositorio->findBy(array("campanha"=>null));
  

  $view_params = array(
    'locais' => $locais,
  );  

  return new ViewModel($view_params);
}


public function removerAction(){

 $id = $this->params()->fromRoute('id');
 
 if (!is_null($id)) {

  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
  $repositorio = $entityManager->getRepository("Investidor\Entity\Campanha");
  $campanha = $repositorio->find($id);
  $campanha->suspender();
  $entityManager->flush();
  
}
return $this->redirect()->toRoute('investidor', array(
  'controller' => 'campanha',
  'action' => 'index',
));
}


}

?>