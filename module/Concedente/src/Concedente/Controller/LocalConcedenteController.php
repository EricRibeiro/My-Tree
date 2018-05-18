<?php


namespace Concedente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Concedente\Entity\Local;
use Administrador\Entity\TipoMuda;

class LocalConcedenteController extends AbstractActionController
{
    public function indexAction()
    {
        if ($user = $this->identity()) {
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository('Concedente\Entity\Local');
            $locais = $repositorio->findBy(array('concedente'=>$user));
            
            $view_params = array(
                'concedente' => $user,
                'locais' => $locais,
            );  
            return new ViewModel($view_params);

        }
        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

    }

    public function cadastrarAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $repositorio = $entityManager->getRepository('Concedente\Entity\Concedente');

        if ($this->request->isPost()) {
            $logradouro = $this->request->getPost('logradouro');
            $bairro = $this->request->getPost('bairro');
            $municipio = $this->request->getPost('municipio');
            $uf = $this->request->getPost('uf');
            $cep = $this->request->getPost('cep');
            $numero = $this->request->getPost('numero');
            $complemento = $this->request->getPost('complemento');
            $areaLocal=$this->request->getPost('areaLocal');
            $latitude = "";
            $longitude = "";


            $mudas=explode('-', $this->request->getPost('tiposMudaLocal'));

            $user = $this->identity();

            $local = new Local($uf, $municipio, $cep, $bairro, $logradouro, $numero, $complemento, $latitude, $longitude, $user, $areaLocal);

            foreach ($mudas as $idmuda) {
                $repositorio = $entityManager->getRepository('Administrador\Entity\TipoMuda');
                $muda=$repositorio->find($idmuda);
                $local->addTipoMuda($muda);
            }

            $entityManager->persist($local);
            $entityManager->flush();
        }else{

            $repositorio = $entityManager->getRepository('Administrador\Entity\TipoMuda');
            $tiposMuda=$repositorio->findAll();

            if ($user = $this->identity()){
                $view_params = array(
                    'concedente' => $user,
                    'mudas'=>$tiposMuda
                );
                return new ViewModel($view_params);
            }
        }

        return $this->redirect()->toRoute('concedente', array(
            'controller' => 'local',
            'action' => 'index',
        ));

    }
    
    public function removerAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!is_null($id)) {
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository("Concedente\Entity\Local");
            $local = $repositorio->find($id);

            if(!is_null($local->getCampanha())){

               $campanha=$local->getCampanha();
               $campanha->getEstadoCampanha()->setSituacaoCampanha("abortada");
               $motivo="O concedente indisponibilizou o local";
               $campanha->getEstadoCampanha()->setMotivoAborto($motivo);
               $entityManager->persist($campanha);
               $entityManager->flush();
           }else {
               $entityManager->remove($local);
               $entityManager->flush();
           }


       }
       return $this->redirect()->toRoute('concedente', array(
        'controller' => 'local',
        'action' => 'index',
    ));

   }

   public function editarAction()
   {
    if ($user = $this->identity()) {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository("Concedente\Entity\Local");

        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $local = $repositorio->find($id);

        if ($this->request->isPost()) {

            $id = $this->request->getPost('id');


            $local->setLogradouro($this->request->getPost('logradouro'));
            $local->setNumero($this->request->getPost('numero'));
            $local->setComplemento($this->request->getPost('complemento'));
            $local->setBairro($this->request->getPost('bairro'));
            $local->setMunicipio($this->request->getPost('municipio'));
            $local->setUF($this->request->getPost('uf'));
            $local->setCep($this->request->getPost('cep'));


            $entityManager->persist($local);
            $entityManager->flush();

            return $this->redirect()->toRoute('concedente', array(
                'controller' => 'local',
                'action' => 'index',
            ));

        }
        return new ViewModel(['local' => $local]);


    } else {
        return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);

    }
}









}