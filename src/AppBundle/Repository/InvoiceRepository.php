<?php

namespace AppBundle\Repository;

use AppBundle\Entity\{EntityInterface, Invoice};
use AppBundle\Repository\{RepositoryInterface, RepositoryTrait};
use AppBundle\UberPigeon\OrderObject;

class InvoiceRepository extends \Doctrine\ORM\EntityRepository implements RepositoryInterface
{
	use RepositoryTrait;


	/**
	 * Save Invoce
	 * 
	 * @param  EntityInterface $pigeon
	 * @param  StdClass        $newOrder
	 * 
	 * @return array
	 */
	public function saveInvoice(EntityInterface $pigeon, OrderObject $newOrder): array
	{
		$newInvoice = new Invoice;

		$newInvoice->setDistance($newOrder->getDistance());
		$newInvoice->setDeadline($newOrder->getDeadline());
		$newInvoice->setCost($newOrder->getCost());
		$newInvoice->setPigeon($pigeon);

		$this->persist($newInvoice);
		$this->flush();

		return $this->makeInvoiceReadable($newInvoice);
	}

	/**
	 * Make Invoice Entity readable
	 * 
	 * @param  EntityInterface $invoice
	 * @return array
	 */
	public function makeInvoiceReadable(EntityInterface $invoice)
	{
		return [
			'invoice_id' => $invoice->getId(),
			'distance'   => $invoice->getDistance(),
			'deadline'   => $invoice->getDeadline(),
			'cost'       => $invoice->getCost(),
			'pigeon'     => $invoice->getPigeon()->getName()
		];
	}
}
