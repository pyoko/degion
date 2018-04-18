<?php

namespace AppBundle\Criteria;

use AppBundle\Criteria\CriteriaInterface;

class DistanceCriteria implements CriteriaInterface
{
	private $distance;


	public function __construct(float $distance = 0)
	{
		$this->distance = $distance;
	}

	/**
	 * Apply Criteria
	 * 
	 * @param  &$queryBuilder
	 */
	public function apply(&$queryBuilder)
	{
		$queryBuilder->andWhere('p.distance >= :distance')
				     ->setParameter('distance', $this->distance);
	}
}