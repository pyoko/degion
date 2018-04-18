<?php

namespace AppBundle\Criteria;

use AppBundle\Criteria\CriteriaInterface;

class AvailabilityCriteria implements CriteriaInterface
{
	const IS_AVAILABLE = 1;


	/**
	 * Apply Criteria
	 * 
	 * @param  &$queryBuilder
	 */
	public function apply(&$queryBuilder)
	{
		$queryBuilder->andWhere('p.availability = :availability')
				     ->setParameter('availability', self::IS_AVAILABLE);
	}
}