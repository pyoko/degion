<?php

namespace AppBundle\UberPigeon;

use AppBundle\Entity\EntityInterface;

interface OrderInterface
{
	function receiveOrder(float $distance = 0, \DateTime $deadline);
	function acceptOrder(EntityInterface $pigeon);
}