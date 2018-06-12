<?php
namespace Investidor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Concedente\Entity\Local;
use Concedente\Entity\Concedente;
use Investidor\Entity\Investidor;
use Investidor\Entity\Campanha;
use Administrador\Entity\EstadoCampanha;

class CampanhaInvestidorController extends AbstractActionController
{
  public function indexAction() {
    if ($user = $this->identity()) {
      $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      $qb=$entityManager->createQueryBuilder();
      $qb->select("c")
      ->from('Investidor\Entity\Campanha','c')
      ->innerJoin('Administrador\Entity\EstadoCampanha','ec','WITH','ec.id=c.estadoCampanha')
      ->andWhere('c.investidor = :investidor')
      ->orWhere('ec.motivoAborto IS NULL')
      ->andWhere('ec.situacaoCampanha != :situacao')
      ->setParameter('situacao','abortada')
      ->setParameter('investidor',$user);
      
      $campanhas=$qb->getQuery()->getResult();
      $view_params= array(
        "campanhas"=> $campanhas,
      );      
      return new ViewModel($view_params);
    }
    return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
    
  }

  private function getLocaisDisponiveis(){
    $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    $repositorio = $entityManager->getRepository('Concedente\Entity\Local');
    $locais = $repositorio->findBy(array("campanha"=>null));
    return $locais;

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
    $campanha=$this->criarCampanha($campanha,$nome,$valor,$dataInicio,$dataTermino,$user);
    $this->associarLocalACampanha($idLocal,$campanha,$entityManager);
    
    return $this->redirect()->toRoute('investidor', array(
      'controller' => 'campanha',
      'action' => 'index',
    ));
  }

  $view_params = array(
    'locais' => $this->getLocaisDisponiveis()
  );  

  return new ViewModel($view_params);
}

private function retirarCampanhaDoLocal($campanha,$entityManager){

 if(!is_null($campanha->getLocal())){
   $local=$campanha->getLocal();
   $local->setCampanha(null);
   $entityManager->persist($local);
   $entityManager->flush();
 }

}

private function associarLocalACampanha($idLocal, $campanha,$entityManager){

 if($idLocal!=""){
  $this->retirarCampanhaDoLocal($campanha,$entityManager);

  $local=$entityManager->getRepository('Concedente\Entity\Local')->find($idLocal);

  $campanha->setLocal($local);
  $m="Aliberacao";

  $campanha->getEstadoCampanha()->setSituacaoCampanha($m);
  $entityManager->persist($campanha);
  $entityManager->flush();

  $local->setCampanha($campanha);

  $entityManager->persist($local);
  $entityManager->flush();


} else {

  if(!is_null($campanha->getLocal())){
    $estado="Aliberacao";
  } else {
    $estado="Alocal";
  }

  $this->retirarCampanhaDoLocal($campanha,$entityManager);
  $campanha->getEstadoCampanha()->setSituacaoCampanha($estado);
  $entityManager->persist($campanha);
  $entityManager->flush();
}

}

private function criarCampanha($campanha,$nome,$valor,$dataInicio,$dataTermino,$user){


  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
  $eCampanha= new EstadoCampanha();
  $entityManager->persist($eCampanha);
  $entityManager->flush();


  $campanha = new Campanha($nome,$valor,$dataInicio,$dataTermino,$user);
  $campanha->setEstadoCampanha($eCampanha);
  $entityManager->persist($campanha);
  return $campanha;

}

public function removerAction(){

 $id = $this->params()->fromRoute('id');
 
 if (!is_null($id)) {

  $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
  $repositorio = $entityManager->getRepository("Investidor\Entity\Campanha");
  
  $campanha = $repositorio->find($id);
  
  if($campanha->getEstadoCampanha()->getSituacaoCampanha()=="liberada"){

   $campanha->getEstadoCampanha()->setSituacaoCampanha("abortada");

   $entityManager->persist($campanha);
   $entityManager->flush();

 } else {

  $entityManager->remove($campanha);
  $entityManager->flush();

}

}
return $this->redirect()->toRoute('investidor', array(
  'controller' => 'campanha',
  'action' => 'index',
));

}

public function editarAction(){

 $idCampanha=$this->params()->fromRoute('id');
 $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
 $repositorio= $entityManager->getRepository("Investidor\Entity\Campanha");
 $campanha=$repositorio->find($idCampanha);

 if($this->request->isPost()){

  $campanha->setNome($this->request->getPost('nome'));
  $campanha->setValor($this->request->getPost('valor'));
  $campanha->setDataInicio( $this->request->getPost('dataInicio'));
  $campanha->setDataFinal($this->request->getPost('dataTermino'));

  $idLocal=$this->request->getPost('idLocal');
  
  $this->associarLocalACampanha($idLocal,$campanha,$entityManager);
  return $this->redirect()->toRoute('investidor', ['controller' => 'campanha', 'action' => 'index']);

}

return new ViewModel(['campanha'=>$campanha, 'locais'=>$this->getLocaisDisponiveis()]);


}


}




?>