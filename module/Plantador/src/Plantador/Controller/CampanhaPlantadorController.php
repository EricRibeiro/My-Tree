<?php
namespace Plantador\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CampanhaPlantadorController extends AbstractActionController
{

	public function indexAction(){


		return new ViewModel();
	}

	public function aderirAction(){
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		
		if($this->request->isPost()){
			
			$idCampanha=$this->request->getPost('id');
			$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
			$campanha=$repositorio->find($idCampanha);
			$user=$this->identity();

			$this->destocarMuda($campanha);
			
			$user->addCampanha($campanha);
			$entityManager->persist($user);
			$entityManager->flush();
		}else {

			$qb=$entityManager->createQueryBuilder();
			$qb->select("c")
			->from('Investidor\Entity\Campanha','c')
			->innerJoin('Administrador\Entity\Muda','m','WITH','c.estoqueMuda=m.id')
			->innerJoin('Administrador\Entity\EstadoCampanha','ec','WITH','ec.id=c.estadoCampanha')
			->andWhere('ec.situacaoCampanha = :situacao')
			->andWhere('DATE_DIFF(CURRENT_DATE(), c.dataFinal) <= 0')
			->andWhere('c.local is NOT NULL')
			->andWhere('m.qtdMuda > 0')
			->orWhere('ec.situacaoCampanha = :situacao2')
			->setParameter('situacao', "liberada")
			->setParameter('situacao2', "abortada");
			$campanhas=$qb->getQuery()->getResult();


			$user=$this->identity();
			
			$view_params = array(
				'campanhas' => $campanhas,
				'plantador'=> $user
			);
			return new ViewModel($view_params);
		}
		return $this->redirect()->toRoute('plantador', array(
			'controller' => 'campanha',
			'action' => 'aderir',
		));		
	}

	public function destocarMuda($campanha){
		$entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$campanha->desestocarMuda();
		$entityManager->persist($campanha);
		$entityManager->flush();

	}

	public function sairAction(){

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		
		if($this->request->isPost()){
			
			$idCampanha=$this->request->getPost('id');

			$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
			$campanha=$repositorio->find($idCampanha);
			$this->estocarMuda($campanha);

			$user=$this->identity();
			$user->removeCampanha($campanha);

			$entityManager->persist($user);
			$entityManager->flush();
		}
		return $this->redirect()->toRoute('plantador', array(
			'controller' => 'campanha',
			'action' => 'aderir',
		));
		
	}

	public function estocarMuda($campanha){
		
		$entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$campanha->estocarMuda();
		$entityManager->persist($campanha);
		$entityManager->flush();
	}

}


?>