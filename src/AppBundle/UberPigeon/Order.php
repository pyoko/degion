<?php

namespace AppBundle\UberPigeon;

use AppBundle\Repository\RepositoryInterface;
use AppBundle\Entity\EntityInterface;
use AppBundle\UberPigeon\OrderObject;
use AppBundle\UberPigeon\OrderInterface;

class Order implements OrderInterface
{
	private $pigeonRepo;
	private $invoiceRepo;
	private $newOrder;

	
	public function __construct(RepositoryInterface $pigeonRepo, RepositoryInterface $invoiceRepo)
	{
		$this->pigeonRepo  = $pigeonRepo;
		$this->invoiceRepo = $invoiceRepo;
	}

	/**
	 * Receive Order
	 * 
	 * @param  float|integer $distance
	 * @param  \DateTime     $deadline
	 * 
	 * @return array
	 */
	public function receiveOrder(float $distance = 0, \DateTime $deadline): array
	{
		// Let's try to get the pigeons based on the requirements
		// (which are the distance, deadline, whether it's available and it's not resting)
		// 
		// If we can't find any pigeon, the PigeonNotFoundException will handle the response
		// otherwise, accept the order
		$this->newOrder = new OrderObject($distance, $deadline);
		$pigeon = $this->pigeonRepo->getPigeon(
			$this->newOrder->getDistance(), 
			$this->newOrder->getDeadline()
		);

		return $this->acceptOrder($pigeon);
	}

	/**
	 * Accept Order
	 * 
	 * @param  EntityInterface $pigeon
	 * @return array
	 */
	public function acceptOrder(EntityInterface $pigeon): array
	{
		// Let's calculate the cost and save the invoice :)
		$this->newOrder->calculateCost($pigeon);
		$invoice = $this->invoiceRepo->saveInvoice($pigeon, $this->newOrder);

		return ['status' => 'accepted', 'message' => $invoice];
	}
}
