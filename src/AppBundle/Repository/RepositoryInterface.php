<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Criteria\CriteriaInterface;

interface RepositoryInterface
{
	// Queries
	function setQueryBuilder();
	function setLimit(int $limit, int $offset);

	// Criteria
	function getCriteria();
	function pushCriteria(CriteriaInterface ...$criterias);
	function applyCriteria();

	// Result(s)
	function getResult(int $limit = 0, int $offset = 0);
	function getOne();

	// Entity Manager
	function persist($entity);
	function flush();
}