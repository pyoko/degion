<?php

namespace AppBundle\UberPigeon;

use AppBundle\Entity\EntityInterface;
use AppBundle\UberPigeon\ObjectTypeInterface;

class OrderObject implements ObjectTypeInterface
{
	private $distance;
	private $deadline;
	private $cost;


	public function __construct(float $distance = null, \DateTime $deadline = null, float $cost = null)
	{
		$this->distance = $distance;
		$this->deadline = $deadline;
		$this->cost     = $cost;
	}

	public function setDistance(float $distance): self
	{
		$this->distance = $distance;

		return $this;
	}

	public function getDistance(): float
	{
		return $this->distance;
	}

	public function setDeadline(\DateTime $deadline): self
	{
		$this->deadline = $deadline;

		return $this;
	}

	public function getDeadline(): \DateTime
	{
		return $this->deadline;
	}

	public function setCost(float $cost): self
	{
		$this->cost = $cost;

		return $this;
	}

	public function getCost(): float
	{
		return $this->cost;
	}

	public function calculateCost(EntityInterface $pigeon)
	{
		$this->cost = $pigeon->getCost() * $this->distance;
	}
}