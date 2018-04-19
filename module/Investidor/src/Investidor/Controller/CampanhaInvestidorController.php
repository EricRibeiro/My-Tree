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
     $repositorio = $entityManager->getRepository('Investidor\Entity\Campanha');

     $campanhas = $repositorio->findBy(array('investidor'=>$user));

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
    }

    
    $entityManager->flush();
    

    return $this->redirect()->toRoute('investidor', array(
      'controller' => 'campanha',
      'action' => 'index',
    ));
  }

  $repositorio = $entityManager->getRepository('Concedente\Entity\Local');

  $locais = $repositorio->findALL();
  

  $view_params = array(
    'locais' => $locais,
  );  

  return new ViewModel($view_params);
}


public function editarAction(){

  $id = $this->params()->fromRoute('id');

  if (is_null($id)) {
    $id = $this->request->getPost('id');
  }

  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

  $repositorio = $entityManager->getRepository("Investidor\Entity\Campanha");

  $campanha = $repositorio->find($id);

  if ($this->request->isPost()) {

    $idLocal=$this->request->getPost('idLocalSelecionado');
    $campanha->setValor($this->request->getPost('valor'));
    $campanha->setNome($this->request->getPost('nome'));
    $campanha->setDataInicio($this->request->getPost('dataInicio'));
    $campanha->setDataFinal($this->request->getPost('dataTermino'));      
    
    $repositorio = $entityManager->getRepository("Concedente\Entity\Local");
    $local = $repositorio->find($idLocal);

    $campanha->setLocal($local);

    $entityManager->persist($campanha);
    $entityManager->flush();

    return $this->redirect()->toRoute('investidor', array(
      'controller' => 'campanha',
      'action' => 'index',
    ));
  }

  $repositorio = $entityManager->getRepository('Concedente\Entity\Local');

  $locais = $repositorio->findAll();

  $view_params = array(
    'locais' => $locais,
    'campanha'=> $campanha
  );  

  $entityManager->flush();
  return new ViewModel($view_params);
}

public function removerAction(){

 $id = $this->params()->fromRoute('id');
 if (!is_null($id)) {

  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
  $repositorio = $entityManager->getRepository("Investidor\Entity\Campanha");
  $campanha = $repositorio->find($id);
  $local=$campanha->getLocal();
  $entityManager->remove($campanha);
  
  if(!is_null($local)){

   $repositorio = $entityManager->getRepository("Concedente\Entity\Local");
   $local = $repositorio->find($local->getId());
   $local->alterarOcupacao(false);
   $entityManager->persist($local);
   $entityManager->flush();
   
 }

 $entityManager->flush();


}
return $this->redirect()->toRoute('investidor', array(
  'controller' => 'campanha',
  'action' => 'index',
));
}


}

?>