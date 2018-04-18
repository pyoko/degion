<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Criteria\CriteriaInterface;

trait RepositoryTrait
{
	private $entityManager;
	private $criteria = [];
	private $queryBuilder;


	// ------------------------------------------------------------------------
	// Queries
	// ------------------------------------------------------------------------
	
	/**
	 * Set Query Builder
	 */
	public function setQueryBuilder()
	{
		$this->queryBuilder = $this->createQueryBuilder('p');
	}

	/**
	 * Set Limit Query
	 * 
	 * @param int $limit
	 * @param int $offset
	 */
	public function setLimit(int $limit, int $offset) 
	{
		$this->queryBuilder
			 ->setFirstResult($offset)
			 ->setMaxResults($limit);
	}

	// ------------------------------------------------------------------------
	// Criteria
	// ------------------------------------------------------------------------
	
	/**
	 * Get criteria
	 * 
	 * @return array
	 */
	public function getCriteria()
	{
		return $this->criteria;
	}

	/**
	 * Push criteria(s)
	 * 
	 * @param  CriteriaInterface $criterias
	 */
	public function pushCriteria(CriteriaInterface ...$criterias)
	{
		foreach ($criterias as $criteria) {
			$this->criteria[] = $criteria;
		} 
	}

	/**
	 * Apply Criteria
	 */
	public function applyCriteria()
	{
		foreach ($this->getCriteria() as $criteria) {
			if ($criteria instanceOf CriteriaInterface) {
				$criteria->apply($this->queryBuilder);
			}
		}
	}

	// ------------------------------------------------------------------------
	// Result(s)
	// ------------------------------------------------------------------------

	/**
	 * Get Query Result
	 * 
	 * @param  int|integer $limit
	 * @param  int|integer $offset
	 * 
	 * @return ArrayIterator
	 */
	public function getResult(int $limit = 0, int $offset = 0): \ArrayIterator
	{
		// Limitation?
		if ($limit) {
			$this->setLimit($limit, $offset);
		}

		return new \ArrayIterator($this->queryBuilder->getQuery()->getResult());
	}

	/**
	 * Get One Query Result
	 * 
	 * @return Object
	 */
	public function getOne()
	{
		$this->setLimit(1, 0);
		return $this->queryBuilder->getQuery()->getOneOrNullResult();
	}

	// ------------------------------------------------------------------------
	// Entity Manager
	// ------------------------------------------------------------------------
	
	/**
	 * Set up entity manager for transaction
	 * 
	 * @param  mixed $entity
	 * 
	 * @return self
	 */
	public function persist($entity)
	{
		$entityManager = $this->getEntityManager();
		$entityManager->persist($entity);

		return $this;
	}

	/**
	 * Insert to database 
	 */
	public function flush()
	{
		$entityManager = $this->getEntityManager();
		$entityManager->flush();
	}
}