<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Pigeon;

class PigeonData extends Fixture
{
	const PIGEONS = [
		[
			'name'     => 'Antonio', 
			'speed'    => 70,
			'distance' => 600,
			'cost'     => 2,
			'downtime' => 2
		],
		[
			'name'     => 'Bonito', 
			'speed'    => 80,
			'distance' => 500,
			'cost'     => 2,
			'downtime' => 3
		],
		[
			'name'     => 'Carillo', 
			'speed'    => 65,
			'distance' => 1000,
			'cost'     => 2,
			'downtime' => 3
		],
		[
			'name'     => 'Alejandro', 
			'speed'    => 70,
			'distance' => 800,
			'cost'     => 2,
			'downtime' => 2
		]
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::PIGEONS as $pigeon) {
			$newPigeon = new Pigeon;
			foreach ($pigeon as $key => $data) {
				$newPigeon->{'set'.ucfirst($key)}($data);
			}

			$manager->persist($newPigeon);
		}

		$manager->flush();
	}
}