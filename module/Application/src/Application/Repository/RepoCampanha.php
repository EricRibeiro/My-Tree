<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoCampanha extends EntityRepository
{
	public function findAllCampanhasVigentesComLocal()
	{
		return $this->createQueryBuilder('c')
		->where('c.local IS NOT NULL')
		->andWhere('DATE_DIFF(CURRENT_DATE(), c.dataFinal) >= 0')
		->andWhere('c.status = true')
		->getQuery()
		->execute();
	}

	public function findAllCampanhasParaAdministrar(){

		return $this->createQueryBuilder('c')
		->where('c.local IS NOT NULL')
		->andWhere('DATE_DIFF(CURRENT_DATE(), c.dataFinal) >= 0')
		->andWhere('c.status IS NULL')
		->getQuery()
		->execute();

	}


	

}