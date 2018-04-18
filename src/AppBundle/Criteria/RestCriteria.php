<?php

namespace AppBundle\Criteria;

use AppBundle\Criteria\CriteriaInterface;

class RestCriteria implements CriteriaInterface
{
	const LIMIT_TO_REST = 2;


	/**
	 * Apply Criteria
	 * 
	 * @param  &$queryBuilder
	 */
	public function apply(&$queryBuilder)
	{
		$queryBuilder->andWhere('p.countToRest < :limit_to_rest')
				     ->setParameter('limit_to_rest', self::LIMIT_TO_REST);
	}
}