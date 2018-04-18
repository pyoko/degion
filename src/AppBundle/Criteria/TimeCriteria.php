<?php

namespace AppBundle\Criteria;

use AppBundle\Criteria\CriteriaInterface;

class TimeCriteria implements CriteriaInterface
{
	private $distance;
	private $deadline;


	public function __construct(float $distance, \DateTime $deadline)
	{
		$this->distance = $distance;
		$this->deadline = $deadline;
	}

	/**
	 * Apply Criteria
	 * 
	 * @param  &$queryBuilder
	 */
	public function apply(&$queryBuilder)
	{
		$queryBuilder->andWhere('((:distance / p.speed)*3600) <= :secondsNeeded')
				     ->setParameter('distance', $this->distance)
				     ->setParameter('secondsNeeded', $this->howLongShouldItTake());
	}

	/**
	 * Count time differences between current time and deadline time
	 * 
	 * @return float
	 */
	private function howLongShouldItTake()
	{
		// Let's count how many seconds do we need from current time to the deadline
		$currentTime = new \DateTime();
		$difference  = $this->deadline->diff($currentTime);

		return ($difference->h * 3600) + ($difference->i * 60) + $difference->s;
	}
}