<?php

namespace AppBundle\UberPigeon;

use AppBundle\Entity\EntityInterface;

interface ObjectTypeInterface
{
	function setDistance(float $distance);
	function getDistance();
	function setDeadline(\DateTime $deadline);
	function getDeadline();
	function setCost(float $cost);
	function getCost();
	function calculateCost(EntityInterface $pigeon);
}