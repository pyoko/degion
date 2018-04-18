<?php

namespace AppBundle\Criteria;

interface CriteriaInterface
{
	function apply(&$queryBuilder);
}