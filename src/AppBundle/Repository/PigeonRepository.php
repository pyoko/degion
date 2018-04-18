<?php

namespace AppBundle\Repository;

use AppBundle\Exception\PigeonNotFoundException;
use AppBundle\Entity\EntityInterface;
use AppBundle\Repository\{RepositoryInterface, RepositoryTrait};
use AppBundle\Criteria\AvailabilityCriteria as IsAvailable;
use AppBundle\Criteria\RestCriteria as IsResting;
use AppBundle\Criteria\DistanceCriteria as CheckDistance;
use AppBundle\Criteria\TimeCriteria as CheckDeliveryTime;

class PigeonRepository extends \Doctrine\ORM\EntityRepository implements RepositoryInterface
{
	use RepositoryTrait;


	/**
	 * Get Pigeon
	 * 
	 * @param  float     $distance
	 * @param  \DateTime $deadline
	 * 
	 * @return EntityInterface
	 */
	public function getPigeon(float $distance, \DateTime $deadline): EntityInterface
	{
		$this->setQueryBuilder();

		// Add criterias (availability, rest, distance, time)
		$this->pushCriteria(
			new IsAvailable,							# Find available pigeon
			new IsResting,								# Find pigeon that's not resting
			new CheckDistance($distance),				# Find pigeon that can delivery to the given distance
			new CheckDeliveryTime($distance, $deadline) # Find pigeon that can delivery before the given deadline
		);
		$this->applyCriteria();
		
		// Get pigeon? If so, let's set its availability and does it need to rest?
		// If no pigeon available, just throw an exception
		if (null !== ($pigeon = $this->getOne())) {
			$this->setPigeonAvailability($pigeon);
			$this->setPigeonToRest($pigeon);
			

			return $pigeon;
		}

		throw new PigeonNotFoundException('No pigeon available');
	}

	/**
	 * Set Pigeon's availability
	 * 
	 * @param EntityInterface $pigeon
	 */
	public function setPigeonAvailability(EntityInterface $pigeon)
	{
		$pigeon->setAvailability(0);
		$this->persist($pigeon);
	}

	/**
	 * Set Pigeon to rest
	 * 
	 * @param EntityInterface $pigeon
	 */
	private function setPigeonToRest(EntityInterface $pigeon)
	{
		$pigeon->setCountToRest($pigeon->getCountToRest() + 1);
		$this->persist($pigeon);

		#TODO: reset rest counter after a couple hours (downtime). Worker?
	}
}
