<?php 

namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Plantador\Entity\Plantador;


class ParticipacaoAdministradorController extends AbstractActionController
{

	public function indexAction()
	{
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		if ($user = $this->identity()) {
			
			$qb=$entityManager->createQueryBuilder();
			$qb->select("c")
			->from('Investidor\Entity\Campanha','c')
			->innerJoin('Administrador\Entity\Muda','m','WITH','c.estoqueMuda=m.id')
			->innerJoin('Administrador\Entity\EstadoCampanha','ec','WITH','ec.id=c.estadoCampanha')
			->andWhere('ec.situacaoCampanha = :situacao')
			->andWhere('c.local is NOT NULL')
			->andWhere('m.estoqueMuda > 0')
			->orWhere('ec.situacaoCampanha = :situacao2')
			->setParameter('situacao', "liberada")
			->setParameter('situacao2', "abortada");
			$campanhas=$qb->getQuery()->getResult();
			return new ViewModel(['campanhas'=>$campanhas]);
		}
		return $this->redirect()->toRoute('application', ['controller' => 'login', 'action' => 'index']);
	}



	public function confirmarAction(){
		$idCampanha=$this->params()->fromRoute('id');
		
		if (is_null($idCampanha)) {
			$idCampanha = $this->request->getPost('idCampanha');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$repositorio=$entityManager->getRepository("Investidor\Entity\Campanha");
		$campanha=$repositorio->find($idCampanha);

		if($this->request->isPost()){
			
			$idPlantadores=$this->request->getPost('IDsPlantadores');

			$plantadores=explode('-', $idPlantadores);

			foreach ($plantadores as $idPlantador ) {
				$repositorio=$entityManager->getRepository("Plantador\Entity\Plantador");
				$plantador=$repositorio->find($idPlantador);
				$plantador->removeCampanha($campanha);
				$plantador->confirmarPresenca($campanha);
				$entityManager->persist($plantador);
				$entityManager->flush();

			}

			$campanha->getLocal()->altualizarQtdMudasPlantadas(count($plantadores));
			$entityManager->persist($campanha);
			$entityManager->flush();
		}

		return new ViewModel(['plantadores'=>$campanha->getPlantadores(),"campanha"=>$campanha]);

	}




}
