<?php

namespace AppBundle\Services;

use AppBundle\Entity\DefaultCar;
use AppBundle\Entity\Measure as MeasureEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class Measure 
{
	protected $request;
	protected $tokenStorage;
	protected $entityManager;
	protected $measures;

	public function __construct(
		Request $request, 
		TokenStorage $tokenStorage,
		EntityManager $entityManager
	) 
	{
		$this->request = $request;
		$this->tokenStorage = $tokenStorage;
		$this->entityManager = $entityManager;
	}
	
	
	public function getMeasures()
	{
		$defaultCar = $this->entityManager->getRepository(DefaultCar::class)->findOneByUserId($this->getUser()->getId());
		
		$this->measures = $this->entityManager
			->getRepository(MeasureEntity::class)
			->createQueryBuilder('p')
			->where('p.car = :car')
			->setParameter('car', $defaultCar->getCarId())
			->orderBy('p.id', 'ASC')
			->getQuery()
			->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		
		
		$this->measures = $this->calcMeasures($this->measures);
		
		return $this->measures;
	}
	
	
	protected function getUser()
	{
		$user = $this->tokenStorage->getToken()->getUser();
		
		return $user;
	}
	
	
	protected function calcMeasures($measures = array())
	{
		if (count($measures) > 1)
		{
			foreach ($measures as $index => &$measure)
			{
				$measure['passedKm'] = '-';
				$measure['fuelConsumption'] = '-';
				
				if (isset($measures[$index - 1]['km']))
				{
					$measure['passedKm'] = $measure['km'] - $measures[$index - 1]['km'];
					$measure['fuelConsumption'] = round($measure['liter'] * 100 / $measure['passedKm'], 2);
				}
				
			}
		}
		
		return $measures;
	}
	
	
	public function getChartData()
	{
		if (empty($this->measures))
		{
			$this->getMeasures();
		}
		
		
	}
	
}
