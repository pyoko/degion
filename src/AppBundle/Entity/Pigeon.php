<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityInterface;

/**
 * Pigeon
 *
 * @ORM\Table(name="pigeon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PigeonRepository")
 */
class Pigeon implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="speed", type="integer")
     */
    private $speed;

    /**
     * @var int
     *
     * @ORM\Column(name="distance", type="integer")
     */
    private $distance;

    /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer")
     */
    private $cost;

    /**
     * @var int
     *
     * @ORM\Column(name="downtime", type="integer")
     */
    private $downtime;

    /**
     * @var int
     *
     * @ORM\Column(name="count_to_reset", type="integer")
     */
    private $countToRest;

    /**
     * @var bool
     *
     * @ORM\Column(name="availability", type="boolean")
     */
    private $availability;


    public function __construct()
    {
        $this->countToRest = 1;
        $this->availability = 1;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pigeon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     *
     * @return Pigeon
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return Pigeon
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Pigeon
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set downtime
     *
     * @param integer $downtime
     *
     * @return Pigeon
     */
    public function setDowntime($downtime)
    {
        $this->downtime = $downtime;

        return $this;
    }

    /**
     * Get downtime
     *
     * @return int
     */
    public function getDowntime()
    {
        return $this->downtime;
    }

    /**
     * Set countToRest
     *
     * @param boolean $countToRest
     *
     * @return Pigeon
     */
    public function setCountToRest($countToRest)
    {
        $this->countToRest = $countToRest;

        return $this;
    }

    /**
     * Get countToRest
     *
     * @return bool
     */
    public function getCountToRest()
    {
        return $this->countToRest;
    }

    /**
     * Set availability
     *
     * @param boolean $availability
     *
     * @return Pigeon
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return bool
     */
    public function getAvailability()
    {
        return $this->availability;
    }
}

